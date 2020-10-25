<?php namespace Genuineq\Profile\ReportWidgets;

use Lang;
use Genuineq\Profile\Models\Specialist as SpecialistModel;
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
            $this->vars['totalSpecialists'] = SpecialistModel::all()->where('description' , 'specialist')->count();
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
