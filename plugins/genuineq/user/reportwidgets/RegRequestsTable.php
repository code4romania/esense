<?php namespace Genuineq\User\ReportWidgets;

use DB;
use Lang;
use Flash;
use Redirect;
use Exception;
use Backend\Classes\ReportWidgetBase;
use Genuineq\User\Helpers\EmailHelper;
use Genuineq\User\Models\User as UserModel;

/**
 * Class RegRequestsTable
 * @package Genuineq\User\ReportWidgets
 */
class RegRequestsTable extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['labelRegRequestsTable'] = Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.label');

            /** Get no of inactive user accounts (== user requests) from database  */
            $this->vars['userRequests'] = UserModel::where('is_activated', 0)->orderBy('created_at', 'DESC')->get();
        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.label'),
                'type' => 'string',
                'validationPattern' => '^.+$',
            ]
        ];
    }


    /**
     * Function that show RequestForm at click on a list item
     * @return false|mixed
     */
    public function onRequestForm()
    {
        /* Get all user model fields from DB by selected id */
        $userModel = UserModel::find(post('record_id'));

        /* Add userModel variable to modal view */
        $this->vars['userModel'] = $userModel;
        $this->vars['userModelProfile'] = json_decode($userModel->profile);


        return $this->makePartial('preview_request');
    }

    /***********************************************
     **************** Activate account *************
     ***********************************************/

    /**
     * Function that Activate account on request
     * @return mixed
     */
    public function onRequest()
    {
        if ([] != post('record_id')) {
            $this->activateUser(post('record_id'));
        } elseif ([] != post('checked')) {
            /** Iterate IDs and get the corresponding user, then activate it */
            foreach (post('checked') as $accountId) {
                $this->activateUser($accountId);
            }
        } else {
            Flash::error(Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.flash.fail'));

            return;
        }

        Flash::success(Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.flash.success'));

        /* Refreshing the page */
        return Redirect::refresh();
    }

    /**
     * Function that Activate account by user ID
     * @param $accountId
     */
    private function activateUser($accountId)
    {
        $userModel = UserModel::find($accountId);

        $userModel->attemptActivation($userModel->getActivationCode());

        /** Inform user via email of account activation. */
        EmailHelper::sendWelcomeEmail($userModel);
    }

    public function onDelete()
    {
        if ([] != post('record_id')) {
            $this->deleteUser(post('record_id'));
        } elseif ([] != post('checked')) {
            /** Iterate IDs and get the corresponding user, then activate it */
            foreach (post('checked') as $accountId) {
                $this->deleteUser($accountId);
            }
        } else {
            Flash::error(Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.flash_delete.fail'));

            return;
        }

        Flash::success(Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.flash_delete.success'));

        /* Refreshing the page */
        return Redirect::refresh();
    }


    private function deleteUser($accountId)
    {
        $userModel = UserModel::find($accountId);

        if (!is_null($userModel)) {
            $userModel->delete();
        }
    }
}
