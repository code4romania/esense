<?php namespace Genuineq\Esense\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGenuineqEsenseStudentsSpecialists extends Migration
{
    public function up()
    {
        Schema::table('genuineq_esense_students_specialists', function($table)
        {
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('genuineq_esense_students_specialists', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('deleted_at');
        });
    }
}
