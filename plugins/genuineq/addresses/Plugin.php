<?php namespace Genuineq\Addresses;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Genuineq\Addresses\Components\Addresses' => 'addresses',
            \Genuineq\Esense\Components\LessonsActions::class => 'lessonsActions',
            \Genuineq\Esense\Components\ChartsActions::class => 'chartsActions',
            \Genuineq\Esense\Components\StudentActions::class => 'studentActions',
            \Genuineq\Profile\Components\Specialist::class => 'specialist',




        ];
    }

    public function registerSettings()
    {
    }

    /** Register permission access for users */
    public function registerPermissions()
    {
        return [
            'genuineq.addresses.addresses_access' => [
                'menu' => 'genuineq.addresses::lang.plugin.backend-menu',
                'label' => 'genuineq.addresses::lang.permissions',
                'roles' => ['Developer'],
            ],
        ];
    }


    /***********************************************
     *************** Form widgets *******************
     ***********************************************/

    public function registerFormWidgets()
    {
        return [
            'Genuineq\Addresses\FormWidgets\Addresses' => [
                'label' => 'Addresses Tag Relation field',
                'code' => 'addresses'
            ],
        ];
    }
}
