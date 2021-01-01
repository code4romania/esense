<?php namespace genuineq\initiator\Updates;

use DB;
use Seeder;

class SeederJanvinceSmallrecordsAreasUpdate extends Seeder
{
    public function run()
    {
        /** Update janvince_smallrecords_areas table with modified terms */
        DB::table('janvince_smallrecords_areas')->where(['id' => 1])->update(['name' => 'Exerciții', 'slug' => 'exercitii', 'active' => 1, 'description' => 'Pagina cu jocuri și exerciții', 'allowed_fields' => '["category","preview_image","description","url","favourite","content","images","images_media","tags","categories","content_blocks"]', 'custom_repeater_allow' => 0, 'custom_repeater_tab_title' => '', 'custom_repeater_prompt' => '', 'custom_repeater_min_items' => 1, 'custom_repeater_max_items' => 1, 'custom_repeater_fields' => '[]']);
        DB::table('janvince_smallrecords_areas')->where(['id' => 2])->update(['name' => 'Informații', 'slug' => 'informatii', 'active' => 1, 'description' => 'Informații utile pentru panoul de control al specialistului', 'allowed_fields' => '["category","preview_image","description","favourite","content","images","images_media","categories"]', 'created_at' => '2020-10-15 10:13:59', 'updated_at' => '2020-10-15 10:13:59', 'custom_repeater_allow' => 0, 'custom_repeater_tab_title' => '', 'custom_repeater_prompt' => '', 'custom_repeater_min_items' => 1, 'custom_repeater_max_items' => 1, 'custom_repeater_fields' => '[]']);
    }
}
