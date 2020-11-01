<?php namespace Genuineq\Esense;

use Log;
use Auth;
use Event;
use System\Classes\PluginBase;
use Illuminate\Support\Collection;
use Genuineq\User\Helpers\RedirectHelper;
use Genuineq\Profile\Models\Specialist;
use Genuineq\Profile\Models\School;
use Genuineq\Students\Models\Student;

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
            \Genuineq\Esense\Components\StudentAccess::class => 'studentAccess'
        ];
    }

    public function registerSettings()
    {
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
                'table' => 'genuineq_esense_students_specialists',
                'pivot' => ['approved', 'message', 'seen'],
                'timestamps' => true
            ];
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
                'table' => 'genuineq_esense_students_specialists',
                'pivot' => ['approved', 'message', 'seen'],
                'timestamps' => true,
                'order' => 'name asc',
                'conditions' => 'archived = 0 AND approved = 1'
            ];

            /** Link "Student" model to archived "Specialist" model with many-to-many relation. */
            $model->belongsToMany['archivedStudents'] = [
                'Genuineq\Students\Models\Student',
                'table' => 'genuineq_esense_students_specialists',
                'pivot' => ['approved', 'message', 'seen'],
                'timestamps' => true,
                'order' => 'name asc',
                'conditions' => 'archived = 1'
            ];

            /** Link "Student" model to archived "Specialist" model with many-to-many relation. */
            $model->belongsToMany['allStudents'] = [
                'Genuineq\Students\Models\Student',
                'table' => 'genuineq_esense_students_specialists',
                'pivot' => ['approved', 'message', 'seen'],
                'timestamps' => true,
            ];

            /** Link "Owner" model to "Specialist" model with one-to-many-through relation. */
            $model->hasManyThrough['accessNotifications'] = [
                'Genuineq\Profile\Models\Specialist',
                'through' => 'Genuineq\Students\Models\Student',
            ];
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

            /** Add notifications attribute. */
            $model->addDynamicMethod('getAccessNotificationsStudent', function($candidateId) use ($model) {
                return Student::find($candidateId);
            });
        });
    }
}
