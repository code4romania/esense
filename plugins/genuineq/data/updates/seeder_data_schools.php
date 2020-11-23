<?php namespace Genuineq\Data\Updates;

use October\Rain\Database\Updates\Migration;
use Carbon\Carbon;
use Faker;
use Db;
use Log;
use Hash;

use Genuineq\Data\Helpers\FakeDataHelper;
use Genuineq\User\Models\User;
use Genuineq\User\Models\UserGroup;
use Genuineq\Profile\Models\School;

class SeederDataSchools extends Migration
{
    public function up()
    {
        if ('test' == env('ESENSE_ADD_SCHOOLS', 'live')) {
            $faker = Faker\Factory::create();

            /** Clear users. */
            User::truncate();

            /** Add school users. */
            for ($i = 0; $i < FakeDataHelper::totalProfileSchoolsNumber; $i++) {
                $user = User::create([
                    'name' => $faker->lastName(),
                    'surname' => $faker->firstName(),
                    'email' => 'school_' . ($i + 1) . '@email.com',
                    'type' => 'school',
                    'password' => 'Test1234%',
                    'consent' => 1,
                    'is_activated' => 1,
                    'profile_id' => ($i + 1),
                    'profile_type' => 'Genuineq\Profile\Models\School',
                ]);

                $user->addGroup(UserGroup::getRegisteredGroup());
            }

            /** Clear schools. */
            School::truncate();

            /** Add schools. */
            for ($i = 0; $i < FakeDataHelper::totalProfileSchoolsNumber; $i++) {
                School::create([
                    'id' => ($i + 1),
                    'slug' => School::slug($faker->sentence($nbWords = 2, $variableNbWords = true)),
                    'name' => $faker->company(),
                    'county_id' => 1,
                    'city_id' => $faker->numberBetween($min = 1, $max = FakeDataHelper::maxCityFirstCounty),
                    'phone' => $faker->tollFreePhoneNumber(),
                    'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                ]);
            }
        }
    }

    public function down()
    {
        if ('test' == env('ESENSE_ADD_SCHOOLS', 'live')) {
            /** Clear schools. */
            School::truncate();

            /** Clear users. */
            User::where('profile_type', 'Genuineq\Profile\Models\School')->delete();
        }
    }
}