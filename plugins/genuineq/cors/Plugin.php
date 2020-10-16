<?php

namespace Genuineq\Cors;

use Config;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Genuineq\Cors\Models\Settings as PluginSettings;

/**
 * CORS Plugin Information File.
 */
class Plugin extends PluginBase
{
    /**
     * @var boolean Determine if this plugin should have elevated privileges.
     */
    public $elevated = true;

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'genuineq.cors::lang.plugin.name',
            'description' => 'genuineq.cors::lang.plugin.description',
            'author'      => 'Ricardo Lüders',
            'icon'        => 'icon-exchange',
        ];
    }

    /**
     * Register the plugin settings
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'genuineq.cors::lang.settings.menu_label',
                'description' => 'genuineq.cors::lang.settings.menu_description',
                'category'    => SettingsManager::CATEGORY_MISC,
                'icon'        => 'icon-exchange',
                'class'       => 'Genuineq\Cors\Models\Settings',
                'order'       => 600,
                'permissions' => ['genuineq.cors.access_settings'],
            ]
        ];
    }

    /**
     * Register the plugin permissions
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'genuineq.cors.access_settings' => [
                'tab' => 'genuineq.cors::lang.plugin.name',
                'label' => 'genuineq.cors::lang.permissions.settings'
            ]
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Genuineq\Cors\Providers\CorsServiceProvider::class);
        $this->app['router']->middleware('cors', \Barryvdh\Cors\HandleCors::class);
        $this->app['router']->prependMiddlewareToGroup('api', \Barryvdh\Cors\HandleCors::class);
    }
}
