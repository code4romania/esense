<?php namespace Genuineq\Timetable\Models;

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
            'title' => 'required|text',
            'description' => 'required|text',
            'feedback' => 'required|text',
        ];
    }
}
