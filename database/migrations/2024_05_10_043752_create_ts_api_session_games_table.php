<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiSessionGamesTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_session_games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('session_id');
            $table->string('game_name');
            $table->integer('free_spin')->default(0);
            $table->integer('free_spin_played')->default(0);
            $table->double('free_spin_win', 20, 2)->default(0.00);
            $table->string('free_spin_token')->nullable();
            $table->tinyInteger('free_spin_activated')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_session_games');
    }
}