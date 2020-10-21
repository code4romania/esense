<?php namespace Genuineq\Esense\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class TableUpdateGenuineqStudentsStudents extends Migration
{

    public function up()
    {
        Schema::table('genuineq_students_students', function($table)
        {
            $table->integer('specialist_id')->unsigned()->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('genuineq_students_students', 'specialist_id')) {
            Schema::table('genuineq_students_students', function ($table) {
                $table->dropColumn('specialist_id');
            });
        }
    }

}
