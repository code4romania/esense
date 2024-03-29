<?php namespace Genuineq\Students\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class ContactPersons extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = ['genuineq.students.students_access'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Genuineq.Students', 'main-menu-item', 'side-menu-item2');
    }
}
