<?php namespace Genuineq\Profile\ReportWidgets;

use DB;
use Lang;
use Backend\Classes\ReportWidgetBase;

class TotalSchools extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['labelSchools'] = Lang::get('genuineq.profile::lang.reportwidgets.total_schools.label');

            /** Get no of activated account schools from database  */
            $this->vars['totalSchools'] = DB::table('backend_users')
                ->join('genuineq_profile_schools', function ($join) {
                    $join->on('backend_users.id', '=', 'genuineq_profile_schools.id')
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
                'title' => Lang::get('genuineq.profile::lang.reportwidgets.total_schools.label'),
                'type' => 'string',
                'validationPattern' => '^.+$',
            ]
        ];
    }
}
