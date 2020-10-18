<?php namespace Genuineq\Profile\Models;

use Model;
use Carbon\Carbon;

/**
 * Model
 */
class School extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /** Fillable fields */
    protected $fillable = [
        'slug',
        'name',
        'phone',
        'county_id',
        'city_id',
        'description'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_profile_schools';

    /**
     * @var array Validation rules
     */
    public $rules = [
        // 'name' => 'required|string',
        // 'registration_number' => 'required|string|unique:genuineq_profile_companies',
        // 'domain_id' => 'nullable|integer',
        // 'email' => 'nullable|email',
        // 'phone' => 'nullable|string',
        // 'address' => 'nullable|string',
        // 'description' => 'nullable|string',
        // 'website' => 'nullable|string',
        // 'video' => 'nullable|string',
        // 'company_size_id' => 'nullable|integer'
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
    public function getContactNameAttribute()
    {
        return ($this->user) ? ($this->user->name) : ('');
    }

    /**
     * Accessor for getting the user email.
     */
    public function getContactEmailAttribute()
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
        return str_slug($name, '-');
        // return str_slug($name, '-') . '-' . Carbon::now()->timestamp;
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
