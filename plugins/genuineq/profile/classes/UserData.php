<?php namespace Genuineq\Profile\Classes;

use Auth;
use Lang;
use Flash;
use Validator;
use Redirect;
use ValidationException;

class UserData
{
    public static function getData($data, $user, $profile)
    {
        /** Extract the user profile validation rules. */
        $rules = [
            'surname' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'name' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'phone' => 'required|numeric',
            'email' => 'required|between:6,255|email',
            'county' => 'required',
            'city' => 'required',
            'description' => 'string'
        ];

        /** Create the validation messages. */
        $messages = [
            'surname.required' => Lang::get('genuineq.profile::lang.components.specialist.validation.surname_required'),
            'surname.regex' => Lang::get('genuineq.profile::lang.components.specialist.validation.surname_string'),
            'name.required' => Lang::get('genuineq.profile::lang.components.specialist.validation.name_required'),
            'name.regex' => Lang::get('genuineq.profile::lang.components.specialist.validation.name_string'),
            'phone.required' => Lang::get('genuineq.profile::lang.components.specialist.validation.birthdate_required'),
            'phone.numeric' => Lang::get('genuineq.profile::lang.components.specialist.validation.birthdate_date'),
            'email.between' => Lang::get('genuineq.profile::lang.components.specialist.validation.email_between'),
            'email.email' => Lang::get('genuineq.profile::lang.components.specialist.validation.email_email'),
            'description.string' => Lang::get('genuineq.profile::lang.components.specialist.validation.description_string'),
        ];

        /** Apply the profile validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Save the profile data. */
        $user->surname = post('surname');
        $user->name = post('name');
        $user->email = post('email');
        $profile->phone =  post('phone');
        $profile->county_id = post('county');
        $profile->city_id = post('city');
        $profile->description = post('description');

        $user->save();
        $profile->save();

        Flash::success(Lang::get('genuineq.profile::lang.components.specialist.validation.profile_update_successful'));

        return Redirect::refresh();
    }
}