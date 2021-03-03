<?php

namespace Genuineq\Timetable\Components;

use Redirect;
use Cms\Classes\ComponentBase;
use Genuineq\Timetable\Models\Lesson;

/**
 * Class Timetable as front-end controller -> Create|Update|Delete on Lesson
 * @package Genuineq\Timetable\Components
 */
class Timetable extends ComponentBase
{
    use \October\Rain\Database\Traits\SoftDelete;

    public function componentDetails()
    {
        return [
            'name' => 'genuineq.timetable::lang.component.timetable.name',
            'description' => 'genuineq.timetable::lang.component.timetable.description'
        ];
    }

    /**
     * Executed when this component is initialized
     * Pass variables to templates
     */
    public function onRun()
    {
        // $this->page['lessons'] = Lesson::all();
    }

    /**
     * Create a timetable lesson based on input values
     *
     * @return Lesson
     */
    public function onCreate()
    {
        $lesson = Lesson::create([
            'day' => post('day'),
            'start_hour' => post('start_hour'),
            'end_hour' => post('end_hour'),
            'duration' => post('duration') ?? (strtotime(post('end_hour')) - strtotime(post('start_hour'))),
            'title' => post('title'),
            'description' => post('description'),
            'feedback' => post('feedback'),
        ]);

        return $lesson;
    }

    /**
     * Update the model with new input data
     *
     * @return Lesson
     */
    public function onUpdate()
    {
        $lesson = Lesson::find(post('id'));
            $lesson->day = post('day');
            $lesson->start_hour = post('start_hour');
            $lesson->end_hour = post('end_hour');
            $lesson->duration = post('duration') ?? (strtotime(post('end_hour')) - strtotime(post('start_hour')));
            $lesson->title = post('title');
            $lesson->description = post('description');
            $lesson->feedback = post('feedback');
        $lesson->save();

        return Redirect::refresh();
    }

    /**
     * Delete the model with SoftDelete method (add `deleted_at` timestamp on lesson entry)
     *
     * @param Lesson $lesson
     */
    public function onDelete(Lesson $lesson)
    {
        $lesson->runSoftDelete();
    }

}
