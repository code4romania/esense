<?php namespace Genuineq\Addresses\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGenuineqAddressesCities extends Migration
{
    public function up()
    {
        Schema::create('genuineq_addresses_cities', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('slug')->unique();
            $table->string('name');
            $table->integer('county_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('genuineq_addresses_cities');
    }
}
