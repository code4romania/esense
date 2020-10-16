<?php namespace Genuineq\Timetable;

use System\Classes\PluginBase;


/**
 * Class Plugin
 * @package Genuineq\Timetable
 */
class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Timetable',
            'description' => 'Timetable for sessions scheduling',
            'author'      => 'genuineq',
            'icon'        => 'oc-icon-calendar'
        ];
    }

    public function registerComponents()
    {
        return [
            'Genuineq\Timetable\Components\Timetable' => 'Timetable'
        ];
    }

    public function registerSettings()
    {
    }

}
