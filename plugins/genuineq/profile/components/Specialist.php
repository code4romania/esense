<?php namespace Genuineq\Profile\Components;

use Log;
use Auth;
use Lang;
use Flash;
use Redirect;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Genuineq\User\Models\User;
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
}
