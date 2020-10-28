<?php namespace Genuineq\Addresses;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Genuineq\Addresses\Components\Addresses' => 'addresses'
        ];
    }

    public function registerSettings()
    {
    }

    /***********************************************
     *************** Form widgets *******************
     ***********************************************/

    public function registerFormWidgets()
    {
        return [
            'Genuineq\Addresses\FormWidgets\Addresses' => [
                'label' => 'Addresses Tag Relation field',
                'code' => 'addresses'
            ],
        ];
    }
}
