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
            'name'        => 'genuineq.timetable::lang.plugin.name',
            'description' => 'genuineq.timetable::lang.plugin.description',
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
