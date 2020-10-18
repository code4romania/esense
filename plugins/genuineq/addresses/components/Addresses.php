<?php namespace Genuineq\Addresses\Components;

use Log;
use Lang;
use Auth;
use Flash;
use Event;
use Request;
use Redirect;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Genuineq\Addresses\Models\Region;
use Genuineq\Addresses\Models\County;
use Genuineq\Addresses\Models\City;

/**
 * Addresses component
 *
 * Allows to extract and search addresses.
 */
class Addresses extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.addresses::lang.components.addresses.name',
            'description' => 'genuineq.addresses::lang.components.addresses.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'addresses' => [
                 'title'       => 'Addresses',
                 'description' => 'Publish addresses array',
                 'default'     => false,
                 'type'        => 'checkbox',
            ],
            'counties' => [
                'title'        => 'Counties',
                'description'  => 'Publish counties array',
                'default'      => false,
                'type'         => 'checkbox',
           ],
           'cities' => [
               'title'        => 'Cities',
               'description'  => 'Publish cities array',
               'default'      => false,
               'type'         => 'checkbox',
          ],
        ];
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
        if ($this->property('addresses')) {
            /* Extract all the addresses in JSON format. */
            foreach (City::all() as $city) {
                $addresses[$city->name . ', ' . $city->county->name] = $city->id;
            }
            $this->page['addresses'] = json_encode($addresses);
        }

        if ($this->property('counties')) {
            /* Extract all the counties in JSON format. */
            $counties = [];
            foreach (County::all() as $county) {
                $counties[$county->id] = $county->name;
            }
            $this->page['counties'] = $counties;
        }
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        $this->prepareVars();
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /**
     * Function that extracts the cities of a county.
     */
    public function onGetCities()
    {
        /** Extract the county. */
        $county = County::find(post('countyId'));

        /* Extract all the addresses in JSON format. */
        foreach ($county->cities as $city) {
            $cities[$city->name] = $city->id;
        }

        /** Return the counties cities in JSON format. */
        return $cities;
    }

    /***********************************************
     ******************* Helpers *******************
     ***********************************************/
}
