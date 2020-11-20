<?php namespace Walid\DiskUsage;

use Backend;
use System\Classes\PluginBase;

/**
* DiskUsage Plugin Information File
*/
class Plugin extends PluginBase
{

    /**
    * Register method, called when the plugin is first registered.
    *
    * @return void
    */
    public function register()
    {

    }

    /**
    * Boot method, called right before the request route.
    *
    * @return array
    */
    public function boot()
    {

    }

    /**
    * Registers any front-end components implemented in this plugin.
    *
    * @return array
    */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'WalidAmmar\DiskUsage\Components\MyComponent' => 'myComponent',
        ];
    }

    public function registerReportWidgets()
    {
        return [
            ReportWidgets\DiskUsage::class => [
                'label'   => 'walid.diskusage::lang.reportwidgets.label',
                'context' => 'dashboard'
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'walid.diskusage::lang.plugin.name',
                'description' => 'walid.diskusage::lang.plugin.description',
                'category'    => 'System',
                'icon'        => 'icon-cog',
                'class'       => Models\Settings::class,
                'order'       => 500,
                'keywords'    => 'free disk space usage',
                'permissions' => []
            ]
        ];
    }
}
