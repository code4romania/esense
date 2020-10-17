<?php namespace Genuineq\Addresses\Models;

use Model;

/**
 * Model
 */
class County extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /** Fillable fields */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_addresses_counties';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'slug' => 'required|string|unique:genuineq_addresses_counties',
        'name' => 'required|string',
        'description' => 'nullable|string'
    ];

    /** Region relation. */
    public $belongsTo = [
        'region' => 'Genuineq\Addresses\Models\Region'
    ];

    /** Cities relation. */
    public $hasMany = [
        'cities' => [
            'Genuineq\Addresses\Models\City',
            'order' => 'name asc'
        ]
    ];

    /***********************************************
     ******************** Events *******************
     ***********************************************/

    /**
     * Function that is executed before the creation.
     */
    public function beforeCreate()
    {
        $this->slug = str_slug($this->name, '-');
    }

    /**
     * Function that is executed before the model is deleted.
     */
    public function beforeDelete()
    {
        /** Delete all cities before county is deleted. */
        foreach($this->cities as $key => $city) {
            $city->delete();
        }
    }
}
