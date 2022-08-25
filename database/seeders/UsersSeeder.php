<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Clear users. */
        User::truncate();

        $user = User::factory()->create([
            'name' => 'Test',
            'surname' => 'School',
            'email' => 'school@email.com',
            'type' => 'school',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'consent' => 1,
            'is_activated' => 1,
        ]);

        $user->groups = [
            UserGroup::getRegisteredGroup()
        ];

//        /** Clear schools. */
//        School::truncate();
//
//        /** Add schools. */
//        for ($i = 0; $i < FakeDataHelper::totalProfileSchoolsNumber; $i++) {
//            School::create([
//                'id' => ($i + 1),
//                'slug' => School::slug($faker->sentence($nbWords = 2, $variableNbWords = true)),
//                'name' => $faker->company(),
//                'county_id' => 1,
//                'city_id' => $faker->numberBetween($min = 1, $max = FakeDataHelper::maxCityFirstCounty),
//                'phone' => $faker->tollFreePhoneNumber(),
//                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
//            ]);
//        }
    }
}
