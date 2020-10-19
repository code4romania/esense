<?php namespace genuineq\initiator\Updates;

use Db;
use Seeder;

class SeederOCookie extends Seeder
{
    public function run()
    {
        /** Populate the ajaylulia_ocookie_configuration table. */
        DB::table('ajaylulia_ocookie_configuration')->delete();
        Db::table('ajaylulia_ocookie_configuration')->insert([
            'id' => '1',
            'display_position' => 'rounded',
            'button_text' => 'Acceptare cookie-uri',
            'background_color' => '#0e4870',
            'text_color' => '#ffffff',
            'link_color' => '#a4cbea',
            'button_background_color' => '#fab954',
            'button_text_color' => '#000000',
            'cookie_content' => 'Acest website folosește cookie-uri pentru a-ți asigura cea mai bună experiență. <a href="https:\/\/www.esense.ro\/politica-de-confidentialitate" target="_blank">Politică de confidențialitate.</a>',
        ]);
    }
}
