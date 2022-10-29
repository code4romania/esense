<?php namespace Genuineq\Profile\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Updates\Migration;

class AddParentTypeToUserTable extends Migration
{

    public function up()
    {

            DB::statement("ALTER TABLE users MODIFY COLUMN type ENUM('school', 'specialist', 'parent')");

    }

    public function down()
    {
    }

}
