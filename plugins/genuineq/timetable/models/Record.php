<?php namespace Genuineq\Timetable\Models;

use Model;

/**
 * Timetable record Model
 */
class Record extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


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