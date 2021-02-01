<?php namespace Genuineq\Students;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /** Function for registering Students component. */
    public function registerComponents()
    {
        return [
            \Genuineq\Students\Components\Student::class => 'student'
        ];
    }

    /** Register permission access for users */
    public function registerPermissions()
    {
        return [
            'genuineq.students.students_access' => [
                'menu' => 'genuineq.students::lang.plugin.backend-menu',
                'label' => 'genuineq.students::lang.permissions',
                'roles' => ['Developer'],
            ],
        ];
    }

    public function registerSettings()
    {
    }
}
