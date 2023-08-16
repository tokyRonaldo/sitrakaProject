<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         $faker = Faker::create();
        // $gender = $faker->randomElement(['male', 'female']);
        $gender = $faker->randomElement(['mme', 'mr']);
        foreach (range(1,10) as $index) {
            DB::table('contacts')->insert([
                'nom' => $faker->name(),
                'surnom' => $faker->name($gender),
                'number_phone' => $faker->phoneNumber(),
                'adresse' => $faker->address(),
            ]);
        }
    }
}
