<?php namespace Genuineq\Profile\Components;

use Log;
use Auth;
use Lang;
use Mail;
use Flash;
use Event;
use Redirect;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Genuineq\User\Models\User;
use Genuineq\User\Helpers\UserInviteHelper;
use Genuineq\User\Helpers\RedirectHelper;
use Genuineq\Profile\Models\Specialist as SpecialistModel;
use Genuineq\Profile\Classes\UserData;

/**
 * Specialist component
 *
 * Allows to update, delete, archive and unarchive specialists.
 */
class Specialist extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.profile::lang.components.specialist.name',
            'description' => 'genuineq.profile::lang.components.specialist.description'
        ];
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
        if($this->param('id')) {
            $this->page['specialist'] = SpecialistModel::find($this->param('id'));
        }
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
     * Function that updates a specialist.
     */
    public function onSpecialistProfileUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user */
        $user = Auth::getUser();
        /** Extract the user profile */
        $profile = $user->profile;

        /** Class with received user data */
        UserData::updateData(post(), $user, $profile);

        Flash::success(Lang::get('genuineq.profile::lang.components.specialist.message.profile_update_successful'));

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
                        $profile = new SpecialistModel([
                            'slug' => SpecialistModel::slug($user->full_name),
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
                        Flash::error(Lang::get('genuineq.profile::lang.components.school.message.specialist_create_error') . $index);
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
                    /** The user exists and is registered as a SCHOOL */
                    Flash::error(Lang::get('genuineq.profile::lang.components.school.message.user_is_school_1') . $index . Lang::get('genuineq.profile::lang.components.school.message.user_is_school_2'));
                }
            }
        }

        return Redirect::to('school/specialists');
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

            /** Fire event before specialist is deleted. */
            Event::fire('genuineq.specialist.change.student.owner.before.delete', [$specialist]);

            /** Delete the extracted specialist. */
            $specialist->forceDelete();

            Flash::success(Lang::get('genuineq.profile::lang.components.school.message.delete_successful'));

            return Redirect::refresh();
        } else {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }
    }
}
