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
        $this->page['records'] = RecordModel::all();
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
    public function onUpdate()
    {
        $record = RecordModel::find(post('id'));
            $record->day = post('day');
            $record->start_hour = post('start_hour');
            $record->end_hour = post('end_hour');
            $record->title = post('title');
            $record->description = post('description');
            $record->feedback = post('feedback');
        $record->save();

        return $record;
    }

    /**
     * Delete the model with SoftDelete method (add `deleted_at` timestamp on record entry)
     *
     * @param RecordModel $record
     */
    public function onDelete(RecordModel $record)
    {
        $record->runSoftDelete();
    }

}
