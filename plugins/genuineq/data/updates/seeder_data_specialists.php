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
use Genuineq\Profile\Models\Specialist;

class SeederDataSpecialists extends Migration
{
    public function up()
    {
        if ('test' == env('ESENSE_ADD_SPECIALISTS', 'live')) {
            $faker = Faker\Factory::create();

            /** Add specialists users. */
            for ($i = 0; $i < FakeDataHelper::totalProfileSpecialistsNumber; $i++) {
                $user = User::create([
                    'name' => $faker->lastName(),
                    'surname' => $faker->firstName(),
                    'email' => 'specialist_' . ($i + 1) . '@email.com',
                    'type' => 'specialist',
                    'password' => 'Test1234%',
                    'consent' => 1,
                    'is_activated' => 1,
                    'profile_id' => ($i + 1),
                    'profile_type' => 'Genuineq\Profile\Models\Specialist',
                ]);

                $user->addGroup(UserGroup::getRegisteredGroup());
            }

            /** Clear specialists. */
            Specialist::truncate();

            /** Add specialists. */
            for ($i = 0; $i < FakeDataHelper::totalProfileSpecialistsNumber; $i++) {
                Specialist::create([
                    'id' => ($i + 1),
                    'slug' => Specialist::slug($faker->sentence($nbWords = 2, $variableNbWords = true)),
                    'phone' => $faker->tollFreePhoneNumber(),
                    'county_id' => 1,
                    'city_id' => $faker->numberBetween($min = 1, $max = FakeDataHelper::maxCityFirstCounty),
                    'school_id' => ($faker->boolean(FakeDataHelper::cachancePercentageSpecialistIsAffiliated)) ? ($faker->numberBetween($min = 1, $max = FakeDataHelper::totalProfileSchoolsNumber)) : (null),
                    'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                    'archived' => $faker->boolean(50)
                ]);
            }
        }
    }

    public function down()
    {
        if ('test' == env('ESENSE_ADD_SPECIALISTS', 'live')) {
            /** Clear specialists. */
            Specialist::truncate();

            /** Clear users. */
            User::where('profile_type', 'Genuineq\Profile\Models\Specialist')->delete();
        }
    }
}