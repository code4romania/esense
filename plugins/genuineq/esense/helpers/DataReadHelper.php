<?php namespace Genuineq\Esense\Helpers;

class DataReadHelper
{
    /**
     * Function that extracts values from a received array.
     * Structure example:
     *  array (
     *      0 => array (
     *          'value' => 'Value',
     *          'name' => 'name',
     *      ),
     *      1 => array (
     *          'value' => 'Value',
     *          'name' => 'name',
     *      ),
     *  )
     *
     *
     * @return String
     */
    public static function extractValues($inputValue)
    {
        $names = '';

        foreach (json_decode($inputValue, true) as $key => $array) {
            if (0 == $key) {
                $names .= $array['name'];
            } else {
                $names .= ',' . $array['name'];
            }
        }

        return $names;
    }
}
