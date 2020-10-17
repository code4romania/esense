<?php

namespace Genuineq\Timetable\Components;

use Cms\Classes\ComponentBase;
use October\Rain\Exception\ValidationException;

/**
 * Class Timetable
 * @package Genuineq\Timetable\Components
 */

class Timetable extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Timetable',
            'description' => 'A simple timetable form'
        ];
    }

//    public function onSubmit()
//    {
//        $data = \Input::only([
//            'day',
//            'start_hour',
//            'end_hour',
//            'title',
//            'description',
//            'feedback',
//        ]);
//
//        try {
//            $this->validate($data);
//        } catch (ValidationException $e) {
//            echo "An error occured.".PHP_EOL;
//        }
//
//
//
//
//    }


}