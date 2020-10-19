<?php namespace genuineq\initiator\Updates;

use Db;
use Seeder;

class SeederJanvinceSmallrecordsCategories extends Seeder
{
    public function run()
    {
        /** Populate the system_settings table. */
        DB::table('janvince_smallrecords_categories')->delete();
        Db::table('janvince_smallrecords_categories')->insert(['id' => 1, 'parent_id' => 5, 'nest_left' => 4, 'nest_right' => 5, 'nest_depth' => 1, 'sort_order' => NULL, 'name' => 'Stimulare', 'slug' => 'stimulare', 'active' => 1, 'description' => '', 'content' => '']);
        Db::table('janvince_smallrecords_categories')->insert(['id' => 2, 'parent_id' => 5, 'nest_left' => 6, 'nest_right' => 7, 'nest_depth' => 1, 'sort_order' => NULL, 'name' => 'Identificare', 'slug' => 'identificare', 'active' => 1, 'description' => '', 'content' => '']);
        Db::table('janvince_smallrecords_categories')->insert(['id' => 3, 'parent_id' => 5, 'nest_left' => 8, 'nest_right' => 9, 'nest_depth' => 1, 'sort_order' => NULL, 'name' => 'Localizare', 'slug' => 'localizare', 'active' => 1, 'description' => '', 'content' => '']);
        Db::table('janvince_smallrecords_categories')->insert(['id' => 4, 'parent_id' => NULL, 'nest_left' => 1, 'nest_right' => 2, 'nest_depth' => 0, 'sort_order' => NULL, 'name' => 'Introducere în platformă', 'slug' => 'introducere-in-platforma', 'active' => 1, 'description' => '', 'content' => '']);
        Db::table('janvince_smallrecords_categories')->insert(['id' => 5, 'parent_id' => NULL, 'nest_left' => 3, 'nest_right' => 10, 'nest_depth' => 0, 'sort_order' => NULL, 'name' => 'Jocuri', 'slug' => 'jocuri', 'active' => 1, 'description' => '', 'content' => '']);
    }
}
