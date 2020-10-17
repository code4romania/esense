<?php namespace Genuineq\Addresses\Models;

use Model;

/**
 * Model
 */
class Region extends Model
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
    public $table = 'genuineq_addresses_regions';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'slug' => 'required|string|unique:genuineq_addresses_regions',
        'name' => 'required|string',
        'description' => 'nullable|string'
    ];

    /** County relation. */
    public $hasMany = [
        'counties' => [
            'Genuineq\Addresses\Models\County',
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
        /** Delete all counties before region is deleted. */
        foreach($this->counties as $key => $county) {
            $county->delete();
        }
    }
}
