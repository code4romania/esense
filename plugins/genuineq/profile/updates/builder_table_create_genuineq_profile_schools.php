<?php namespace Genuineq\Profile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGenuineqProfileSchools extends Migration
{
    public function up()
    {
        Schema::create('genuineq_profile_schools', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('slug')->unique();
            $table->string('name');
            $table->integer('county_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('phone', 15)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('genuineq_profile_schools');
    }
}
