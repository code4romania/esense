<?php namespace Genuineq\ContactForm\Components;

use Log;
use Lang;
use Flash;
use Redirect;
use Validator;
use Cms\Classes\ComponentBase;
use Genuineq\User\Models\User as UserModel;
use October\Rain\Exception\ValidationException;
use Genuineq\ContactForm\Models\Message as MessageModel;

/**
 * Class ContactForm
 * @package Genuineq\ContactForm\Components
 */
class ContactForm extends ComponentBase
{
    use \October\Rain\Database\Traits\Validation;

    public function componentDetails()
    {
        return [
            'name' => 'genuineq.contactform::lang.component.contactform.name',
            'description' => 'genuineq.contactform::lang.component.contactform.description'
        ];
    }

    /**
     * Executed when this component is initialized
     * Pass variables to templates
     */
    public function onRun()
    {
    }

    /**
     * Create a message based on input values
     *
     * @return MessageModel
     */
    public function onSubmit()
    {
        try {
            Validator::make(
                $post = [
                    'first_name' => post('first_name'),
                    'last_name' => post('last_name'),
                    'email' => post('email'),
                    'message' => post('message'),
                ],
                MessageModel::rules()
            );

            MessageModel::create([
                'first_name' => post('first_name'),
                'last_name' => post('last_name'),
                'email' => post('email'),
                'message' => post('message'),
            ]);

        } catch (ValidationException $e) {
            Log::error("Invalid input" . PHP_EOL . implode("; ", post()));
            return;
        }

        Flash::success(Lang::get('genuineq.contactform::lang.backend.flash.send_message.success'));
        return Redirect::refresh();
    }


}
