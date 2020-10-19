<?php namespace genuineq\initiator\Updates;

use Db;
use Seeder;

class RainlabTranslateLocale extends Seeder
{
    public function run()
    {
        /** Populate the system_settings table. */
        DB::table('rainlab_translate_locales')->delete();
        Db::table('rainlab_translate_locales')->insert(['id' => 1, 'code' => 'en', 'name' => 'English',  'is_default' => 0, 'is_enabled' => 1, 'sort_order' => 1]);
        Db::table('rainlab_translate_locales')->insert(['id' => 2, 'code' => 'ro', 'name' => 'Romanian', 'is_default' => 1, 'is_enabled' => 1, 'sort_order' => 2]);
    }
}
