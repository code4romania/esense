<?php namespace genuineq\initiator\Updates;

use Db;
use Seeder;

class SeederJanvinceSmallrecordsAreas extends Seeder
{
    public function run()
    {
        /** Populate the system_settings table. */
        DB::table('janvince_smallrecords_areas')->delete();
        Db::table('janvince_smallrecords_areas')->insert(['id' => 1, 'name' => 'Exercises', 'slug' => 'exercises', 'active' => 1, 'description' => 'Game and exercises page', 'allowed_fields' => '["category","preview_image","description","url","favourite","content","images","images_media","tags","categories","content_blocks"]', 'custom_repeater_allow' => 0, 'custom_repeater_tab_title' => '', 'custom_repeater_prompt' => '', 'custom_repeater_min_items' => 1, 'custom_repeater_max_items' => 1, 'custom_repeater_fields' => '[]']);
        Db::table('janvince_smallrecords_areas')->insert(['id' => 2, 'name' => 'Informations', 'slug' => 'informations', 'active' => 1, 'description' => 'Util informations for teacher dashboard', 'allowed_fields' => '["category","preview_image","description","favourite","content","images","images_media","categories"]', 'created_at' => '2020-10-15 10:13:59', 'updated_at' => '2020-10-15 10:13:59', 'custom_repeater_allow' => 0, 'custom_repeater_tab_title' => '', 'custom_repeater_prompt' => '', 'custom_repeater_min_items' => 1, 'custom_repeater_max_items' => 1, 'custom_repeater_fields' => '[]']);
    }
}
