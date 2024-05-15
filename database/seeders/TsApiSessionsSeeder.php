<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TsApiSessionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('ts_api_sessions')->insert([
            'request_token' => '123456789YY',
            'initial_session' => null,
            'session' => '123456789XX',
            'api_key' => null,
            'casino_id' => 1,
            'player_id' => null,
            'provider_id' => 1,
            'is_active' => 1,
            'game_name' => 'sample_game',
            'status' => 'created',
            'url' => 'https://example.com',
            'error' => null,
            'is_demo' => 0,
            'free_spin' => 0,
            'free_spin_played' => 0,
            'free_spin_token' => null,
            'free_spin_activated' => 0,
            'device' => 'desktop',
            'lang' => 'en',
            'currency' => 'USD',
            'provider' => 'sample_provider',
            'parent_provider' => 'sample_parent_provider',
            'modify_uid' => null,
            'create_dt' => now(),
            'modify_dt' => now(),
            'is_lobby' => 0,
        ]);
    }
}