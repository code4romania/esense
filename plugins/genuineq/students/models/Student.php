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
     * One-to-Many relationship.
     */
    public $hasMany = [
        'contact_persons' => ['Genuineq\Students\Models\ContactPerson']
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
     * Accessor for getting birthdate.
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
        $this->contact_persons->delete();

//        foreach ($this->contact_persons as $contactPerson) {
//            $contactPerson->delete();
//        }
    }

}
