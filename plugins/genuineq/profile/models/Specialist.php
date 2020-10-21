<?php namespace Genuineq\Profile\Models;

use Model;
use Carbon\Carbon;

/**
 * Model
 */
class Specialist extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /** Fillable fields */
    protected $fillable = [
        'slug',
        'phone',
        'county_id',
        'city_id',
        'school_id',
        'description'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_profile_specialists';

    /**
     * @var array Validation rules
     */
    public $rules = [
        // 'phone' => 'required|string',
        // 'domain_1_id' => 'required|integer',
        // 'domain_1_hard_keywords' => 'required|string',
        // 'domain_1_soft_keywords' => 'required|string',
        // 'domain_1_experience_id' => 'required|integer',
        // 'domain_2_id' => 'nullable|integer',
        // 'domain_2_hard_keywords' => 'nullable|string',
        // 'domain_2_soft_keywords' => 'nullable|string',
        // 'domain_2_experience_id' => 'nullable|integer',
        // 'education_level_id' => 'required|integer',
        // 'languages' => 'nullable|string',
        // 'locations' => 'nullable|string',
        // 'contract_types' => 'required|string'
    ];

    /**
     * Morph relationship between Profile table and User table.
     */
    public $morphOne = [
        'user' => [
            'Genuineq\User\Models\User',
            'table' => 'users',
            'name' => 'profile'
        ]
    ];

    /**
     * One-to-one relationship.
     */
    public $belongsTo = [
        'school' => 'Genuineq\Profile\Models\School',
        'county' => 'Genuineq\Addresses\Models\County',
        'city' => 'Genuineq\Addresses\Models\City'
    ];

    /***********************************************
     ***************** Accessors *******************
     ***********************************************/

    /**
     * Accessor for getting the user name.
     */
    public function getFullNameAttribute()
    {
        return ($this->user) ? ($this->user->full_name) : ('');
    }

    /**
     * Accessor for getting the user email.
     */
    public function getEmailAttribute()
    {
        return ($this->user) ? ($this->user->email) : ('');
    }

    /***********************************************
     ****************** Functions ******************
     ***********************************************/

    /**
     * Function that creates a slug.
     */
    public static function slug($name)
    {
        return str_slug($name, '-') . '-' . Carbon::now()->timestamp;
    }

    /***********************************************
     ****************** Events *********************
     ***********************************************/

    public function beforeCreate()
    {
        if (!$this->slug) {
            $this->slug = str_slug($this->name, '-') . '-' . Carbon::now()->timestamp;
        }
    }
}
