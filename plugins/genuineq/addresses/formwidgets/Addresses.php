<?php namespace Genuineq\Addresses\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Genuineq\Addresses\Models\County;
use Log;


class Addresses extends FormWidgetBase
{
    public function widgetDetails()
    {
        return [
            'name' => 'AddressesTagRelation',
            'description' => 'Field for adding address in a tag style'
        ];
    }


    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('addresses');
    }


    public function prepareVars()
    {
        $this->vars['id'] = $this->model->id;
        $this->vars['addresses'] = County::all()->lists('name', 'slug');
        $this->vars['name'] = $this->formField->getName(). '[]';
        $this->vars['selectedValues'] = explode(',', $this->getLoadValue());
    }


    public function loadAssets()
    {
        $this->addCSs('css/addresses_taglist.css');
        $this->addJs('js/addresses_taglist.js');
    }

    public function getSaveValue($value)
    {
        return strtolower(implode(',', (!$value) ? ([]) : ($value)));
    }
}