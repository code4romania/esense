<?php namespace Genuineq\Profile\Classes;

use Auth;
use Lang;
use Flash;
use Validator;
use Redirect;
use ValidationException;

class UserData
{
    /**
     * Function that updates the user and profile data
     *  based on the received data.
     */
    public static function updateData($data, $user, $profile)
    {
        /** Extract the user profile validation rules. */
        $rules = [
            'surname' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'name' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'phone' => 'numeric',
            'email' => 'required|between:6,255|email',
            'county' => 'required',
            'city' => 'required',
            'description' => 'string'
        ];

        /** Create the validation messages. */
        $messages = [
            'surname.required' => Lang::get('genuineq.profile::lang.components.specialist.validation.surname_required'),
            'surname.regex' => Lang::get('genuineq.profile::lang.components.specialist.validation.surname_regex'),
            'name.required' => Lang::get('genuineq.profile::lang.components.specialist.validation.name_required'),
            'name.regex' => Lang::get('genuineq.profile::lang.components.specialist.validation.name_regex'),
            // 'phone.required' => Lang::get('genuineq.profile::lang.components.specialist.validation.phone_required'),
            'phone.numeric' => Lang::get('genuineq.profile::lang.components.specialist.validation.phone_numeric'),
            'email.between' => Lang::get('genuineq.profile::lang.components.specialist.validation.email_between'),
            'email.email' => Lang::get('genuineq.profile::lang.components.specialist.validation.email_email'),
            'county.required' => Lang::get('genuineq.profile::lang.components.specialist.validation.county_required'),
            'city.required' => Lang::get('genuineq.profile::lang.components.specialist.validation.city_required'),
            'description.string' => Lang::get('genuineq.profile::lang.components.specialist.validation.description_string'),
        ];

        /** Apply the profile validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Update and save the user data. */
        $user->surname = $data['surname'];
        $user->name = $data['name'];
        $user->email = $data['email'];

        $user->save();

        /** Update and save the profile data. */
        $profile->phone =  $data['phone'];
        $profile->county_id = $data['county'];
        $profile->city_id = $data['city'];
        $profile->description = $data['description'];

        $profile->save();
    }
}
