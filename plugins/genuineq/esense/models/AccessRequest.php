<?php namespace Genuineq\Esense\Models;

use Model;

/**
 * Model
 */
class AccessRequest extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /** Fillable fields */
    protected $fillable = [
        'student_id',
        'from_specialist_id',
        'to_specialist_id',
        'approved',
        'message',
        'seen'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_esense_access_requests';

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
