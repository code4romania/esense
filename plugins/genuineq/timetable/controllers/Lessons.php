<?php namespace Genuineq\Timetable\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Lessons extends Controller
{
    protected $lessonId;

    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'genuineq.timetable.manage_lessons'
    ];

    /**
     * Lessons Controller constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Genuineq.Timetable', 'timetable', 'lessons');
    }
}
