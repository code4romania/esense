<?php namespace Genuineq\Addresses\Models;

use Model;

/**
 * Model
 */
class City extends Model
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
    public $table = 'genuineq_addresses_cities';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'slug' => 'required|string|unique:genuineq_addresses_cities',
        'name' => 'required|string',
        'description' => 'nullable|string'
    ];

    /** County relation. */
    public $belongsTo = [
        'county' => 'Genuineq\Addresses\Models\County'
    ];

    /***********************************************
     ******************** Events *******************
     ***********************************************/

    /**
     * Function that is executed before the creation.
     */
    public function beforeCreate()
    {
        $this->slug = $this->county_id . '-' . str_slug($this->name, '-');
    }
}
