<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiGamesTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('game_provider_id');
            $table->string('game_name');
            $table->string('game_title');
            $table->string('game_type');
            $table->string('provider_name');
            $table->tinyInteger('is_active')->default(0);
            $table->string('lang')->default('[]');
            $table->string('devices')->default('[]');
            $table->longText('currency')->default('["USD"]');
            $table->tinyInteger('have_jackpot')->default(0);
            $table->tinyInteger('have_free_spin')->default(0);
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_games');
    }
}