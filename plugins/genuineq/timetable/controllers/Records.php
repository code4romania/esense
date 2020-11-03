<?php namespace Genuineq\Timetable\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Records extends Controller
{
    protected $recordId;

    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'genuineq.timetable.manage_records'
    ];

    /**
     * Records Controller constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Genuineq.Timetable', 'timetable', 'records');
    }
}
