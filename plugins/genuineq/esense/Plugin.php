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
            $student->specialists()->attach($student->owner_id);
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
            $student = $user->profile->unarchivedStudents->where('id', $inputs['id'])->first();
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
            $student = $user->profile->unarchivedStudents->where('id', $inputs['id'])->first();
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

            /** Add get year lessons durations function. */
            $model->addDynamicMethod('getYearLessonsDurations', function($year = null) use ($model) {
                $durations = [
                    0 => 0,  // Jan
                    1 => 0,  // Feb
                    2 => 0,  // Mar
                    3 => 0,  // Apr
                    4 => 0,  // May
                    5 => 0,  // Jun
                    6 => 0,  // Jul
                    7 => 0,  // Aug
                    8 => 0,  // Sep
                    9 => 0,  // Oct
                    10 => 0, // Nov
                    11 => 0  // Dec
                ];

                if (!$year) {
                    $year = Carbon::now()->year;
                }

                /** Parse all the active specialists. */
                foreach ($model->active_specialists as $specialist) {
                    $specialistDurations = $specialist->getYearLessonsDurations($year);

                    $durations[0] += $specialistDurations[0];   // Jan
                    $durations[1] += $specialistDurations[1];   // Feb
                    $durations[2] += $specialistDurations[2];   // Mar
                    $durations[3] += $specialistDurations[3];   // Apr
                    $durations[4] += $specialistDurations[4];   // May
                    $durations[5] += $specialistDurations[5];   // Jun
                    $durations[6] += $specialistDurations[6];   // Jul
                    $durations[7] += $specialistDurations[7];   // Aug
                    $durations[8] += $specialistDurations[8];   // Sep
                    $durations[9] += $specialistDurations[9];   // Oct
                    $durations[10] += $specialistDurations[10]; // Nov
                    $durations[11] += $specialistDurations[11]; // Dec
                }

                return $durations;
            });

            /** Add get lessons years attribute. */
            $model->addDynamicMethod('getLessonsYearsAttribute', function() use ($model) {
               $years = [];

                /** Parse all the active specialists. */
                foreach ($model->active_specialists as $specialist) {
                    $years = array_unique(array_merge($years, $specialist->lessons_years), SORT_REGULAR);
                }

                return $years;
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

            /** Delete school students. */
            foreach($school->myStudents as $student) {
                /** Check if contact person 1 is defined. */
                if($student->contact_person_1){
                    $student->contact_person_1->delete();
                }
                /** Check if contact person 2 is defined. */
                if($student->contact_person_2){
                    $student->contact_person_2->delete();
                }
                /** Check if contact person 3 is defined. */
                if($student->contact_person_3){
                    $student->contact_person_3->delete();
                }
                /** Check if contact person 4 is defined. */
                if($student->contact_person_4){
                    $student->contact_person_4->delete();
                }
                /** Check if contact person 5 is defined. */
                if($student->contact_person_5){
                    $student->contact_person_5->delete();
                }
                $student->delete();
            }

            /** Delete school specialists. */
            foreach($school->specialists as $specialist) {
                $specialist->delete();
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

            /** Link "Student" model to archived "Specialist" model with many-to-many relation. */
            $model->belongsToMany['unarchivedStudents'] = [
                'Genuineq\Students\Models\Student',
                'table' => 'genuineq_esense_students_specialists',
                'conditions' => 'archived = 0'
            ];

            /** Link "Student" model to archived "Specialist" model with many-to-many relation. */
            $model->belongsToMany['archivedStudents'] = [
                'Genuineq\Students\Models\Student',
                'table' => 'genuineq_esense_students_specialists',
                'conditions' => 'archived = 1'
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

                return ($model->lessons()->whereBetween('day', [$monthStart, $monthEnd])->sum('duration')) / 3600;
            });

            /** Add get year lessons durations function. */
            $model->addDynamicMethod('getYearLessonsDurations', function($year = null) use ($model) {
                if (!$year) {
                    $year = Carbon::now()->year;
                }

                return [
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
            $model->addDynamicMethod('getLessonsFromMonth', function($month = null, $year = null) use ($model) {
                /** Extract the start and the end of the month. */
                $monthStart = Carbon::parse(($year ?? Carbon::now()->year) . '-' . ($month ?? Carbon::now()->month) . '-01')->format('Y-m-d');
                $monthEnd = Carbon::parse(($year ?? Carbon::now()->year) . '-' . ($month ?? Carbon::now()->month) . '-01')->endOfMonth()->format('Y-m-d');

                return $model->lessons()->whereBetween('day', [$monthStart, $monthEnd])->orderBy('day', 'DESC')->get();
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
        /************ Specialist DELETE start ************/
        Event::listen('genuineq.profile.specialist.before.delete', function($specialist) {
            foreach($specialist->myStudents as $student) {
                if ($specialist->school) {
                    /** Change the student owner from specialist to school if specialist is afiliated. */
                    $student->owner_id = $specialist->school_id;
                    $student->owner_type = 'Genuineq\Profile\Models\School';
                    $student->save();
                } else {
                    /** Check if contact person 1 is defined. */
                    if($student->contact_person_1){
                        $student->contact_person_1->delete();
                    }
                    /** Check if contact person 2 is defined. */
                    if($student->contact_person_2){
                        $student->contact_person_2->delete();
                    }
                    /** Check if contact person 3 is defined. */
                    if($student->contact_person_3){
                        $student->contact_person_3->delete();
                    }
                    /** Check if contact person 4 is defined. */
                    if($student->contact_person_4){
                        $student->contact_person_4->delete();
                    }
                    /** Check if contact person 5 is defined. */
                    if($student->contact_person_5){
                        $student->contact_person_5->delete();
                    }
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
}
