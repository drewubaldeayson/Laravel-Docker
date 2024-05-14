<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiPlayersTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('casino_user_id')->nullable();
            $table->bigInteger('casino_id')->nullable();
            $table->string('username');
            $table->string('unique_id');
            $table->tinyInteger('is_blocked')->default(0);
            $table->string('currencies')->default('[]');
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_players');
    }
}