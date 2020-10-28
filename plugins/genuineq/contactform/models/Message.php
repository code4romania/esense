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
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'message',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'genuineq_contactform_messages';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /**
     * Function that holds the validation rules.
     */
    public static function rules()
    {
        return [
            'first_name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'message' => 'required|min:20',
        ];
    }

    /**
     * Function that holds the validation messages.
     */
    public function messages()
    {
        return [
            // NEED TO BE MODIFIED
        ];
    }

}
