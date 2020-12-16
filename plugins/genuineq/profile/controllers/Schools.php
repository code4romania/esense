<?php namespace Genuineq\Profile\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Schools extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Genuineq.Profile', 'main-menu-item', 'side-menu-item');
    }
}
