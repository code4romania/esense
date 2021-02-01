<?php namespace Genuineq\Profile\ReportWidgets;

use Lang;
use Backend\Classes\ReportWidgetBase;
use Genuineq\User\Models\User as UserModel;

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
            $this->vars['totalSpecialists'] = UserModel::where('is_activated', 1)->where('type', 'specialist')->count();

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
