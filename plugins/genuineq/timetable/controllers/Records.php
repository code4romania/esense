<?php namespace Genuineq\Timetable\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Records extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
    ];

    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
        'genuineq.timetable.manage_records'
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Genuineq.Timetable', 'timetable', 'records');
    }
}
