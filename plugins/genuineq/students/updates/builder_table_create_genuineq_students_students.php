<?php namespace Genuineq\Students\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGenuineqStudentsStudents extends Migration
{
    public function up()
    {
        Schema::create('genuineq_students_students', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('surname');
            $table->text('description');
            $table->boolean('hearing_impairment')->default(false);
            $table->boolean('visual_impairment')->default(false);
            $table->date('birthdate');
            $table->enum('gender', ['male', 'female']);
            $table->integer('contact_person_1_id')->unsigned()->nullable();
            $table->integer('contact_person_2_id')->unsigned()->nullable();
            $table->integer('contact_person_3_id')->unsigned()->nullable();
            $table->integer('contact_person_4_id')->unsigned()->nullable();
            $table->integer('contact_person_5_id')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('genuineq_students_students');
    }
}
