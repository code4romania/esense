<?php namespace Genuineq\Profile\Components;

use Log;
use Auth;
use Lang;
use Flash;
use Redirect;
use Validator;
use Genuineq\User\Models\User;
use ValidationException;
use ApplicationException;
use Cms\Classes\ComponentBase;

/**
 * Specialist component
 *
 * Allows to update, delete, archive and unarchive specialists.
 */
class School extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.profile::lang.components.school.name',
            'description' => 'genuineq.profile::lang.components.school.description'
        ];
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        $this->prepareVars();
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /**
     * Function that updates a school.
     */
    public function onSchoolUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();
        /** Extract the user profile */
        $profile = $user->profile;

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
        $validation = Validator::make(post(), $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Save the profile data. */
        $user->surname = post('surname');
        $user->name = post('name');
        $user->email = post('email');
        $profile->phone =  post('phone');
        $profile->county_id = post('county');
        $profile->name = post('school_name');
        $profile->city_id = post('city');
        $profile->description = post('description');

        $user->save();
        $profile->save();

        Flash::success(Lang::get('genuineq.profile::lang.components.specialist.validation.profile_update_successful'));

        return Redirect::refresh();
    }
}
