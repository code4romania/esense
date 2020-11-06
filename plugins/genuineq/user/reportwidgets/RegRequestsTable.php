<?php namespace Genuineq\User\ReportWidgets;

use DB;
use Lang;
use Flash;
use Redirect;
use Exception;
use Backend\Classes\ReportWidgetBase;
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
            $this->vars['labelRegRequestsTable'] = Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.frontend.label_registration_requests');

            /** Get no of inactive user accounts (== user requests) from database  */
            $this->vars['userRequests'] = UserModel::where('is_activated', 0)->get();

        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.title'),
                'default' => Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.title_default'),
                'type' => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.title_validation'),
            ]
        ];
    }


    /**
     * Function that show RequestForm at click on a list item
     * @return false|mixed
     */
    public function onRequestForm()
    {
        /* Get all user model fields from DB */
        $userModel = UserModel::find(post('record_id'));

        /* Add userModel variable to modal view */
        $this->vars['userModel'] = $userModel;

        return $this->makePartial('preview_request');

    }

    /***********************************************
     **************** Activate account *************
     ***********************************************/

    /**
     * Function that keeps the logic for Activate account
     * @return mixed
     */
    public function onRequest()
    {
        if ($userModel = UserModel::find(post('record_id'))) {
            $userModel->is_activated = 1;
            $userModel->save();

            Flash::success(Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.flash.success'));

            return Redirect::refresh();

        } else {
            Flash::error( Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.flash.fail') );
        }
    }


}
