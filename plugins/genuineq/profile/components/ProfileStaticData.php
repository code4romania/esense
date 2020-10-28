<?php namespace Genuineq\Profile\Components;

use Log;
use Lang;
use Cms\Classes\ComponentBase;
use Genuineq\Profile\Models\School;

/**
 * Profile static data component
 *
 * Allows to extract profile static data.
 */
class ProfileStaticData extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.profile::lang.components.profile-static-data.name',
            'description' => 'genuineq.profile::lang.components.profile-static-data.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'schools' => [
                 'title'       => 'genuineq.profile::lang.components.profile-static-data.property.schools_title',
                 'description' => 'genuineq.profile::lang.components.profile-static-data.property.schools_description',
                 'default'     => false,
                 'type'        => 'checkbox',
            ],
        ];
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
        if ($this->property('schools')) {
            /** Extract all registered schools. */
            $schools = [];
            foreach (school::select('id', 'name')->get() as $school) {
                $schools[$school->id] = $school->name;
            }
            $this->page['schools'] = $schools;
        }
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        $this->prepareVars();
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

}
