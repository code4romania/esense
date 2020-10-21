<?php namespace Genuineq\Esense;

use Log;
use Auth;
use Event;
use Genuineq\User\Helpers\RedirectHelper;
use System\Classes\PluginBase;
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
        $this->studentExtendComponens();

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
                'specialist_id'
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
            $model->belongsTo['owner'] = ['Genuineq\Profile\Models\Specialist', 'key' => 'specialist_id'];

            /** Link "Specialist" model to "Student" model with many-to-many relation. */
            $model->belongsToMany['specialists'] = ['Genuineq\Profile\Models\Specialist', 'table' => 'genuineq_esense_students_specialists'];
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
            $data['specialist_id'] = Auth::user()->profile->id;
        });

        Event::listen('genuineq.students.create.after.student.create', function($student) {
            /** Create a specialist connection. */
            $student->specialists()->attach(Auth::user()->profile->id);
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
            $model->hasMany['myStudents'] = 'Genuineq\Students\Models\Student';

            /** Link "Student" model to "Specialist" model with many-to-many relation. */
            $model->belongsToMany['students'] = ['Genuineq\Students\Models\Student', 'table' => 'genuineq_esense_students_specialists'];
        });
    }
}
