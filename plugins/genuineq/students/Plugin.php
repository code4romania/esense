<?php namespace Genuineq\Students;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /** Function for registering Students component. */
    public function registerComponents()
    {
        return [
            \Genuineq\Students\Components\Students::class => 'students'
        ];
    }

    public function registerSettings()
    {
    }
}