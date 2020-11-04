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
            $this->vars['labelMessages'] = Lang::get('genuineq.contactform::lang.reportwidgets.total_messages.title');

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
                'title' => Lang::get('genuineq.contactform::lang.reportwidgets.total_messages.title'),
                'default' => Lang::get('genuineq.contactform::lang.reportwidgets.total_messages.title_default'),
                'type' => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => Lang::get('genuineq.contactform::lang.reportwidgets.total_messages.title_validation'),
            ]
        ];
    }
}
