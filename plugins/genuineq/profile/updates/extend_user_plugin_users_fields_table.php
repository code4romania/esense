<?php namespace Genuineq\Profile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ExtendUserPluginUsersFieldsTable extends Migration
{

    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->integer('phone')->nullable();
            $table->string('county_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('description')->nullable();
            $table->string('school_id')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasTable('users') && Schema::hasColumns('users', ['phone', 'county_id', 'city_id', 'description', 'school_id'])) {
            Schema::table('users', function ($table) {
                $table->dropColumn(['phone', 'county_id', 'city_id', 'description', 'school_id']);
            });
        }
    }

}
