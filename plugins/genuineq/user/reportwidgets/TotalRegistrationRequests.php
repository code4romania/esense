<?php namespace Genuineq\User\ReportWidgets;

use Lang;
use Backend\Classes\ReportWidgetBase;
use Genuineq\User\Models\User as UserModel;

class TotalRegistrationRequests extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['labelRegistrationRequests'] = Lang::get('genuineq.user::lang.reportwidgets.total_registration_requests.label');

            /** Get no of inactive user accounts (== user requests) from database  */
            $this->vars['totalRegistrationRequests'] = UserModel::where('is_activated', 0)->count();

        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => Lang::get('genuineq.user::lang.reportwidgets.total_registration_requests.label'),
                'type' => 'string',
                'validationPattern' => '^.+$',
            ]
        ];
    }
}
