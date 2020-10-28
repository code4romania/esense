<?php namespace Genuineq\Profile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ExtendUserPluginUsersTable extends Migration
{

    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->integer('profile_id')->unsigned()->nullable();
            $table->string('profile_type')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasTable('users') && Schema::hasColumns('users', ['profile_id', 'profile_type'])) {
            Schema::table('users', function ($table) {
                $table->dropColumn(['profile_id', 'profile_type']);
            });
        }
    }

}
