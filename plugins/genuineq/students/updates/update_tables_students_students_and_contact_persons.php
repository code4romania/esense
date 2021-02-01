<?php namespace Genuineq\Students\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use Genuineq\Students\Models\Student;
use Genuineq\Students\Models\ContactPerson;

class UpdateTablesStudentsStudentsAndContactPersons extends Migration
{
    public function up()
    {
        /** Add student_id column to the contact persons table. */
        Schema::table('genuineq_students_contact_persons', function($table)
        {
            $table->integer('student_id')->unsigned()->after('id');
        });


        /** Get all students and contact persons. */
        $students = Student::select(
            'id',
            'contact_person_1_id',
            'contact_person_2_id',
            'contact_person_3_id',
            'contact_person_4_id',
            'contact_person_5_id'
        )->get();

        /** Parse all Students and make set the student_id. */
        foreach ($students as $student) {
            for ($i = 1; $i <= 5; $i++) {
                $contactId = 'contact_person_' . $i . '_id';

                /** Check if a contact person column has NULL value. */
                if (/*NOT*/ !is_null($student->$contactId)) {

                    /** Get contact person by ID.  */
                    $contactPerson = ContactPerson::find($student->$contactId);

                    /** Set corresponding student id to contact person and save. */
                    $contactPerson->student_id = $student->id;
                    $contactPerson->save();
                }
            }
        }

        /** Remove the "contact_person_x_id" columns. */
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


        /** Extract all contact persons. */
        $contactPersons = ContactPerson::all();

        /** Parse all contact persons and set the "contact_person_x_id" columns values. */
        foreach ($contactPersons as $contactPerson) {
            /** Find a student by ID from contact person. */
            $student = Student::find($contactPerson->student_id);

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

        /** Remov the student_id column from the contact persons table. */
        Schema::table('genuineq_students_contact_persons', function($table)
        {
            $table->dropColumn('student_id');
        });
    }
}
