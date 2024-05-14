<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiInCallsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_in_calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');
            $table->string('call_token')->nullable();
            $table->string('api_key')->nullable();
            $table->longText('header');
            $table->longText('body');
            $table->enum('type', ['create new player', 'game url request', 'get user balance', 'balance update', 'balance refund', 'block balance', 'release balance', 'playtech auth', 'playtech bet', 'playtech game result', 'playtech submit dialog', 'playtech keep alive', 'playtech logout', 'playtech transfer found', 'playtech leave tip', 'playtech notify bonus event', 'playtech italy bring money to table', 'playtech italy end table session', 'playtech end session', 'playtech remove free spin of session']);
            $table->enum('from', ['game_provider', 'casino']);
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('modify_uid');
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_in_calls');
    }
}