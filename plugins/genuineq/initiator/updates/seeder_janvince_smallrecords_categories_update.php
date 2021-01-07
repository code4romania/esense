<?php namespace genuineq\initiator\Updates;

use Db;
use Seeder;

class SeederJanvinceSmallrecordsCategoriesUpdate extends Seeder
{
    public function run()
    {
        /** Populate the system_settings table. */
        Db::table('janvince_smallrecords_categories')->insert(['parent_id' => 5, 'nest_left' => 10, 'nest_right' => 11, 'nest_depth' => 1, 'sort_order' => NULL, 'name' => 'Discriminare', 'slug' => 'discriminare', 'active' => 1, 'description' => '', 'content' => '']);
    }
}
