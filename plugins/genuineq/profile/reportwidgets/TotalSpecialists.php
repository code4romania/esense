<?php namespace Genuineq\Profile\ReportWidgets;

use Lang;
use Genuineq\User\Models\User;
use Backend\Classes\ReportWidgetBase;

class TotalSpecialists extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['labelSpecialists'] = Lang::get('genuineq.profile::lang.reportwidgets.total_specialists.frontend.label_specialists');
            $this->vars['totalSpecialists'] = User::all()->where('type' , 'specialist')->count();
        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => Lang::get('genuineq.profile::lang.reportwidgets.total_specialists.title'),
                'default' => Lang::get('genuineq.profile::lang.reportwidgets.total_specialists.title_default'),
                'type' => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => Lang::get('genuineq.profile::lang.reportwidgets.total_specialists.title_validation'),
            ]
        ];
    }
}
