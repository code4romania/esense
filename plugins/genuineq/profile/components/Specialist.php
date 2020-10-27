<?php namespace Genuineq\Profile\Components;

use Log;
use Auth;
use Lang;
use Flash;
use Redirect;
use Validator;
use Genuineq\User\Models\User;
use Genuineq\Profile\Models\Specialist as SpecialistModel;
use Genuineq\Profile\Classes\UserData;
use ValidationException;
use ApplicationException;
use Cms\Classes\ComponentBase;

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
    public function onSpecialistUpdate()
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
        $specialist = $user->profile->specialists->where('id', post('id'))->first();

        if ($specialist) {
            /** Archive the extracted specialist. */
            $specialist->archived = true;
            $specialist->save();

            Flash::success(Lang::get('genuineq.profile::lang.components.specialist.message.specialist_archive_successful'));
        } else {
            Flash::error(Lang::get('genuineq.profile::lang.components.specialist.message.specialist_archive_failed'));
        }

        return Redirect::refresh();
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
        $specialist = $user->profile->archivedSpecialists->where('id', post('id'))->first();

        if ($specialist) {
            /** Unzip the extracted specialist. */
            $specialist->archived = false;
            $specialist->save();

            Flash::success(Lang::get('genuineq.profile::lang.components.specialist.message.specialist_unzip_successful'));
        } else {
            Flash::error(Lang::get('genuineq.profile::lang.components.specialist.message.specialist_unzip_failed'));
        }

        return Redirect::refresh();
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
        $specialist = $user->profile->archivedSpecialists->where('id', post('id'))->first();

        if ($specialist) {
            /** Delete the extracted specialist. */
            $specialist->forceDelete();

            Flash::success(Lang::get('genuineq.profile::lang.components.specialist.message.specialist_delete_successful'));
        } else {
            Flash::error(Lang::get('genuineq.profile::lang.components.specialist.message.specialist_delete_failed'));
        }

        return Redirect::refresh();
    }
}
