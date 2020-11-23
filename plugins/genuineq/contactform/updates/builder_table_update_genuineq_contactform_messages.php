<?php namespace Genuineq\ContactForm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGenuineqContactformMessages extends Migration
{
    public function up()
    {
        Schema::table('genuineq_contactform_messages', function($table)
        {
            $table->text('reply_message')->default('null');
        });
    }
    
    public function down()
    {
        Schema::table('genuineq_contactform_messages', function($table)
        {
            $table->dropColumn('reply_message');
        });
    }
}
