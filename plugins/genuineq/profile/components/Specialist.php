<?php namespace Genuineq\Profile\Components;

use Log;
use Auth;
use Lang;
use Flash;
use Redirect;
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
    }
}
