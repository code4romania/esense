<?php namespace Genuineq\Esense;

use Log;
use Auth;
use Event;
use Carbon\Carbon;
use System\Classes\PluginBase;
use Illuminate\Support\Collection;
use Genuineq\User\Helpers\RedirectHelper;
use Genuineq\Profile\Models\Specialist;
use Genuineq\Profile\Models\School;
use Genuineq\Students\Models\Student;
use Genuineq\Esense\Models\StudentTransfer;
use Genuineq\Esense\Models\Connection;
use Genuineq\Timetable\Models\Lesson;
use Genuineq\User\Models\User;

class Plugin extends PluginBase
{
    /**
     * @var array Require the dependency plugins
     */
    public $require = [
        'Genuineq.User',
        'Genuineq.JWTAuth',
        'Genuineq.Profile',
        'Genuineq.Addresses',
        'Genuineq.Students',
        'Genuineq.Timetable'
    ];

    /** Function for registering Profile component. */
    public function registerComponents()
    {
        return [
            \Genuineq\Esense\Components\StudentActions::class => 'studentActions',
            \Genuineq\Esense\Components\LessonsActions::class => 'lessonsActions'
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'genuineq.esense::mail.transfer_accepted',
            'genuineq.esense::mail.transfer_rejected',
            'genuineq.esense::mail.access_granted',
            'genuineq.esense::mail.access_rejected',
        ];
    }

    public function registerSettings()
    {
    }

    public function registerSchedule($schedule)
    {
        /**
         * Daily task that checks if there are any users
         *  that have not activated their accounts for more than 30 days.
         */
        $schedule->call(function () {
            /** Extract all users that are not activated and are older that 30 days. */
            $inactiveUsers = User::whereNull('activated_at')->whereDate('created_at', '<', Carbon::now()->subDays(30)->format('Y-m-d'))->get();

            /** Delete all extracted users and the profiles. */
            foreach ($inactiveUsers as $key => $user) {
                $profile = $user->profile;
                $profile->forceDelete();
                $user->forceDelete();
            }
        })->daily();
    }

    public function boot()
    {
        /** Extend the Student model. */
        $this->studentExtendProperties();
        $this->studentExtendRelationships();
        $this->studentExtendMethods();
        $this->studentExtendComponens();

        /** Extend the School model. */
        $this->schoolExtendRelationships();
        $this->schoolExtendMethods();

        /** Extend the Specialist model. */
        $this->specialistExtendRelationships();
        $this->specialistExtendMethods();

        /** Extend the Lesson model. */
        $this->lessonExtendRelationships();
        $this->lessonExtendProperties();
    }

    /***********************************************
     ************** Student extensions *************
     ***********************************************/

    /**
     * Function that performs all the properties extensions of the Student model.
     */
    protected function studentExtendProperties()
    {
        /** Add extra fillable fields. */
        Student::extend(function($model) {
            $model->addFillable([
                'owner_id',
                'owner_type'
            ]);
        });
    }

    /**
     * Function that performs all the relationships extensions of the Student model.
     */
    protected function studentExtendRelationships()
    {
        Student::extend(function($model) {
            /** Link "Specialist" model to "Student" model with one-to-many relation. */
            $model->morphTo['owner'] = [];

            /** Link "Specialist" model to "Student" model with many-to-many relation. */
            $model->belongsToMany['specialists'] = [
                'Genuineq\Profile\Models\Specialist',
                'table' => 'genuineq_esense_connections',
                'pivot' => ['approved', 'message', 'seen'],
                'timestamps' => true
            ];

            /** Link "Connection" model to "Student" model with has-many relation. */
            $model->hasMany['connections'] = ['Genuineq\Esense\Models\Connection', 'key' => 'student_id'];

            /** Link "Lesson" model to "Student" model with has-many-through relation. */
            $model->hasManyThrough['lessons'] = ['Genuineq\Timetable\Models\Lesson', 'through' => 'Genuineq\Esense\Models\Connection'];
        });
    }

    /**
     * Function that performs all the methods extensions of the Student model.
     */
    protected function studentExtendMethods()
    {
        Student::extend(function($model) {
            /** Add attribute that chacks if owner is of type specialist. */
            $model->addDynamicMethod('getOwnerIsSpecialistAttribute', function() use ($model) {
                return 'Genuineq\Profile\Models\Specialist' == $model->owner_type;
            });

            /** Add attribute that chacks if owner is of type school. */
            $model->addDynamicMethod('getOwnerIsSchoolAttribute', function() use ($model) {
                return 'Genuineq\Profile\Models\School' == $model->owner_type;
            });

            /** Add today lessons attribute. */
            $model->addDynamicMethod('getTodayLessonsAttribute', function() use ($model) {
                return $model->lessons()->where('day', Carbon::now()->format('Y-m-d'))->get();
            });

            /** Add today lessons attribute. */
            $model->addDynamicMethod('getDateLessons', function($date) use ($model) {
                return $model->lessons()->where('day', Carbon::parse($date)->format('Y-m-d'))->get();
            });

            /** Add get connection attribute. */
            $model->addDynamicMethod('getConnection', function($specialist) use ($model) {
                return $model->connections->where('specialist_id', $specialist)->first();
            });
        });
    }

    /**
     * Function that contains all the component extensions of the Student component.
     */
    protected function studentExtendComponens()
    {
        /************ Student CREATE start ************/
        Event::listen('genuineq.students.student.create.start', function(&$component, $inputs, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.create.before.student.create', function(&$data, $inputs) {
            /** Add the owner ID to the data. */
            if ('specialist' == Auth::getUser()->type) {
                $data['owner_id'] = Auth::user()->profile->id;
            } else {
                $data['owner_id'] = $inputs['owner'];
            }
            $data['owner_type'] = 'Genuineq\Profile\Models\Specialist';
        });

        Event::listen('genuineq.students.create.after.student.create', function($student) {
            /** Create a specialist connection. */
            $student->specialists()->attach($student->owner_id, ['approved' => true]);
        });


        Event::listen('genuineq.students.create.before.finish', function(&$redirectUrl, $student) {
            /** Redirect to all students page. */
            if ('specialist' == Auth::getUser()->type) {
                $redirectUrl = 'specialist/students';
            } else {
                $redirectUrl = 'school/students';
            }

        });
        /************ Student CREATE end ************/

        /************ Student UPDATE start ************/
        Event::listen('genuineq.students.student.update.start', function(&$component, $inputs, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.update.before.student.update', function(&$student, $inputs) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the student that needs to be archived. */
            $student = $user->profile->allStudents()->where('id', $inputs['id'])->first();
        });
        /************ Student UPDATE end ************/

        /************ Student ARCHIVE start ************/
        Event::listen('genuineq.students.student.archive.start', function(&$component, $inputs, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.student.before.archive', function(&$student, $inputs) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the student that needs to be archived. */
            $student = $user->profile->allStudents()->where('id', $inputs['id'])->first();
        });
        /************ Student ARCHIVE end ************/

        /************ Student UNZIP start ************/
        Event::listen('genuineq.students.student.unzip.start', function(&$component, $inputs, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.student.before.unzip', function(&$student, $inputs) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the student that needs to be unziped. */
            $student = $user->profile->archivedStudents->where('id', $inputs['id'])->first();
        });
        /************ Student UNZIP end ************/

        /************ Student DELETE start ************/
        Event::listen('genuineq.students.student.delete.start', function(&$component, $inputs, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.student.before.delete', function(&$student, $inputs) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the student that needs to be deleted. */
            $student = $user->profile->archivedStudents->where('id', $inputs['id'])->first();
        });
        /************ Student DELETE end ************/
    }

    /***********************************************
     ************** School extensions **************
     ***********************************************/

    /**
     * Function that performs all the relationships extensions of the School model.
     */
    protected function schoolExtendRelationships()
    {
        School::extend(function($model) {
            /** Link "School" model to "Student" model with one-to-many-through relation. */
            $model->hasManyThrough['studentsRelationship'] = [
                'Genuineq\Students\Models\Student',
                'through' => 'Genuineq\Profile\Models\Specialist',
                'order' => 'name desc'
            ];
        });
    }

    /**
     * Function that performs all the methods extensions of the School model.
     */
    protected function schoolExtendMethods()
    {
        School::extend(function($model) {
            /** Add students attribute. */
            $model->addDynamicMethod('getStudentsAttribute', function() use ($model) {
                $students = new Collection();

                /** Parse students all the in specialists. */
                foreach ($model->active_specialists as $specialist) {
                    $students = $students->merge($specialist->students);
                }

                return $students;
            });

            /** Add archived students attribute. */
            $model->addDynamicMethod('getArchivedStudentsAttribute', function() use ($model) {
                $archivedStudents = new Collection();

                /** Parse all students the in active specialists. */
                foreach ($model->active_specialists as $specialist) {
                    $archivedStudents = $archivedStudents->merge($specialist->archivedStudents);
                }

                /** Parse all the students in archived specialists.  */
                foreach ($model->archivedSpecialists as $specialist) {
                    $archivedStudents = $archivedStudents->merge($specialist->archivedStudents);
                }

                return $archivedStudents;
            });

            /** Add all students attribute. */
            $model->addDynamicMethod('getAllStudentsAttribute', function() use ($model) {
                $allStudents = new Collection();

                /** Parse all students the in active specialists. */
                foreach ($model->active_specialists as $specialist) {
                    $allStudents = $allStudents->union($specialist->allStudents);
                }

                /** Parse all students the in inactive specialists. */
                foreach ($model->inactive_specialists as $specialist) {
                    $allStudents = $allStudents->union($specialist->allStudents);
                }

                /** Parse all students the in archived specialists.  */
                foreach ($model->archivedSpecialists as $specialist) {
                    $allStudents = $allStudents->union($specialist->allStudents);
                }

                return $allStudents;
            });
        });
    }

    /***********************************************
     ************ Specialist extensions ************
     ***********************************************/

    /**
     * Function that performs all the relationships extensions of the Specialist model.
     */
    protected function specialistExtendRelationships()
    {
        Specialist::extend(function($model) {
            /** Link "Student" model to "Specialist" model with one-to-many relation. */
            $model->morphMany['myStudents'] = ['Genuineq\Students\Models\Student', 'name' => 'owner'];

            /** Link "Student" model to "Specialist" model with many-to-many relation. */
            $model->belongsToMany['students'] = [
                'Genuineq\Students\Models\Student',
                'table' => 'genuineq_esense_connections',
                'pivot' => ['approved', 'message', 'seen'],
                'timestamps' => true,
                'order' => 'name asc',
                'conditions' => 'archived = 0 AND approved = 1'
            ];

            /** Link "Student" model to archived "Specialist" model with many-to-many relation. */
            $model->belongsToMany['archivedStudents'] = [
                'Genuineq\Students\Models\Student',
                'table' => 'genuineq_esense_connections',
                'pivot' => ['approved', 'message', 'seen'],
                'timestamps' => true,
                'order' => 'name asc',
                'conditions' => 'archived = 1'
            ];

            /** Link "Student" model to archived "Specialist" model with many-to-many relation. */
            $model->belongsToMany['allStudents'] = [
                'Genuineq\Students\Models\Student',
                'table' => 'genuineq_esense_connections',
                'pivot' => ['approved', 'message', 'seen'],
                'timestamps' => true,
            ];

            /** Link "Owner" model to "Specialist" model with one-to-many-through relation. */
            $model->hasManyThrough['accessNotifications'] = [
                'Genuineq\Profile\Models\Specialist',
                'through' => 'Genuineq\Students\Models\Student',
            ];

            /** Link "StudentTransfer" model to "Specialist" model with one-to-many relation. */
            $model->hasMany['transferRequests'] = ['Genuineq\Esense\Models\StudentTransfer', 'key' => 'from_specialist_id'];

            /** Link "Connection" model to "Specialist" model with has-many relation. */
            $model->hasMany['connections'] = ['Genuineq\Esense\Models\Connection', 'key' => 'specialist_id'];

            /** Link "Lesson" model to "Specialist" model with has-many-through relation. */
            $model->hasManyThrough['lessons'] = ['Genuineq\Timetable\Models\Lesson', 'through' => 'Genuineq\Esense\Models\Connection'];
        });
    }

    /**
     * Function that performs all the methods extensions of the Specialist model.
     */
    protected function specialistExtendMethods()
    {
        Specialist::extend(function($model) {
            /** Add school students attribute. */
            $model->addDynamicMethod('getSchoolStudentsAttribute', function() use ($model) {
                $schoolStudents = $model->school->all_students;

                foreach ($model->allStudents as $specialistStudent) {
                    foreach ($schoolStudents as $key => $schoolStudent) {
                        if ($schoolStudent->id == $specialistStudent->id) {
                            $schoolStudents->forget($key);
                        }
                    }
                }

                return $schoolStudents;
            });

            /** Add access notifications attribute. */
            $model->addDynamicMethod('getAccessNotificationsAttribute', function() use ($model) {
                $notifications = new Collection();

                foreach ($model->myStudents as $key => $student) {
                    $notifications = $notifications->merge($student->specialists()->wherePivot('seen', 0)->wherePivot('approved', 0)->get());
                }

                return $notifications;
            });

            /** Add access notifications attribute. */
            $model->addDynamicMethod('getAccessNotificationsStudent', function($candidateId) use ($model) {
                return Student::find($candidateId);
            });

            /** Add transfer notifications attribute. */
            $model->addDynamicMethod('getTransferNotificationsAttribute', function() use ($model) {
                return $model->transferRequests()->whereNull('approved')->get();
            });

            /** Add today lessons attribute. */
            $model->addDynamicMethod('getTodayLessonsAttribute', function() use ($model) {
                return $model->lessons()->where('day', Carbon::now()->format('Y-m-d'))->get();
            });

            /** Add today lessons attribute. */
            $model->addDynamicMethod('getDateLessons', function($date) use ($model) {
                return $model->lessons()->where('day', Carbon::parse($date)->format('Y-m-d'))->get();
            });

            /** Add get connection attribute. */
            $model->addDynamicMethod('getConnection', function($student) use ($model) {
                return $model->connections()->where('student_id', $student)->first();
            });
        });
    }

    /***********************************************
     ************** Lesson extensions **************
     ***********************************************/

    /**
     * Function that performs all the relationships extensions of the Lesson model.
     */
    protected function lessonExtendRelationships()
    {
        Lesson::extend(function($model) {
            /** Link "Connection" model to "Lesson" model with one-to-many relation. */
            $model->belongsTo['connection'] = 'Genuineq\Esense\Models\Connection';
        });
    }

    /**
     * Function that performs all the properties extensions of the Lesson model.
     */
    protected function lessonExtendProperties()
    {
        /**
         * Add extra fillable fields.
         */
        Lesson::extend(function($model) {
            $model->addFillable([
                'connection_id',
                'category'
            ]);
        });
    }
}
