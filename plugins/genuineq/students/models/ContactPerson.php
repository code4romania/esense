<?php namespace Genuineq\Students\Models;

use Model;

/**
 * Model
 */
class ContactPerson extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /** Fillable fields */
    protected $fillable = [
        'student_id',
        'surname',
        'name',
        'phone',
        'email',
        'description'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_students_contact_persons';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * One-to-One relationship
     */
    public $belongsTo = [
        'student' => 'Genuineq\Students\Models\Student'
    ];
}
