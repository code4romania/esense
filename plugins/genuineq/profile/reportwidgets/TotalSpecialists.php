<?php namespace Genuineq\Profile\ReportWidgets;

use DB;
use Lang;
use Backend\Classes\ReportWidgetBase;

class TotalSpecialists extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['labelSpecialists'] = Lang::get('genuineq.profile::lang.reportwidgets.total_specialists.label');

            /** Get no of activated account specialists from database  */
            $this->vars['totalSpecialists'] = DB::table('backend_users')
                ->join('genuineq_profile_specialists', function ($join) {
                    $join->on('backend_users.id', '=', 'genuineq_profile_specialists.id')
                        ->where('backend_users.is_activated', '=', 1);
                })
                ->count();

        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => Lang::get('genuineq.profile::lang.reportwidgets.total_specialists.label'),
                'type' => 'string',
                'validationPattern' => '^.+$',
            ]
        ];
    }
}
