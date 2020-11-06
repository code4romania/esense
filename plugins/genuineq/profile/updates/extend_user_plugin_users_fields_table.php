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
            $table->string('county')->nullable();
            $table->string('city')->nullable();
            $table->string('description')->nullable();
            $table->string('school')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasTable('users') && Schema::hasColumns('users', ['phone', 'county', 'city', 'description', 'school'])) {
            Schema::table('users', function ($table) {
                $table->dropColumn(['phone', 'county', 'city', 'description', 'school']);
            });
        }
    }

}
