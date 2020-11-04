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
            'icon'        => 'oc-icon-space-shuttle'
        ];
    }

    /***********************************************
     ******** Register plugin components ***********
     ***********************************************/

    public function registerComponents()
    {
        return [
            'Genuineq\ContactForm\Components\ContactForm' => 'contactform'
        ];
    }

    /***********************************************
     ********** Register report widgets ************
     ***********************************************/

    public function registerReportWidgets()
    {
        return [
            'Genuineq\ContactForm\ReportWidgets\TotalMessages' => [
                'label'   => 'genuineq.contactform::lang.reportwidgets.total_messages.label',
                'context' => 'dashboard',
            ],
        ];
    }


    public function registerSettings()
    {
    }
}
