<?php namespace Genuineq\Esense\Models;

use Model;

/**
 * Model
 */
class StudentTransfer extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /** Fillable fields */
    protected $fillable = [
        'student_id',
        'from_specialist_id',
        'to_specialist_id'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_esense_students_transfers';

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
        'fromSpecialist' => ['Genuineq\Profile\Models\Specialist', 'key' => 'from_specialist_id'],
        'toSpecialist' => ['Genuineq\Profile\Models\Specialist', 'key' => 'to_specialist_id']
    ];
}
