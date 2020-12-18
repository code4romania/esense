<?php namespace Genuineq\Students\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateTablesStudentsStudentsAndContactPersons extends Migration
{
    public function up()
    {
        /** create new Student_id column */
        Schema::table('genuineq_students_contact_persons', function($table)
        {
            $table->integer('student_id')->unsigned()->after('id');
        });

        /** get all students and contact persons */
        $students = \Genuineq\Students\Models\Student::select(
            'id',
            'contact_person_1_id',
            'contact_person_2_id',
            'contact_person_3_id',
            'contact_person_4_id',
            'contact_person_5_id'
        )->get();

        foreach ($students as $student) {

            for ($i = 1; $i <= 5; $i++) {
                $contactId = 'contact_person_' . $i . '_id';

                /** check if a contact person column has NULL value */
                if (/*NOT*/ !is_null($student->$contactId)) {

                    /** get contact person by ID  */
                    $contactPerson = \Genuineq\Students\Models\ContactPerson::find($student->$contactId);

                    /** set corresponding student id to contact person and save */
                    $contactPerson->student_id = $student->id;
                    $contactPerson->save();
                }
            }
        }


        Schema::table('genuineq_students_students', function($table)
        {
            $table->dropColumn('contact_person_1_id');
            $table->dropColumn('contact_person_2_id');
            $table->dropColumn('contact_person_3_id');
            $table->dropColumn('contact_person_4_id');
            $table->dropColumn('contact_person_5_id');
        });
    }

    public function down()
    {
        Schema::table('genuineq_students_students', function($table)
        {
            $table->integer('contact_person_1_id')->unsigned()->nullable()->after('id');
            $table->integer('contact_person_2_id')->unsigned()->nullable()->after('contact_person_1_id');
            $table->integer('contact_person_3_id')->unsigned()->nullable()->after('contact_person_2_id');
            $table->integer('contact_person_4_id')->unsigned()->nullable()->after('contact_person_3_id');
            $table->integer('contact_person_5_id')->unsigned()->nullable()->after('contact_person_4_id');
        });

        $contactPersons = \Genuineq\Students\Models\ContactPerson::all();


        foreach ($contactPersons as $contactPerson) {

            $student = \Genuineq\Students\Models\Student::find($contactPerson->student_id);

//            $contactPersonId[] = $contactPerson->id;

            switch ($contactPerson) {
                case (is_null($student->contact_person_1_id)):
                    $student->contact_person_1_id = $contactPerson->id;
                    $student->save();
                    break;
                case (is_null($student->contact_person_2_id)):
                    $student->contact_person_2_id = $contactPerson->id;
                    $student->save();
                    break;
                case (is_null($student->contact_person_3_id)):
                    $student->contact_person_3_id = $contactPerson->id;
                    $student->save();
                    break;
                case (is_null($student->contact_person_4_id)):
                    $student->contact_person_4_id = $contactPerson->id;
                    $student->save();
                    break;
                case (is_null($student->contact_person_5_id)):
                    $student->contact_person_5_id = $contactPerson->id;
                    $student->save();
                    break;
            }


        }

        Schema::table('genuineq_students_contact_persons', function($table)
        {
            $table->dropColumn('student_id');
        });
    }
}