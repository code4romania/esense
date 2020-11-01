<?php namespace Genuineq\Profile\Components;

use Log;
use Auth;
use Lang;
use Mail;
use Flash;
use Redirect;
use Validator;
use Exception;
use ValidationException;
use ApplicationException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Genuineq\Profile\Models\Specialist;
use Genuineq\Profile\Classes\UserData;
use Genuineq\User\Models\User;
use Genuineq\User\Helpers\RedirectHelper;
use Genuineq\User\Helpers\UserInviteHelper;

/**
 * School component
 *
 * Allows to update schools.
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

    public function defineProperties()
    {
        return [
            'resetPage' => [
                'title'       => 'genuineq.profile::lang.components.school.backend.reset_page',
                'description' => 'genuineq.profile::lang.components.school.backend.reset_page_desc',
                'type'        => 'dropdown',
                'default'     => ''
            ],
        ];
    }

    public function getResetPageOptions()
    {
        return [''=>'- refresh page -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
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
    public function onSchoolProfileUpdate()
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
            'school_name' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'description' => 'string'
        ];

        /** Create the validation messages. */
        $messages = [
            'surname.required' => Lang::get('genuineq.profile::lang.components.school.validation.surname_required'),
            'surname.regex' => Lang::get('genuineq.profile::lang.components.school.validation.surname_string'),
            'name.required' => Lang::get('genuineq.profile::lang.components.school.validation.name_required'),
            'name.regex' => Lang::get('genuineq.profile::lang.components.school.validation.name_string'),
            'phone.required' => Lang::get('genuineq.profile::lang.components.school.validation.birthdate_required'),
            'phone.numeric' => Lang::get('genuineq.profile::lang.components.school.validation.birthdate_date'),
            'email.between' => Lang::get('genuineq.profile::lang.components.school.validation.email_between'),
            'email.email' => Lang::get('genuineq.profile::lang.components.school.validation.email_email'),
            'county.required' => Lang::get('genuineq.profile::lang.components.school.validation.county_required'),
            'city.required' => Lang::get('genuineq.profile::lang.components.school.validation.city_required'),
            'school_name.required' => Lang::get('genuineq.profile::lang.components.school.validation.school_name_required'),
            'school_name.regex' => Lang::get('genuineq.profile::lang.components.school.validation.school_name_string'),
            'description.string' => Lang::get('genuineq.profile::lang.components.school.validation.description_string'),
        ];

        /** Apply the profile validation rules. */
        $validation = Validator::make(post(), $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Update and save the user data. */
        $user->surname = post('surname');
        $user->name = post('name');
        $user->email = post('email');

        $user->save();

        /** Update and save the profile data. */
        $profile->phone =  post('phone');
        $profile->county_id = post('county');
        $profile->city_id = post('city');
        $profile->name = post('school_name');
        $profile->description = post('description');

        $profile->save();

        Flash::success(Lang::get('genuineq.profile::lang.components.school.message.profile_update_successful'));

        return Redirect::refresh();
    }
}
