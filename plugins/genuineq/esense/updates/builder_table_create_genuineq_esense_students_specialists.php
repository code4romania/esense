<?php namespace Genuineq\Esense\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGenuineqEsenseStudentsSpecialists extends Migration
{
    public function up()
    {
        Schema::create('genuineq_esense_students_specialists', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('student_id')->unsigned();
            $table->integer('specialist_id')->unsigned();
            $table->boolean('approved')->default(false);
            $table->text('message')->nullable();
            $table->boolean('seen')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['student_id','specialist_id'], 'genuineq_esense_students_specialists_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('genuineq_esense_students_specialists');
    }
}
