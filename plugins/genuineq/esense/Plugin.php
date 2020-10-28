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

    /** Function for registering Esense component. */
    public function registerComponents()
    {
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
            $model->belongsToMany['specialists'] = ['Genuineq\Profile\Models\Specialist', 'table' => 'genuineq_esense_students_specialists'];
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

        Event::listen('genuineq.students.update.before.student.update', function(&$data, $inputs) {
            /** Add the owner ID to the data. */
            if ('specialist' == Auth::getUser()->type) {
                $data['owner_id'] = Auth::user()->profile->id;
            } else {
                $data['owner_id'] = $inputs['owner'];
            }
            $data['owner_type'] = 'Genuineq\Profile\Models\Specialist';
        });
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

                /** Parse all the in specialists.  */
                foreach ($model->active_specialists as $specialist) {
                    $students = $students->merge($specialist->students);
                }

                return $students;
            });

            /** Add archived students attribute. */
            $model->addDynamicMethod('getArchivedStudentsAttribute', function() use ($model) {
                $archivedStudents = new Collection();

                /** Parse all the in specialists.  */
                foreach ($model->active_specialists as $specialist) {
                    $archivedStudents = $archivedStudents->merge($specialist->archivedStudents);
                }

                /** Parse all the in archived specialists.  */
                foreach ($model->archivedSpecialists as $specialist) {
                    $archivedStudents = $archivedStudents->merge($specialist->archivedStudents);
                }

                return $archivedStudents;
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
                'order' => 'name asc',
                'conditions' => 'archived = 0'
            ];

            /** Link "Student" model to archived "Specialist" model with many-to-many relation. */
            $model->belongsToMany['archivedStudents'] = [
                'Genuineq\Students\Models\Student',
                'table' => 'genuineq_esense_students_specialists',
                'order' => 'name asc',
                'conditions' => 'archived = 1'
            ];
        });
    }
}
