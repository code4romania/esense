<?php namespace Genuineq\Timetable\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGenuineqTimetableLessons extends Migration
{
    public function up()
    {
        Schema::create('genuineq_timetable_lessons', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->date('day');
            $table->time('start_hour');
            $table->time('end_hour');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('genuineq_timetable_lessons');
    }
}
