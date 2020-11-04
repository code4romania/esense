<?php namespace Genuineq\Esense\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGenuineqEsenseStudentsSpecialists extends Migration
{
    public function up()
    {
        Schema::create('genuineq_esense_connections', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('specialist_id')->unsigned();
            $table->boolean('approved')->default(false);
            $table->text('message')->nullable();
            $table->boolean('seen')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('genuineq_esense_connections');
    }
}
