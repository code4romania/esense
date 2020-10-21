<?php namespace Genuineq\Students\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGenuineqStudentsContactPersons extends Migration
{
    public function up()
    {
        Schema::create('genuineq_students_contact_persons', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('genuineq_students_contact_persons');
    }
}