<?php namespace Genuineq\Esense\Models;

use Model;

/**
 * Model
 */
class Connection extends Model
{
    /** Fillable fields */
    protected $fillable = [
        'student_id',
        'specialist_id'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_esense_students_specialists';

    /**
     * Disable timestamps for this model.
     */
    public $timestamps = false;

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * One-to-one relationships.
     */
    public $belongsTo = [
        'student' => ['Genuineq\Students\Models\Student', 'key' => 'student_id'],
        'specialist' => ['Genuineq\Profile\Models\Specialist', 'key' => 'specialist_id'],
    ];

    /**
     * One-to-many relationships.
     */
    public $hasMany = [
        'lessons' => 'Genuineq\Timetable\Models\Lesson',
    ];
}
