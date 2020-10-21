<?php

namespace Genuineq\Timetable\Components;

use Cms\Classes\ComponentBase;
use Genuineq\Timetable\Models\Record as RecordModel;

/**
 * Class Timetable as front-end controller -> Create|Update|Delete on RecordModel
 * @package Genuineq\Timetable\Components
 */
class Timetable extends ComponentBase
{
    use \October\Rain\Database\Traits\SoftDelete;

    public function componentDetails()
    {
        return [
            'name' => 'Timetable',
            'description' => 'A simple timetable form controller'
        ];
    }

    /**
     * Create a timetable record based on input values
     *
     * @return RecordModel
     */
    public function onCreate()
    {
        $record = (new RecordModel)::create([
            'day' => post('day'),
            'start_hour' => post('start_hour'),
            'end_hour' => post('end_hour'),
            'title' => post('title'),
            'description' => post('description'),
            'feedback' => post('feedback'),
        ]);

        return $record;
    }

    /**
     * Update the model with new input data
     *
     * @return RecordModel
     */
    public function onUpdate($id)
    {
        $record = (new RecordModel)::find($id);
            $record->day = post('day');
            $record->start_hour = post('start_hour');
            $record->end_hour = post('end_hour');
            $record->title = post('title');
            $record->description = post('description');
            $record->feedback = post('feedback');
        $record->save();

        return $record;

    }

    public function onDelete(RecordModel $record)
    {
        $record->runSoftDelete();
    }

}
