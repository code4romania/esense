<?php namespace Genuineq\ContactForm\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGenuineqContactFormMessages extends Migration
{
    public function up()
    {
        Schema::create('genuineq_contactform_messages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->text('message');
            $table->timestamp('replied_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('genuineq_contactform_messages');
    }
}
