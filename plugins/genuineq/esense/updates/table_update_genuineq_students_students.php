<?php namespace Genuineq\Esense\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class TableUpdateGenuineqStudentsStudents extends Migration
{

    public function up()
    {
        Schema::table('genuineq_students_students', function($table)
        {
            $table->integer('owner_id')->unsigned()->nullable();
            $table->string('owner_type')->nullable();
            $table->boolean('archived')->default(false);
        });
    }

    public function down()
    {
        if (Schema::hasColumns('genuineq_students_students', 'owner_id')) {
            Schema::table('genuineq_students_students', function ($table) {
                $table->dropColumn('owner_id');
            });
        }

        if (Schema::hasColumns('genuineq_students_students', 'owner_type')) {
            Schema::table('genuineq_students_students', function ($table) {
                $table->dropColumn('owner_type');
            });
        }

        if (Schema::hasColumn('genuineq_students_students', 'archived')) {
            Schema::table('genuineq_students_students', function ($table) {
                $table->dropColumn('archived');
            });
        }
    }

}
