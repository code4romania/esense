<?php namespace Genuineq\User\ReportWidgets;

use DB;
use Lang;
use Backend\Classes\ReportWidgetBase;

class TotalRegistrationRequests extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['labelRegistrationRequests'] = Lang::get('genuineq.user::lang.reportwidgets.total_registration_requests.frontend.label_registration_requests');

            /** Get no of inactive user accounts (== user requests) from database  */
            $this->vars['totalRegistrationRequests'] = DB::table('users')->select()->where('is_activated', '=', 0)->count();

        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => Lang::get('genuineq.user::lang.reportwidgets.total_registration_requests.title'),
                'default' => Lang::get('genuineq.user::lang.reportwidgets.total_registration_requests.title_default'),
                'type' => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => Lang::get('genuineq.user::lang.reportwidgets.total_registration_requests.title_validation'),
            ]
        ];
    }
}
