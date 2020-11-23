<?php namespace Genuineq\Profile\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Specialists extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Genuineq.Profile', 'main-menu-item', 'side-menu-item2');
    }
}
