<?php namespace Genuineq\Profile\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Updates\Migration;

class SetNullableOnStudentTable extends Migration
{

    public function up()
    {
        DB::statement('ALTER TABLE `genuineq_students_students` MODIFY `birthdate` VARCHAR(100) NULL;');

    }

    public function down()
    {
    }

}
