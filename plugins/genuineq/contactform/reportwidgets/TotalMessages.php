<?php namespace Genuineq\ContactForm\ReportWidgets;

use DB;
use Lang;
use Backend\Classes\ReportWidgetBase;

class TotalMessages extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->vars['labelMessages'] = Lang::get('genuineq.contactform::lang.reportwidgets.total_messages.label');

            /** Get no of messages from database  */
            $this->vars['totalMessages'] = DB::table('genuineq_contactform_messages')->count();

        } catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title' => Lang::get('genuineq.contactform::lang.reportwidgets.total_messages.label'),
                'type' => 'string',
                'validationPattern' => '^.+$',
            ]
        ];
    }
}
