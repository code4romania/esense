<?php namespace genuineq\initiator;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * @var array   Require the dependency plugins
     */
    public $require = [
        'AjayLulia.OCookie',
        'Rainlab.Translate',
        'Janvince.Smallrecords'
    ];

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
}
