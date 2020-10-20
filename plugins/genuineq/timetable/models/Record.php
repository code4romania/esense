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

    /** Fillable fields. */
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
}
