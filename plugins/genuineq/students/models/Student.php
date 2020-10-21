<?php namespace Genuineq\Students\Models;

use Model;

/**
 * Model
 */
class Student extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /** Fillable fields */
    protected $fillable = [
        'surname',
        'name',
        'description',
        'birthdate',
        'hearing_impairment',
        'visual_impairment',
        'gender'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_students_students';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * One-to-one relationship.
     */
    public $belongsTo = [
        'contact_person_1' => ['Genuineq\Students\Models\ContactPerson', 'key' => 'contact_person_1_id'],
        'contact_person_2' => ['Genuineq\Students\Models\ContactPerson', 'key' => 'contact_person_2_id'],
        'contact_person_3' => ['Genuineq\Students\Models\ContactPerson', 'key' => 'contact_person_3_id'],
        'contact_person_4' => ['Genuineq\Students\Models\ContactPerson', 'key' => 'contact_person_4_id'],
        'contact_person_5' => ['Genuineq\Students\Models\ContactPerson', 'key' => 'contact_person_5_id'],
    ];
}
