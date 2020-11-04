<?php namespace Genuineq\Esense\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGenuineqEsenseStudentsTransfers extends Migration
{
    public function up()
    {
        Schema::create('genuineq_esense_students_transfers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('from_specialist_id')->unsigned();
            $table->integer('to_specialist_id')->unsigned();
            $table->boolean('approved')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('genuineq_esense_students_transfers');
    }
}
