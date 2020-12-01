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

    /** One-to-one relationship. */
    public $belongsTo = [
        'county' => 'Genuineq\Addresses\Models\County',
        'city' => 'Genuineq\Addresses\Models\City'
    ];

    /** One-to-many relationship. */
    public $hasMany = [
        'specialists' => [
            'Genuineq\Profile\Models\Specialist'
        ],
        'unarchivedSpecialists' => [
            'Genuineq\Profile\Models\Specialist',
            'conditions' => 'archived = 0'
        ],
        'archivedSpecialists' => [
            'Genuineq\Profile\Models\Specialist',
            'conditions' => 'archived = 1'
        ]
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

    /**
     * Accessor for getting the active teachers.
     */
    public function getActiveSpecialistsAttribute()
    {
        return $this->unarchivedSpecialists()->whereHas('user', function ($query) {
            $query->whereNotNull('last_login');
        })->get();
    }

    /**
     * Accessor for getting the inactive teachers.
     */
    public function getInactiveSpecialistsAttribute()
    {
        return $this->unarchivedSpecialists()->whereHas('user', function ($query) {
            $query->whereNull('last_login');
        })->get();
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

    public function beforeDelete()
    {
        Event::fire('genuineq.profile.school.before.delete', [$this]);
    }

    public function afterDelete()
    {
        /** Force reload the user relationship. */
        $this->reloadRelations('user');

        /** Check if the user has not been deleted. */
        if ($this->user) {
            $this->user->delete();
        }
    }
}
