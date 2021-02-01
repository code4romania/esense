<?php namespace Genuineq\Addresses\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Counties extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
    ];

    public $requiredPermissions = ['genuineq.addresses.addresses_access'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Genuineq.Addresses', 'main-menu-item', 'side-menu-item2');
    }
}
