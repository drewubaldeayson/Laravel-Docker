<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('ts_api_players')->insert([
                'casino_user_id' => $faker->unique()->randomNumber(),
                'casino_id' => $faker->randomNumber(),
                'username' => $faker->userName,
                'unique_id' => Str::random(10),
                'is_blocked' => $faker->boolean(),
                'currencies' => json_encode(['USD', 'EUR', 'MYR']),
                'modify_uid' => null,
                'create_dt' => $faker->dateTime(),
                'modify_dt' => $faker->dateTime()
            ]);
        }
    }
}