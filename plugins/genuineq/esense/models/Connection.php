<?php namespace Genuineq\Esense\Models;

use Model;

/**
 * Model
 */
class Connection extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /** Fillable fields */
    protected $fillable = [
        'student_id',
        'specialist_id',
        'approved',
        'message',
        'seen'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_esense_connections';

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
        'toSpecialist' => ['Genuineq\Profile\Models\Specialist', 'key' => 'to_specialist_id']
    ];

    /**
     * One-to-many relationships.
     */
    public $hasMany = [
        'lessons' => 'Genuineq\Timetable\Models\Lesson',
    ];
}
