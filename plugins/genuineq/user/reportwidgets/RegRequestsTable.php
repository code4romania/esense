<?php namespace Genuineq\User\ReportWidgets;

use DB;
use Lang;
use Flash;
use Exception;
use Backend\Classes\ReportWidgetBase;
use Genuineq\User\Models\User as UserModel;

/**
 * Class RegRequestsTable
 * @package Genuineq\User\ReportWidgets
 */
class RegRequestsTable extends ReportWidgetBase
{
//    public $hiddenActions = ['run'];
//
//    public $implement = ['\Backend\Behaviors\ListController','\Backend\Behaviors\FormController'];
//    public $listConfig = 'config_requests_list.yaml';
//    public $formConfig = 'config_requests_form.yaml';


    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['labelRegRequestsTable'] = Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.frontend.label_registration_requests');

            /** Get no of inactive user accounts (== user requests) from database  */
            $this->vars['regRequestsTable'] = UserModel::where('is_activated', 0)->get();

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
        /* Get the selected record ID */
//        $this->asExtension('FormController')->preview(post('record_id'));

        /* Get all model fields */
        $userModel = UserModel::find(post('record_id'));

        /* Add variables to view */
        $this->vars['recordId'] = $userModel->id;
        $this->vars['isActivated'] = $userModel->is_activated;

        return $this->makePartial('preview_request');

    }

    /***********************************************
     **************** Activate account *************
     ***********************************************/

    /**
     * Function that keeps the logic for Reply to messages
     * @return mixed
     */
    public function onRequest()
    {
        if ($userRequest = UserModel::find(post('record_id'))) {
            $userRequest->is_activated = 1;
            $userRequest->save();

            Flash::success(Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.flash.success'));

            return $this->listRefresh();

        } else {

            Flash::error( Lang::get('genuineq.user::lang.reportwidgets.reg_requests_table.flash.fail') );
        }
    }


}
