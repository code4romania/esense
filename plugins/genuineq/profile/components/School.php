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

    /**
     * Function used for inviting specialists.
     */
    public function onSpecialistsInvite()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getUser();

        /**
         * Parse all inputs and add specialists.
         * There can ONLY be added MAX 5 specilists at a time.
         */
        for ($index = 0; $index < 5; $index++) {
            /** Check if specialists with index $index exists. */
            if (post('specialist_' . $index . '_surname') && post('specialist_' . $index . '_name') && post('specialist_' . $index . '_email') && post('specialist_' . $index . '_phone')) {

                /** Try to extract the specialist. */
                $specialistUser = User::whereEmail(post('specialist_' . $index . '_email'))->first();

                /** Check if the specailist already exists. */
                if (!$specialistUser) {
                    /** The specialist doesn't exist. Create account and affiliate it. */

                    /** Extract the data. */
                    $data = [
                        'surname' => post('specialist_' . $index . '_surname'),
                        'name' => post('specialist_' . $index . '_name'),
                        'email' => post('specialist_' . $index . '_email'),
                        'type' => post('specialist_' . $index . '_type')
                    ];

                    try {
                        /** Create user and send invite. */
                        $newUser = UserInviteHelper::inviteUser($user, $data, (($this->property('resetPage')) ? ($this->property('resetPage')) : ($this->currentPageUrl())));

                        /** Create user profile. */
                        $profile = new Specialist([
                            'slug' => Specialist::slug($user->full_name),
                            'phone' => post('phone'),
                            'county_id' => $user->profile->county_id,
                            'city_id' => $user->profile->city_id,
                            'school_id' => $user->profile->id,
                            'description' => ''
                            ]
                        );

                        /** Save the profile. */
                        $profile->save();

                        /** Link profile and user. */
                        $newUser->profile = $profile;

                        $newUser->save();

                        Flash::success(Lang::get('genuineq.profile::lang.components.school.message.user_invite_successful') . $index);
                    } catch (Exception $exception) {
                        Flash::error(Lang::get('genuineq.profile::lang.components.school.message.user_already_affiliated_1') . $index);
                    }
                } elseif (('specialist' == $specialistUser->type) && $specialistUser->profile->school) {
                    /** The specialist exist and IS affiliated. */
                    Flash::error(Lang::get('genuineq.profile::lang.components.school.message.user_already_affiliated_1') . $index . Lang::get('genuineq.profile::lang.components.school.message.user_already_affiliated_2'));
                } elseif ('specialist' == $specialistUser->type) {
                    /** The specialist exist and is NOT affiliated. Affiliate it. */

                    /** Extract specialist profile. */
                    $specialistProfile = $specialistUser->profile;

                    /** Update the specialist profile and save it. */
                    $specialistProfile->school_id = $user->profile->id;
                    $specialistProfile->save();

                    $data = [
                        'name' => $specialistUser->full_name,
                        'school_name' => $user->profile->name
                    ];

                    Mail::send('genuineq.profile::mail.new_affiliation', $data, function($message) use ($specialistUser) {
                        $message->to($specialistUser->email, $specialistUser->full_name);
                    });

                    Flash::success(Lang::get('genuineq.profile::lang.components.school.message.user_invite_successful') . $index);
                } else {
                    /** The user exists ans registered as a SCHOOL */
                    Flash::error(Lang::get('genuineq.profile::lang.components.school.message.user_is_school_1') . $index . Lang::get('genuineq.profile::lang.components.school.message.user_is_school_2'));
                }
            }
        }

        return Redirect::refresh();
    }

    /**
     * Function that updates a specialist.
     */
    public function onSpecialistUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the specialist that needs to be updated. */
        $specialist = Auth::getUser()->profile->specialists()->where('id', post('id'))->first();

        if($specialist) {
            /** Class with received user data */
            UserData::updateData(post(), $specialist->user, $specialist);

            Flash::success(Lang::get('genuineq.profile::lang.components.school.message.update_successful'));

            return Redirect::refresh();
        } else {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }
    }

    /**
     * Function that archives a specialist.
     */
    public function onSpecialistArchive()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();

        /** Extract the specialist that needs to be archived. */
        $specialist = $user->profile->specialists()->where('id', post('id'))->first();

        if ($specialist) {
            /** Archive the extracted specialist. */
            $specialist->archived = true;
            $specialist->save();

            Flash::success(Lang::get('genuineq.profile::lang.components.school.message.archive_successful'));

            return Redirect::refresh();
        } else {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        } 
    }

    /**
     * Function that unzips a specialist.
     */
    public function onSpecialistUnzip()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();

        /** Extract the specialist that needs to be unziped. */
        $specialist = $user->profile->archivedSpecialists()->where('id', post('id'))->first();

        if ($specialist) {
            /** Unzip the extracted specialist. */
            $specialist->archived = false;
            $specialist->save();

            Flash::success(Lang::get('genuineq.profile::lang.components.school.message.unzip_successful'));

            return Redirect::refresh();
        } else {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }
    }

    /**
     * Function that deletes a specialist.
     */
    public function onSpecialistDelete()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();

        /** Extract the specialist that needs to be deleted. */
        $specialist = $user->profile->archivedSpecialists()->where('id', post('id'))->first();

        if ($specialist) {
            /** Delete the extracted specialist. */
            $specialist->forceDelete();

            Flash::success(Lang::get('genuineq.profile::lang.components.school.message.delete_successful'));

            return Redirect::refresh();
        } else {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }   
    }
}
