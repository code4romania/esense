<?php namespace Genuineq\Profile\ReportWidgets;

use Lang;
use Backend\Classes\ReportWidgetBase;
use Genuineq\User\Models\User as USerModel;

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
            $this->vars['totalSchools'] = UserModel::where('is_activated', 1)->where('type', 'school')->count();

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
