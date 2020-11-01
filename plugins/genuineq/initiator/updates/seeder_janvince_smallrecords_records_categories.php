<?php namespace genuineq\initiator\Updates;

use Db;
use Seeder;

class SeederJanvinceSmallrecordsRecordsCategories extends Seeder
{
    public function run()
    {
        /** Populate the system_settings table. */
        DB::table('janvince_smallrecords_records_categories')->delete();
        Db::table('janvince_smallrecords_records_categories')->insert(['record_id' => 1, 'category_id' => 4, 'created_at' => Null, 'updated_at' => Null]);
    }
}