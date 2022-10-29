<?php namespace Genuineq\Esense;

use Log;
use Auth;
use Event;
use Lang;
use Carbon\Carbon;
use System\Classes\PluginBase;
use Illuminate\Support\Collection;
use Genuineq\User\Helpers\RedirectHelper;
use Genuineq\Profile\Models\Specialist;
use Genuineq\Profile\Models\School;
use Genuineq\Students\Models\Student;
use Genuineq\Esense\Models\TransferRequest;
use Genuineq\Esense\Models\Connection;
use Genuineq\Timetable\Models\Lesson;
use Genuineq\User\Models\User;
use JanVince\SmallRecords\Models\Category as ExerciseCategory;
use JanVince\SmallRecords\Models\Record as Exercise;

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
        'Genuineq.Timetable',
        'JanVince.SmallRecords',
    ];

    /** Function for registering Profile component. */
    public function registerComponents()
    {
        return [
            \Genuineq\Esense\Components\StudentActions::class => 'studentActions',
            \Genuineq\Esense\Components\LessonsActions::class => 'lessonsActions',
            \Genuineq\Esense\Components\ChartsActions::class => 'chartsActions'
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
        $this->schoolExtendComponens();

        /** Extend the Specialist model. */
        $this->specialistExtendRelationships();
        $this->specialistExtendMethods();
        $this->specialistExtendComponens();

        /** Extend the Lesson model. */
        $this->lessonExtendRelationships();
        $this->lessonExtendProperties();
        $this->lessonExtendComponens();

        /** Extends SmallRecords plugin */
        $this->smallRecordsPluginExtend();

        /** Extends Rainlab\Pages plugin */
        $this->staticPagesPluginExtend();

    }


    public function registerPermissions()
    {
        /** Permissions for SmallRecords plugin */
        return [
            'genuineq.esense.smallrecords_access' => [
                'tab' => 'genuineq.esense::lang.smallrecords_permissions.tab',
                'label' => 'genuineq.esense::lang.smallrecords_permissions.label',
                'roles' => ['Developer'],
            ],
        ];
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
                'table' => 'genuineq_esense_students_specialists'
            ];

            /** Link "Connection" model to "Student" model with has-many relation. */
            $model->hasMany['connections'] = ['Genuineq\Esense\Models\Connection', 'key' => 'student_id'];

            /** Link "Lesson" model to "Student" model with has-many-through relation. */
            $model->hasManyThrough['lessons'] = ['Genuineq\Timetable\Models\Lesson', 'through' => 'Genuineq\Esense\Models\Connection'];

            /** Link "TransferRequest" model to "Student" model with one-to-many relation. */
            $model->hasMany['transferRequests'] = ['Genuineq\Esense\Models\TransferRequest', 'key' => 'student_id'];

            /** Link "AccessRequest" model to "Student" model with one-to-many relation. */
            $model->hasMany['accessRequests'] = ['Genuineq\Esense\Models\AccessRequest', 'key' => 'student_id'];
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
                return $model->connections->where('specialist_id', $specialist->id)->first();
            });

            /** Add get lessons years attribute for Specialist/School => student.htm. */
            $model->addDynamicMethod('getLessonsYearsAttribute', function () use ($model) {
                /** initialize the array */
                $lessonsYears = [];

                if (in_array(Auth::user()->type,['specialist','parent'])) {
                    /** get authenticated specialist profile */
                    $specialistProfile = Auth::user()->profile;
                    /** get connection with a specific specialist */
                    $connection = $model->connections->where('specialist_id', $specialistProfile->id)->first();

                    /** get years of lessons with a specific specialist */
                    $lessons = $model->lessons()->where('connection_id', $connection->id)->get();

                    /** get years with lessons */
                    foreach ($lessons as $lesson) {
                        $lessonsYears[] = Carbon::parse($lesson->day)->format('Y');
                    }

                } elseif ('school' == Auth::user()->type) {
                    /** get authenticated school profile */
                    $schoolProfile = Auth::user()->profile;

                    $lessonsCollection = [];
                    foreach ($schoolProfile->active_specialists as $specialist) {
                        /** get connection with a specific specialist */
                        $connection = $model->connections->where('specialist_id', $specialist->id)->first();
                        /** check if student have a connection with that specialist */
                       if( $connection ) {
                           /** get lessons collection object */
                        $lessonsCollection[] = $model->lessons()->where('connection_id', $connection->id)->get();
                       }
                    }

                    foreach ($lessonsCollection as $lessons) {
                        foreach ($lessons as $lesson) {
                            $lessonsYears[] = Carbon::parse($lesson->day)->format('Y');
                        }
                    }
                }

                return array_unique($lessonsYears);
            });


            /** Add get school-student lessons from specific month method. */
            $model->addDynamicMethod('getLessonsFromMonth', function ($month = null, $year = null) use ($model) {
                /** Extract the start and the end of the month of an year . */
                $monthStart = Carbon::parse(($year ?? Carbon::now()->year) . '-' . ($month ?? Carbon::now()->month) . '-01')->format('Y-m-d');
                $monthEnd = Carbon::parse(($year ?? Carbon::now()->year) . '-' . ($month ?? Carbon::now()->month) . '-01')->endOfMonth()->format('Y-m-d');

                if (in_array(Auth::user()->type,['specialist','parent'])) {
                    /** get logged in specialist */
                    $specialistProfile = Auth::user()->profile;
                    /** return lessons from specific month with specific student */
                    return $specialistProfile->getLessonsFromMonth($model, $month, $year);

                } elseif ('school' == Auth::user()->type) {
                    /** get authenticated school profile */
                    $schoolProfile = Auth::user()->profile;

                    /** get student lessons with active specialists from authenticated school */
                    $lessonsCollection = [];
                    foreach ($schoolProfile->active_specialists as $specialist) {
                        /** get connection with a specific specialist */
                        $connection = $model->connections->where('specialist_id', $specialist->id)->first();
                        /** check if student have a connection with that specialist */
                        if ($connection) {
                            /** get lessons collection object */
                            $lessonsCollection[] = $specialist->getLessonsFromMonth($model, $month, $year);
                        }
                    }
                    /** initialise empty lessons array */
                    $lessonsArray = [];
                    /** iterate collection */
                    foreach ($lessonsCollection as $lessons) {
                        foreach ($lessons as $lesson) {
                            $lessonsArray[] = $lesson;
                        }
                    }

                    return $lessonsArray;
                }
            });

        });
    }

    /**
     * Function that contains all the component extensions of the Student component.
     */
    protected function studentExtendComponens()
    {
        /************ Student READ start ************/
        Event::listen('genuineq.students.student.read.start', function(&$component, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.before.student.read', function(&$component, $id, &$redirectUrl) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the student that needs to be read. */
            $student = $user->profile->students->where('id', $id)->first();

            /** Check if the user has access to the specified student. */
            if (!$student) {
                $redirectUrl = $component->pageUrl(RedirectHelper::accessDenied());
            }
        });
        /************ Student READ end ************/

        /************ Student CREATE start ************/
        Event::listen('genuineq.students.before.student.create.start', function(&$component, $id, &$redirectUrl) {
            /** Extract the user */
            $user = Auth::getUser();

            if (('school' == $user->type) && (!$user->profile->unarchivedSpecialists->count())) {
                $redirectUrl = $component->pageUrl(RedirectHelper::redirectWithMessage(Lang::get('genuineq.esense::lang.components.studentActions.message.access_to_create_student')));
            }
        });

        Event::listen('genuineq.students.student.create.start', function(&$component, $inputs, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.before.student.create', function(&$data, $inputs) {
            /** Add the owner ID to the data. */
            if ('specialist' == Auth::getUser()->type || 'parent' == Auth::getUser()->type) {
                $data['owner_id'] = Auth::user()->profile_id;
            } else {
                $data['owner_id'] = $inputs['owner'];
            }
            $data['owner_type'] = 'Genuineq\Profile\Models\Specialist';
        });

        Event::listen('genuineq.students.after.student.create', function($student) {
            /** Create a specialist connection. */
            $student->specialists()->attach($student->owner_id);
        });


        Event::listen('genuineq.students.before.student.create.finish', function(&$redirectUrl, $student) {
            /** Redirect to all students page. */
            if (in_array(Auth::getUser()->type,['specialist','parent'])) {
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

        Event::listen('genuineq.students.update.before.student.update', function(&$student, $inputs, &$redirectUrl) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the student that needs to be updated. */
            $student = $user->profile->unarchivedStudents->where('id', $inputs['id'])->first();

            /** Check if the user has access to the specified student. */
            if (!$student) {
                $redirectUrl = $component->pageUrl(RedirectHelper::accessDenied());
            }
        });
        /************ Student UPDATE end ************/

        /************ Student ARCHIVE start ************/
        Event::listen('genuineq.students.student.archive.start', function(&$component, $inputs, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.student.before.archive', function(&$student, $inputs, &$redirectUrl) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the student that needs to be archived. */
            $student = $user->profile->unarchivedStudents->where('id', $inputs['id'])->first();

            /** Check if the user has access to the specified student. */
            if (!$student) {
                $redirectUrl = $component->pageUrl(RedirectHelper::accessDenied());
            }
        });
        /************ Student ARCHIVE end ************/

        /************ Student UNZIP start ************/
        Event::listen('genuineq.students.student.unzip.start', function(&$component, $inputs, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.student.before.unzip', function(&$student, $inputs, &$redirectUrl) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the student that needs to be unziped. */
            $student = $user->profile->archivedStudents->where('id', $inputs['id'])->first();

            /** Check if the user has access to the specified student. */
            if (!$student) {
                $redirectUrl = $component->pageUrl(RedirectHelper::accessDenied());
            }
        });
        /************ Student UNZIP end ************/

        /************ Student DELETE start ************/
        Event::listen('genuineq.students.student.delete.start', function(&$component, $inputs, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.students.student.before.delete', function(&$student, $inputs, &$redirectUrl) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the student that needs to be deleted. */
            $student = $user->profile->archivedStudents->where('id', $inputs['id'])->first();

            /** Check if the user has access to the specified student. */
            if (!$student) {
                $redirectUrl = $component->pageUrl(RedirectHelper::accessDenied());
                return;
            }

            /** Remove all student lessons. */
            foreach ($student->lessons as $key => $lesson) {
                $lesson->delete();
            }

            /** Remove all student connections. */
            foreach($student->connections as $key => $connection) {
                $connection->delete();
            }

            /** Remove all student access requests. */
            foreach($student->accessRequests as $key => $accessRequest) {
                $accessRequest->delete();
            }

            /** Remove all student transfer requests. */
            foreach($student->transferRequests as $key => $transferRequest) {
                $transferRequest->delete();
            }

            /** Remove all specialists connections. */
            // $student->specialists()->detach();
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
            /** Link "Student" model to "School" model with one-to-many relation. */
            $model->morphMany['myStudents'] = ['Genuineq\Students\Models\Student', 'name' => 'owner'];

            /** Link "Student" model to archived "School" model with one-to-many relation. */
            $model->morphMany['myUnarchivedStudents'] = [
                'Genuineq\Students\Models\Student',
                'name' => 'owner',
                'conditions' => 'archived = 0'
            ];

            /** Link "Student" model to archived "School" model with one-to-many relation. */
            $model->morphMany['myArchivedStudents'] = [
                'Genuineq\Students\Models\Student',
                'name' => 'owner',
                'conditions' => 'archived = 1'
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

                /** Parse all students from the active specialists. */
                foreach ($model->active_specialists as $specialist) {
                    $students = $students->merge($specialist->students);
                }

                /** Parse all students from the archived specialists.  */
                foreach ($model->archivedSpecialists as $specialist) {
                    $students = $students->merge($specialist->students);
                }

                /** Add the school students. */
                $students = $students->merge($model->myStudents);

                return $students->unique('id')->sortBy('name');
            });

            /** Add unarchived students attribute. */
            $model->addDynamicMethod('getUnarchivedStudentsAttribute', function() use ($model) {
                $unarchivedStudents = new Collection();

                /** Parse all students from the active specialists. */
                foreach ($model->active_specialists as $specialist) {
                    $unarchivedStudents = $unarchivedStudents->merge($specialist->unarchivedStudents);
                }

                /** Parse all the students from the archived specialists.  */
                foreach ($model->archivedSpecialists as $specialist) {
                    $unarchivedStudents = $unarchivedStudents->merge($specialist->unarchivedStudents);
                }

                /** Add the school students. */
                $unarchivedStudents = $unarchivedStudents->merge($model->myUnarchivedStudents);

                return $unarchivedStudents->unique('id')->sortBy('name');
            });

            /** Add archived students attribute. */
            $model->addDynamicMethod('getArchivedStudentsAttribute', function() use ($model) {
                $archivedStudents = new Collection();

                /** Parse all students from the active specialists. */
                foreach ($model->active_specialists as $specialist) {
                    $archivedStudents = $archivedStudents->merge($specialist->archivedStudents);
                }

                /** Parse all the students from the archived specialists.  */
                foreach ($model->archivedSpecialists as $specialist) {
                    $archivedStudents = $archivedStudents->merge($specialist->archivedStudents);
                }

                /** Add the school students. */
                $archivedStudents = $archivedStudents->merge($model->myArchivedStudents);

                return $archivedStudents->unique('id')->sortBy('name');
            });

            /** Add get month lessons duration function. */
            $model->addDynamicMethod('getMonthLessonsDuration', function($month, $year = null) use ($model) {
                $duration = 0;

                if (!$year) {
                    $year = Carbon::now()->year;
                }

                /** Parse all the active specialists. */
                foreach ($model->active_specialists as $specialist) {
                    $duration += $specialist->getMonthLessonsDuration($month, $year);
                }

                return $duration;
            });

            /** Add get year lessons durations tooltips function. */
            $model->addDynamicMethod('getYearLessonsDurations', function($year = null) use ($model) {
                if (!$year) {
                    $year = Carbon::now()->year;
                }

                /** Extract the raw durations. */
                $durations = [
                    0 => $model->getMonthLessonsDuration(1, $year),   // Jan
                    1 => $model->getMonthLessonsDuration(2, $year),   // Feb
                    2 => $model->getMonthLessonsDuration(3, $year),   // Mar
                    3 => $model->getMonthLessonsDuration(4, $year),   // Apr
                    4 => $model->getMonthLessonsDuration(5, $year),   // May
                    5 => $model->getMonthLessonsDuration(6, $year),   // Jun
                    6 => $model->getMonthLessonsDuration(7, $year),   // Jul
                    7 => $model->getMonthLessonsDuration(8, $year),   // Aug
                    8 => $model->getMonthLessonsDuration(9, $year),   // Sep
                    9 => $model->getMonthLessonsDuration(10, $year),  // Oct
                    10 => $model->getMonthLessonsDuration(11, $year), // Nov
                    11 => $model->getMonthLessonsDuration(12, $year)  // Dec
                ];

                /** Calculate the values. */
                $values = [
                    0 => ($durations[0] / 3600),   // Jan
                    1 => ($durations[1] / 3600),   // Feb
                    2 => ($durations[2] / 3600),   // Mar
                    3 => ($durations[3] / 3600),   // Apr
                    4 => ($durations[4] / 3600),   // May
                    5 => ($durations[5] / 3600),   // Jun
                    6 => ($durations[6] / 3600),   // Jul
                    7 => ($durations[7] / 3600),   // Aug
                    8 => ($durations[8] / 3600),   // Sep
                    9 => ($durations[9] / 3600),  // Oct
                    10 => ($durations[10] / 3600), // Nov
                    11 => ($durations[11] / 3600)  // Dec
                ];

                /** Calculate the tooltips in HH:MM:SS format. */
                $tooltips = [];
                for ($index = 0; $index < count($durations); $index++) {
                    $h = floor($durations[$index] / 3600);
                    $m = floor(($durations[$index] % 3600) / 60);
                    $s = ceil(($durations[$index] % 3600) % 60);

                    $h = (10 > $h) ? ('0' . $h) : ($h);
                    $m = (10 > $m) ? ('0' . $m) : ($m);
                    $s = (10 > $s) ? ('0' . $s) : ($s);

                    $tooltips[$index] = $h . ':' . $m . ':' . $s;
                }

                return [ 'values' => $values, 'tooltips' => $tooltips ];
            });

            /** Add get lessons years attribute. */
            $model->addDynamicMethod('getLessonsYearsAttribute', function () use ($model) {
                /** Get all active specialists. */
                $specialists = $model->active_specialists;
                $years = [];

                /** Parse all student lessons. */
                foreach ($specialists as $specialist) {
                    $years = array_merge($years, $specialist->lessons_years);
                }

                return array_unique($years);
            });
        });
    }

    /**
     * Function that contains all the component extensions of the School model.
     */
    protected function schoolExtendComponens()
    {
        /************ School DELETE start ************/
        Event::listen('genuineq.profile.school.before.delete', function($school) {

            /** Delete school specialists. */
            foreach($school->specialists as $specialist) {
                /** Remove school connection with specialist. */
                $specialist->school_id = null;

                /** Identify all the stundets that the specialist has access to and does NOT own them. */
                $foreignStudents = $specialist->students->diff($specialist->myStudents);

                /** Remove connections to all foreign students. */
                foreach ($foreignStudents as $foreignStudent) {
                    $specialist->students()->remove($foreignStudent);
                }

                $specialist->save();
            }

            /** Delete school students. */
            foreach($school->myStudents as $student) {
                $student->delete();
            }
        });
        /************ School DELETE end ************/
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
                'table' => 'genuineq_esense_students_specialists'
            ];

            /** Link "TransferRequest" model to "Specialist" model with one-to-many relation. */
            $model->hasMany['transferRequests'] = ['Genuineq\Esense\Models\TransferRequest', 'key' => 'from_specialist_id'];

            /** Link "AccessRequest" model to "Specialist" model with one-to-many relation. */
            $model->hasMany['accessRequests'] = ['Genuineq\Esense\Models\AccessRequest', 'key' => 'from_specialist_id'];

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
                /** Extract all school students. */
                $schoolStudents = $model->school->students;

                /** Remove from school students all students of the current specialist. */
                foreach ($model->students as $specialistStudent) {
                    foreach ($schoolStudents as $key => $schoolStudent) {
                        if ($schoolStudent->id == $specialistStudent->id) {
                            $schoolStudents->forget($key);
                        }
                    }
                }

                return $schoolStudents;
            });

            /** Add unarchived students attribute. */
            $model->addDynamicMethod('getUnarchivedStudentsAttribute', function() use ($model) {
                $unarchivedStudents = new Collection();

                /** Parse all the students and extract unarchived ones. */
                foreach ($model->students as $student) {
                    if (!$student->archived) {
                        $unarchivedStudents->push($student);
                    }
                }

                return $unarchivedStudents->unique('id')->sortBy('name');
            });

            /** Add archived students attribute. */
            $model->addDynamicMethod('getArchivedStudentsAttribute', function() use ($model) {
                $archivedStudents = new Collection();

                /** Parse all the students and extract archived ones. */
                foreach ($model->students as $student) {
                    if ($student->archived) {
                        $archivedStudents->push($student);
                    }
                }

                return $archivedStudents->unique('id')->sortBy('name');
            });

            /** Add access notifications attribute. */
            $model->addDynamicMethod('getAccessRequestsAttribute', function() use ($model) {
                return $model->accessRequests()->whereSeen(false)->whereApproved(false)->get();
            });

            /** Add transfer notifications attribute. */
            $model->addDynamicMethod('getTransferRequestsAttribute', function() use ($model) {
                return $model->transferRequests()->whereNull('approved')->get();
            });

            /** Add today lessons attribute. */
            $model->addDynamicMethod('getTodayLessonsAttribute', function() use ($model) {
                return $model->lessons()->where('day', Carbon::now()->format('Y-m-d'))->get();
            });

            /** Add today lessons function. */
            $model->addDynamicMethod('getDateLessons', function($date) use ($model) {
                return $model->lessons()->where('day', Carbon::parse($date)->format('Y-m-d'))->get();
            });

            /** Add get connection function. */
            $model->addDynamicMethod('getStudentConnection', function($student) use ($model) {
                return $model->connections()->where('student_id', $student)->first();
            });

            /** Add get month lessons duration function. */
            $model->addDynamicMethod('getMonthLessonsDuration', function($month, $year = null) use ($model) {
                if (!$year) {
                    $year = Carbon::now()->year;
                }

                /** Extract the start and the end of the month. */
                $monthStart = Carbon::parse($year . '-' . $month . '-01')->format('Y-m-d');
                $monthEnd = Carbon::parse($year . '-' . $month . '-01')->endOfMonth()->format('Y-m-d');

                return ($model->lessons()->whereBetween('day', [$monthStart, $monthEnd])->sum('duration'));
            });

            /** Add get year lessons durations values and tooltips function. */
            $model->addDynamicMethod('getYearLessonsDurations', function($year = null) use ($model) {
                if (!$year) {
                    $year = Carbon::now()->year;
                }

                /** Extract the raw durations. */
                $durations = [
                    0 => $model->getMonthLessonsDuration(1, $year),   // Jan
                    1 => $model->getMonthLessonsDuration(2, $year),   // Feb
                    2 => $model->getMonthLessonsDuration(3, $year),   // Mar
                    3 => $model->getMonthLessonsDuration(4, $year),   // Apr
                    4 => $model->getMonthLessonsDuration(5, $year),   // May
                    5 => $model->getMonthLessonsDuration(6, $year),   // Jun
                    6 => $model->getMonthLessonsDuration(7, $year),   // Jul
                    7 => $model->getMonthLessonsDuration(8, $year),   // Aug
                    8 => $model->getMonthLessonsDuration(9, $year),   // Sep
                    9 => $model->getMonthLessonsDuration(10, $year),  // Oct
                    10 => $model->getMonthLessonsDuration(11, $year), // Nov
                    11 => $model->getMonthLessonsDuration(12, $year)  // Dec
                ];

                /** Calculate the values. */
                $values = [
                    0 => ($durations[0] / 3600),   // Jan
                    1 => ($durations[1] / 3600),   // Feb
                    2 => ($durations[2] / 3600),   // Mar
                    3 => ($durations[3] / 3600),   // Apr
                    4 => ($durations[4] / 3600),   // May
                    5 => ($durations[5] / 3600),   // Jun
                    6 => ($durations[6] / 3600),   // Jul
                    7 => ($durations[7] / 3600),   // Aug
                    8 => ($durations[8] / 3600),   // Sep
                    9 => ($durations[9] / 3600),  // Oct
                    10 => ($durations[10] / 3600), // Nov
                    11 => ($durations[11] / 3600)  // Dec
                ];

                /** Calculate the tooltips in HH:MM:SS format. */
                $tooltips = [];
                for ($index = 0; $index < count($durations); $index++) {
                    $h = floor($durations[$index] / 3600);
                    $m = floor(($durations[$index] % 3600) / 60);
                    $s = ceil(($durations[$index] % 3600) % 60);

                    $h = (10 > $h) ? ('0' . $h) : ($h);
                    $m = (10 > $m) ? ('0' . $m) : ($m);
                    $s = (10 > $s) ? ('0' . $s) : ($s);

                    $tooltips[$index] = $h . ':' . $m . ':' . $s;
                }

                return [ 'values' => $values, 'tooltips' => $tooltips ];
            });

            /** Add get lessons years attribute. */
            $model->addDynamicMethod('getLessonsYearsAttribute', function() use ($model) {
                return $model->lessons->unique(function($item) {
                    return $item['day']->year;
                })->map(function($item) {
                    return $item['day']->year;
                })->sort()->toArray();
            });

            /** Add get lessons from specific month method. */
            $model->addDynamicMethod('getLessonsFromMonth', function($student, $month = null, $year = null) use ($model) {
                /** Extract the start and the end of the year. */
                $monthStart = Carbon::parse(($year ?? Carbon::now()->year) . '-' . ($month ?? Carbon::now()->month) . '-01')->format('Y-m-d');
                $monthEnd = Carbon::parse(($year ?? Carbon::now()->year) . '-' . ($month ?? Carbon::now()->month) . '-01')->endOfMonth()->format('Y-m-d');

                /** get connections for lessons */
                $connection = $model->getStudentConnection($student->id);

                /** return lessons with a specific student */
                return $connection->lessons()->whereBetween('day', [$monthStart, $monthEnd])->get();
            });


            /** Add get exercises categories attribute. */
            $model->addDynamicMethod('getExercisesCategoriesAttribute', function() use ($model) {
                /** Get games parent category. */
                $games = ExerciseCategory::whereSlug('jocuri')->first();

                return $games->getChildren();
            });

            /** Add get exercises number function. */
            $model->addDynamicMethod('getExercisesNumber', function() use ($model) {
                $exercisesCount = 0;

                /** Parse all games categories and count the exercises. */
                foreach ($model->exercises_categories as $key => $exerciseCategory) {
                    $exercisesCount += $exerciseCategory->records->count();
                }

                return $exercisesCount;
            });

            /** Add get game category lessons duration function. */
            $model->addDynamicMethod('getStudentCategoryLessonsDuration', function($student, $category) use ($model) {
                /** Get student connection. */
                $connection = $model->getStudentConnection($student);
                /** Get current year. */
                $year = Carbon::now()->year;

                /** Extract the duration of all the lessons during current year from the specified category. */
                return ($connection->lessons()->whereCategory($category)->whereYear('day', $year)->sum('duration')) / 3600;
            });

            /** Add get game category lessons duration tooltip function. */
            $model->addDynamicMethod('getStudentCategoryLessonsDurationTooltip', function($student, $category) use ($model) {
                /** Get student connection. */
                $connection = $model->getStudentConnection($student);
                /** Get current year. */
                $year = Carbon::now()->year;

                /** Extract the duration of all the lessons during current year from the specified category. */
                $duration = $connection->lessons()->whereCategory($category)->whereYear('day', $year)->sum('duration');

                /** Calculate the tooltip in HH:MM:SS format. */
                $h = floor($duration / 3600);
                $m = floor(($duration % 3600) / 60);
                $s = ceil(($duration % 3600) % 60);

                $h = (10 > $h) ? ('0' . $h) : ($h);
                $m = (10 > $m) ? ('0' . $m) : ($m);
                $s = (10 > $s) ? ('0' . $s) : ($s);

                return $h . ':' . $m . ':' . $s;
            });

            /** Add get student lessons count function. */
            $model->addDynamicMethod('getStudentLessonsCount', function($student) use ($model) {
                /** Get student connection. */
                $connection = $model->getStudentConnection($student);
                /** Get current year. */
                $year = Carbon::now()->year;

                /** Extract the duration of all the lessons during current year from the specified category. */
                return $connection->lessons()->whereYear('day', $year)->count();
            });

            /** Add get category color function. */
            $model->addDynamicMethod('getCategoryColor', function($category) use ($model) {
                return ("#" . substr(dechex(crc32($category)), 0, 6));
            });
        });
    }

    /**
     * Function that contains all the component extensions of the Specialist component.
     */
    protected function specialistExtendComponens()
    {
        /************ Specialist READ start ************/
        Event::listen('genuineq.specialists.read.start', function(&$component, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.specialists.before.specialist.read', function(&$component, $id, &$redirectUrl) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract the specialist that needs to be read. */
            $specialist = $user->profile->specialists->where('id', $id)->first();

            /** Check if the user has access to the specified specialist. */
            if (!$specialist) {
                $redirectUrl = $component->pageUrl(RedirectHelper::accessDenied());
            }
        });
        /************ Specialist READ end ************/

        /************ Specialist DELETE start ************/
        Event::listen('genuineq.profile.specialist.before.delete', function($specialist) {
            foreach($specialist->myStudents as $student) {
                if ($specialist->school) {
                    /** Change the student owner from specialist to school if specialist is afiliated. */
                    $student->owner_id = $specialist->school_id;
                    $student->owner_type = 'Genuineq\Profile\Models\School';
                    $student->save();
                } else {
                    /** Delete the student if specialist is unafiliated. */
                    $student->delete();
                }
            }

            /** Delete specialist lessons. */
            foreach($specialist->lessons as $key => $lesson) {
                $lesson->delete();
            }

            /** Delete specialist connection. */
            foreach($specialist->connections as $key => $connection) {
                $connection->delete();
            }

            /** Delete specialist transfer requests. */
            foreach($specialist->transferRequests as $key => $transferRequests) {
                $transferRequests->delete();
            }

            /** Delete specialist access requests. */
            foreach($specialist->accessRequests as $key => $accessRequests) {
                $accessRequests->delete();
            }

        });
        /************ Specialist DELETE end ************/
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

    /**
     * Function that contains all the component extensions of the LessonActions component.
     */
    protected function lessonExtendComponens()
    {
        /************ LessonActions READ start ************/
        Event::listen('genuineq.lessons.read.start', function(&$component, &$redirectUrl) {
            if (!Auth::check()) {
                $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
            }
        });

        Event::listen('genuineq.lessons.before.lesson.read', function(&$component, $id, &$redirectUrl) {
            /** Extract the user */
            $user = Auth::getUser();

            /** Extract lesson. */
            $lesson = Lesson::find($id);

            /** Check if the lesson exists. */
            if (!$lesson) {
                $redirectUrl = $component->pageUrl(RedirectHelper::accessDenied());
                return;
            }

            if ('specialist' == $user->type) {
                /** Extract the connection that needs to be read. */
                $connection = $user->profile->connections->where('id', $lesson->connection->id)->first();

                /** Check if the user has access to the specified connection. */
                if (!$connection) {
                    $redirectUrl = $component->pageUrl(RedirectHelper::accessDenied());
                }
            } else {
                /** Extract the specialist that has the lesson connection. */
                $specialist = ($user->profile->specialists) ? $user->profile->specialists->where('id', $lesson->connection->specialist_id)->first() :$user;

                /** Check if the user has access to the specified specialist. */
                if (!$specialist) {
                    $redirectUrl = $component->pageUrl(RedirectHelper::accessDenied());
                }
            }
        });
        /************ LessonActions READ end ************/
    }


    /***********************************************
     ******** SmallRecords plugin extension *******
     ***********************************************/

    /** Extend JanVince\SmallRecords Plugin to set Permissions to Tags and Attributes sideMenuItems. */
    public function smallRecordsPluginExtend(){

        /** Check if user have specific rights and remove sideMenuItems. */
        Event::listen('backend.menu.extendItems', function ($manager) {
            /** Get current logged in user and its role. */
            $loggedInUser = \Backend\Facades\BackendAuth::getUser();

            /** Check if it has a 'Publisher' role. */
            if(/*NOT*/ ! ('Developer' == $loggedInUser->role->name)) {
                $manager->removeSideMenuItem('JanVince.SmallRecords', 'SmallRecords', 'tags');
                $manager->removeSideMenuItem('JanVince.SmallRecords', 'SmallRecords', 'attributes');
            }
        });

        \JanVince\SmallRecords\Controllers\Tags::extend(function ($controller){
            $controller->requiredPermissions = ['genuineq.esense.smallrecords_access'];
        });

        \JanVince\SmallRecords\Controllers\Attributes::extend(function ($controller){
            $controller->requiredPermissions = ['genuineq.esense.smallrecords_access'];
        });

    }

    /***********************************************
     ******** Rainlab\Pages plugin extension *******
     ***********************************************/

    /** Extend Rainlab\Pages Plugin to set Permissions to form fields */
    public function staticPagesPluginExtend() {

        Event::listen('backend.page.beforeDisplay', function($controller) {
            /** Check if it is RainLab\Pages Index controller  */
            if (/*NOT*/ ! $controller instanceof  \RainLab\Pages\Controllers\Index) {
                return;
            }

            /** Get current logged in user and its role. */
            $loggedInUser = \Backend\Facades\BackendAuth::getUser();

            if('Developer' !== $loggedInUser->role->name) {
                /**
                 * jQuery selector for disabling 'add' and 'delete' buttons, 'checkboxes'
                 *  and 'Add subpage' in Rainlab\Pages.
                 */
                $controller->addJs('/themes/esense/assets/js/static-pages-remove-items.js');
            }
        });

        /** HIDE FIELDS for non-developers */
        Event::listen('backend.form.extendFields', function($widget) {

            /** Check if it is RainLab\Pages Index controller  */
            if (/*NOT*/ ! $widget->getController() instanceof  \RainLab\Pages\Controllers\Index) {
                return;
            }

            /** Get current logged in user and its role. */
            $loggedInUser = \Backend\Facades\BackendAuth::getUser();

            /** Check if it has a 'Publisher' role. */
            if('Developer' !== $loggedInUser->role->name) {
                $fields = $widget->getFields();

                $fields['viewBag[title]']->cssClass = 'hidden';
                $fields['viewBag[url]']->cssClass = 'hidden';
                $fields['viewBag[layout]']->cssClass = 'hidden';
                $fields['viewBag[is_hidden]']->cssClass = 'hidden';
                $fields['viewBag[navigation_hidden]']->cssClass = 'hidden';
            }
        });
    }

}
