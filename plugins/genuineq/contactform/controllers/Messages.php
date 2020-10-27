<?php namespace Genuineq\ContactForm\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Messages extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Genuineq.ContactForm', 'contactform', 'messages');
    }
}
