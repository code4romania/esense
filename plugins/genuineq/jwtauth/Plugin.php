<?php

namespace Genuineq\JWTAuth;

use Config;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Genuineq\JWTAuth\Models\Settings as PluginSettings;

/**
 * JWTAuth Plugin Information File.
 */
class Plugin extends PluginBase
{
    /**
     * Plugin dependencies.
     *
     * @var array
     */
    public $require = [
        'Genuineq.User'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'genuineq.jwtauth::lang.plugin.name',
            'description' => 'genuineq.jwtauth::lang.plugin.description',
            'author'      => 'Genuineq',
            'icon'        => 'icon-user-secret',
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
                'label'       => 'genuineq.jwtauth::lang.settings.menu_label',
                'description' => 'genuineq.jwtauth::lang.settings.menu_description',
                'category'    => SettingsManager::CATEGORY_USERS,
                'icon'        => 'icon-user-secret',
                'class'       => 'Genuineq\JWTAuth\Models\Settings',
                'order'       => 600,
                'permissions' => ['genuineq.jwtauth.access_settings'],
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
            'genuineq.jwtauth.access_settings' => [
                'tab' => 'genuineq.jwtauth::lang.plugin.name',
                'label' => 'genuineq.jwtauth::lang.permissions.settings'
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
        $this->app->register(\Genuineq\JWTAuth\Providers\AuthServiceProvider::class);
        $this->app->alias('JWTAuth', \Genuineq\JWTAuth\Facades\JWTAuth::class);
    }
}
