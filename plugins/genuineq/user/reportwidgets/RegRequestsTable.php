<?php namespace Genuineq\User\ReportWidgets;

use DB;
use Lang;
use Backend\Classes\ReportWidgetBase;

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
            $this->vars['regRequestsTable'] = DB::select('SELECT * FROM backend_users WHERE is_activated = ?', [0]);

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
     * Function that show replyForm at click on a list item
     * @return false|mixed
     */
    public function onRequestForm()
    {
        /*Get the selected record ID */
        $this->asExtension('FormController')->update(post('record_id'));

        /* Get all model fields */
        $messageToReply = MessageModel::find(post('record_id'));

        /* Add variables to view */
        $this->vars['recordId'] = $messageToReply->id;
        $this->vars['email'] = $messageToReply->email;

        return $this->makePartial('reply_form');

    }


    /***********************************************
     **************** Reply to message *************
     ***********************************************/

    /**
     * Function that keeps the logic for Reply to messages
     * @return mixed
     */
    public function onReply()
    {

        $receiverEmail = post('email'); /* Email value from hidden field, because in view is disabled */
        $messageToReply = wordwrap(post('Message[message]'), 70); /* Wrap  text to 70 chars line long */

        $bodyMessage = [
            'text' => $messageToReply,
            'raw' => true
        ];

        $data = [
            'email' => post('email'),
            'message' => strip_tags(post('Message[message]')),
        ];


    }


}
