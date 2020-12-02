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
     * Attach october cms file avatar to students model.
     */
    public $attachOne = [
        'avatar' => \System\Models\File::class
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

    /***********************************************
     ****************** Accessors ******************
     ***********************************************/

    /**
     * Accessor for getting the user name.
     */
    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * Accessor for getting the user name.
     */
    public function getDisplayBirthdateAttribute()
    {
        return date_format(date_create_from_format('Y-m-d', $this->birthdate), 'd/m/Y');
    }

    /**
     * Accessor for getting the age.
     */
    public function getAgeAttribute()
    {
        return date_diff(date_create($this->birthdate), date_create('today'))->y;
    }

    /***********************************************
     ****************** Events *********************
     ***********************************************/

    public function beforeDelete()
    {
        /** Delete contact persons before student is deleted */
        /** Check if contact person 1 is defined. */
        if($this->contact_person_1){
            $this->contact_person_1->delete();
        }
        /** Check if contact person 2 is defined. */
        if($this->contact_person_2){
            $this->contact_person_2->delete();
        }
        /** Check if contact person 3 is defined. */
        if($this->contact_person_3){
            $this->contact_person_3->delete();
        }
        /** Check if contact person 4 is defined. */
        if($this->contact_person_4){
            $this->contact_person_4->delete();
        }
        /** Check if contact person 5 is defined. */
        if($this->contact_person_5){
            $this->contact_person_5->delete();
        }
    }
    
}
