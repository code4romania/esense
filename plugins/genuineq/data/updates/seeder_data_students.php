<?php namespace Genuineq\Data\Updates;

use October\Rain\Database\Updates\Migration;
use Carbon\Carbon;
use Faker;
use Db;
use Log;
use Hash;

use Genuineq\Data\Helpers\FakeDataHelper;
use Genuineq\Students\Models\Student;
use Genuineq\Students\Models\ContactPerson;
use Genuineq\Esense\Models\Connection;

class SeederDataStudents extends Migration
{
    public function up()
    {
        if ('test' == env('ESENSE_ADD_STUDENTS', 'live')) {
            $faker = Faker\Factory::create();

            /** Clear contact persons. */
            ContactPerson::truncate();

            /** Clear students. */
            Student::truncate();

            /** Add students. */
            for ($i = 0; $i < FakeDataHelper::totalProfileSpecialistsNumber; $i++) {
                /** Add a random number of students. */
                for ($j = 0; $j < $faker->numberBetween($min = 1, $max = FakeDataHelper::maxSpecialistStudentsNumber); $j++) {
                    $contactPersons = [
                        0 => null,
                        1 => null,
                        2 => null,
                        3 => null,
                        4 => null
                    ];

                    /** Add a variable number of contact persons. */
                    for ($k = 0; $k < $faker->numberBetween($min = 1, $max = 5); $k++) {
                        $contactPerson = ContactPerson::create([
                            'surname' => $faker->lastName(),
                            'name' => $faker->firstName(),
                            'phone' => $faker->tollFreePhoneNumber(),
                            'email' => 'contact_person_' . ($j + 1) . '_' . ($k + 1) . '@email.com',
                            'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
                        ]);

                        $contactPersons[$k] = $contactPerson->id;
                    }

                    /** Create the student. */
                    $student = Student::create([
                        'surname' => $faker->lastName(),
                        'name' => $faker->firstName(),
                        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                        'hearing_impairment' => $faker->numberBetween($min = 0, $max = 1),
                        'visual_impairment' => $faker->numberBetween($min = 0, $max = 1),
                        'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
                        'gender' => $faker->randomElement($array = ['male', 'female']),
                        'contact_person_1_id' => $contactPersons[0],
                        'contact_person_2_id' => $contactPersons[1],
                        'contact_person_3_id' => $contactPersons[2],
                        'contact_person_4_id' => $contactPersons[3],
                        'contact_person_5_id' => $contactPersons[4],
                        'owner_id' => ($i + 1),
                        'owner_type' => 'Genuineq\Profile\Models\Specialist',
                        'archived' => $faker->numberBetween($min = 0, $max = 1)
                    ]);

                    /** Create specialists connections. */
                    $specialistsIds = [/*owner*/($i + 1)];
                    for ($k = 1; $k < $faker->numberBetween($min = 1, $max = FakeDataHelper::maxStudentSpecialistsNumber); $k++) {
                        $specialistId = $faker->numberBetween($min = 1, $max = FakeDataHelper::totalProfileSpecialistsNumber);

                        while (in_array($specialistId, $specialistsIds)) {
                            $specialistId = $faker->numberBetween($min = 1, $max = FakeDataHelper::totalProfileSpecialistsNumber);
                        }
                        $specialistsIds[] = $specialistId;
                    }

                    foreach ($specialistsIds as $key => $specialistId) {
                        Connection::create([
                            'student_id' => $student->id,
                            'specialist_id' => $specialistId
                        ]);
                    }
                }
            }
        }
    }

    public function down()
    {
        if ('test' == env('ESENSE_ADD_STUDENTS', 'live')) {
            /** Clear contact persons. */
            ContactPerson::truncate();

            /** Clear students. */
            Students::truncate();
        }
    }
}
