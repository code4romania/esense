<?php namespace Carlosrgzm\CookieConsent\Components;

use Lang;
use Cms\Classes\ComponentBase;

class CookieConsent extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'carlosrgzm.cookieconsent::lang.strings.plugin_name',
            'description' => 'carlosrgzm.cookieconsent::lang.strings.plugin_desc'
        ];
    }

    public function defineProperties()
    {
        return [
            'message' => [
                'title' => Lang::get('carlosrgzm.cookieconsent::lang.message.title'),
                'type' => Lang::get('carlosrgzm.cookieconsent::lang.message.type'),
                'default' => Lang::get('carlosrgzm.cookieconsent::lang.message.default'),
                'placeholder' => Lang::get('carlosrgzm.cookieconsent::lang.message.placeholder'),
                'validationMessage' => Lang::get('carlosrgzm.cookieconsent::lang.message.validationMessage'),
            ],
            'dismiss' => [
                'title' => Lang::get('carlosrgzm.cookieconsent::lang.dismiss.title'),
                'type' => Lang::get('carlosrgzm.cookieconsent::lang.dismiss.type'),
                'default' => Lang::get('carlosrgzm.cookieconsent::lang.dismiss.default'),
                'validationMessage' => Lang::get('carlosrgzm.cookieconsent::lang.dismiss.validationMessage'),
            ],
            'learnMore' => [
                'title' => Lang::get('carlosrgzm.cookieconsent::lang.learnMore.title'),
                'type' => Lang::get('carlosrgzm.cookieconsent::lang.learnMore.type'),
                'default' => Lang::get('carlosrgzm.cookieconsent::lang.learnMore.default'),
                'validationMessage' => Lang::get('carlosrgzm.cookieconsent::lang.learnMore.validationMessage'),
            ],
            'link' => [
                'title' => Lang::get('carlosrgzm.cookieconsent::lang.link.title'),
                'type' => Lang::get('carlosrgzm.cookieconsent::lang.link.type'),
                'default' => '/politica-de-confidentialitate',                                              /** make sure to change if the link will be changed */
                'validationMessage' => Lang::get('carlosrgzm.cookieconsent::lang.link.validationMessage'),
            ],
            'theme' => [
                'title' => Lang::get('carlosrgzm.cookieconsent::lang.theme.title'),
                'type' => Lang::get('carlosrgzm.cookieconsent::lang.theme.type'),
                'default' => Lang::get('carlosrgzm.cookieconsent::lang.theme.default'),
                'placeholder' => Lang::get('carlosrgzm.cookieconsent::lang.theme.placeholder'),
                'options' => [
                    'light-bottom' => Lang::get('carlosrgzm.cookieconsent::lang.theme.options.light-bottom'),
                    'dark-bottom' => Lang::get('carlosrgzm.cookieconsent::lang.theme.options.dark-bottom'),
                    'light-top' => Lang::get('carlosrgzm.cookieconsent::lang.theme.options.light-top'),
                    'dark-top' => Lang::get('carlosrgzm.cookieconsent::lang.theme.options.dark-top'),
                ]
            ],
        ];
    }

    public function onRender()
    {
        $this->page['message'] = $this->property('message');
        $this->page['dismiss'] = $this->property('dismiss');
        $this->page['learnMore'] = $this->property('learnMore');
        $this->page['link'] = $this->property('link');
        $this->page['theme'] = $this->property('theme');
    }

}
