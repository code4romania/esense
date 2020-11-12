<?php namespace Genuineq\Data;

use Event;
use Backend;
use Faker\Factory;
use System\Classes\PluginBase;

/**
 * Faker Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array Require the dependency plugins
     */
    public $require = [
        'Genuineq.User',
        'Genuineq.Profile',
        'Genuineq.Students',
        'Genuineq.Timetable',
        'Genuineq.Esense',
        'Genuineq.ContactForm'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Esense Data',
            'description' => 'Esense data for initial deployment or developing process.',
            'author'      => 'Genuineq',
            'icon'        => 'icon-database'
        ];
    }

    public function boot()
    {
        Event::listen('cms.page.beforeDisplay', function($controller, $url, $page) {
            $controller->vars['fake'] = Factory::create();
        });
    }

}
