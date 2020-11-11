<?php namespace Genuineq\Timetable\Models;

use Lang;
use Model;
use Carbon\Carbon;

/**
 * Timetable lesson Model
 */
class Lesson extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'day',
        'start_hour',
        'end_hour',
        'title',
        'description',
        'feedback',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_timetable_lessons';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * Function that holds the validation rules.
     */
    public static function rules()
    {
        return [
            'day' => 'required|date',
            'start_hour' => 'required|time',
            'end_hour' => 'required|time',
            'title' => 'required|string',
            'description' => 'text',
            'feedback' => 'text',
        ];
    }

    /**
     * Function that holds the validation messages.
     */
    public function messages()
    {
        return [
            'day.required' => Lang::get('genuineq.timetable::lang.component.timetable.validation.day_required'),
            'day.date' => Lang::get('genuineq.timetable::lang.component.timetable.validation.day_date'),
            'start_hour.required' => Lang::get('genuineq.timetable::lang.component.timetable.validation.start_hour_required'),
            'start_hour.time' => Lang::get('genuineq.timetable::lang.component.timetable.validation.start_hour_time'),
            'end_hour.required' => Lang::get('genuineq.timetable::lang.component.timetable.validation.end_hour_required'),
            'end_hour.time' => Lang::get('genuineq.timetable::lang.component.timetable.validation.end_hour_time'),
            'title.required' => Lang::get('genuineq.timetable::lang.component.timetable.validation.title_required'),
            'title.string' => Lang::get('genuineq.timetable::lang.component.timetable.validation.title_string'),
            'description.text' => Lang::get('genuineq.timetable::lang.component.timetable.validation.description_text'),
            'feedback.text' => Lang::get('genuineq.timetable::lang.component.timetable.validation.feedback_text'),
            'lesson_created_successfully' => Lang::get('genuineq.timetable::lang.component.timetable.message.lesson_created_successfully'),
            'lesson_updated_successfully' => Lang::get('genuineq.timetable::lang.component.timetable.message.lesson_updated_successfully'),
            'lesson_deleted_successfully' => Lang::get('genuineq.timetable::lang.component.timetable.message.lesson_deleted_successfully'),
            'no_lessons' => Lang::get('genuineq.timetable::lang.component.timetable.message.no_lessons'),
        ];
    }

    /***********************************************
     ***************** Accessors *******************
     ***********************************************/

    public function getDurationAttribute()
    {
        return round(Carbon::parse($this->end_hour)->floatDiffInHours($this->start_hour), /*precision*/1);
    }
}
