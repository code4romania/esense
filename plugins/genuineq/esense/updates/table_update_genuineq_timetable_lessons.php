<?php namespace Genuineq\Esense\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class TableUpdateGenuineqTimetableRecords extends Migration
{

    public function up()
    {
        Schema::table('genuineq_timetable_lessons', function($table)
        {
            $table->integer('connection_id')->unsigned();
            $table->string('category')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumns('genuineq_timetable_lessons', 'connection_id')) {
            Schema::table('genuineq_timetable_lessons', function ($table) {
                $table->dropColumn('connection_id');
            });
        }

        if (Schema::hasColumns('genuineq_timetable_lessons', 'category')) {
            Schema::table('genuineq_timetable_lessons', function ($table) {
                $table->dropColumn('category');
            });
        }
    }

}
