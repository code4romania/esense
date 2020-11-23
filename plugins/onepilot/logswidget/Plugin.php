<?php namespace OnePilot\LogsWidget;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'onepilot.logswidget::lang.plugin.name',
            'description' => 'onepilot.logswidget::lang.plugin.description',
            'author'      => '1Pilot.io',
            'icon'        => 'icon-file-text-o',
            'homepage'    => 'https://1pilot.io',
        ];
    }

    /**
     * @return array
     */
    public function registerReportWidgets()
    {
        return [
            ReportWidgets\ErrorsOverview::class => [
                'label'       => 'onepilot.logswidget::lang.reportwidgets.label',
                'context'     => 'dashboard',
                'permissions' => ['system.access_logs'],
            ],
        ];
    }
}
