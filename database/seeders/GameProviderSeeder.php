<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'name' => 'Spribe',
                'url' => 'https://spribe.co/games',
                'modify_uid' => 0,
                'create_dt' => now(),
                'modify_dt' => now(),
            ]
        );
        
        DB::table('ts_api_game_providers')->insert($data);
    }
}