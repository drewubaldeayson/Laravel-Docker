<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TsApiCasinosSeeder extends Seeder
{
    public function run()
    {
        DB::table('ts_api_casinos')->insert([
            'name' => 'playtech',
            'short_name' => 'plytch',
            'is_blocked' => 0,
            'is_progressive_jackpot' => 0,
            'modify_uid' => null,
            'create_dt' => now(),
            'modify_dt' => now(),
            'delete_dt' => null,
        ]);
    }
}
