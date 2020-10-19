<?php namespace Genuineq\Timetable\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGenuineqTimetableRecords extends Migration
{
    public function up()
    {
        Schema::table('genuineq_timetable_records', function($table)
        {
            $table->timestamp('created_at')->nullable(false)->default('CURRENT_TIMESTAMP')->change();
        });
    }
    
    public function down()
    {
        Schema::table('genuineq_timetable_records', function($table)
        {
            $table->timestamp('created_at')->nullable()->default(null)->change();
        });
    }
}