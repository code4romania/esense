<?php namespace Genuineq\ContactForm;

use System\Classes\PluginBase;

/**
 * Class Plugin
 * @package Genuineq\ContactForm
 */
class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'genuineq.contactform::lang.plugin.name',
            'description' => 'genuineq.contactform::lang.plugin.description',
            'author'      => 'genuineq',
            'icon'        => 'space-shuttle'
        ];
    }

    public function registerComponents()
    {
        return [
            'Genuineq\ContactForm\Components\ContactForm' => 'contactform'
        ];
    }

    public function registerSettings()
    {
    }
}
