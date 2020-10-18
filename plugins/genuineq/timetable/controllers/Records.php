<?php namespace Genuineq\Timetable\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Genuineq\Timetable\Models\Record;

class Records extends Controller
{
    protected $recordId;

    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'genuineq.timetable.manage_records'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Genuineq.Timetable', 'timetable');
    }
}
