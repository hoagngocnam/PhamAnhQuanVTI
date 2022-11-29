<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 50;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'password' => $faker->password,
                'email' => $faker->unique()->email,
                'address' => $faker->address,
            ]);
        }
    }
}