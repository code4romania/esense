<?php namespace Genuineq\Timetable\Models;

use Lang;
use Model;

/**
 * Timetable record Model
 */
class Record extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

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
    public $table = 'genuineq_timetable_records';

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
            'day_required' => Lang::get('genuineq.timetable::lang.component.timetable.validation.day_required'),
            'day_date' => Lang::get('genuineq.timetable::lang.component.timetable.validation.day_date'),
            'start_hour_required' => Lang::get('genuineq.timetable::lang.component.timetable.validation.start_hour_required'),
            'start_hour_time' => Lang::get('genuineq.timetable::lang.component.timetable.validation.start_hour_time'),
            'end_hour_required' => Lang::get('genuineq.timetable::lang.component.timetable.validation.end_hour_required'),
            'end_hour_time' => Lang::get('genuineq.timetable::lang.component.timetable.validation.end_hour_time'),
            'title_required' => Lang::get('genuineq.timetable::lang.component.timetable.validation.title_required'),
            'title_string' => Lang::get('genuineq.timetable::lang.component.timetable.validation.title_string'),
            'description_text' => Lang::get('genuineq.timetable::lang.component.timetable.validation.description_text'),
            'feedback_text' => Lang::get('genuineq.timetable::lang.component.timetable.validation.feedback_text'),
            'record_created_successfully' => Lang::get('genuineq.timetable::lang.component.timetable.message.record_created_successfully'),
            'record_updated_successfully' => Lang::get('genuineq.timetable::lang.component.timetable.message.record_updated_successfully'),
            'record_deleted_successfully' => Lang::get('genuineq.timetable::lang.component.timetable.message.record_deleted_successfully'),
            'no_records' => Lang::get('genuineq.timetable::lang.component.timetable.message.no_records'),
        ];
    }
}
