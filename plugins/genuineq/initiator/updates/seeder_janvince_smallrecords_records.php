<?php namespace genuineq\initiator\Updates;

use Db;
use Seeder;

class SeederJanvinceSmallrecordsRecords extends Seeder
{
    public function run()
    {
        /** Populate the system_settings table. */
        DB::table('janvince_smallrecords_records')->delete();
        Db::table('janvince_smallrecords_records')->insert(['id' => 1, 'area_id' => 2, 'category_id' => 4, 'name' => 'Introducere în platformă', 'slug' => 'introducere-in-platforma', 'description' => Null, 'content' => Null, 'url' => Null, 'date' => Null, 'favourite' => 0, 'repeater' => Null, 'created_at' => '2020-10-15 10:13:59', 'updated_at' => '2020-10-15 10:13:59', 'testimonials' => Null, 'preview_image_media' => Null, 'sort_order' => 1, 'images_media' => Null, 'content_blocks' => Null, 'custom_repeater' => Null, 'created_by' => Null, 'updated_by' => Null ]);
    }
}