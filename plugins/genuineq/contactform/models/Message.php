<?php namespace Genuineq\ContactForm\Models;

use Model;

/**
 * Model
 */
class Message extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_contactform_messages';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
