<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('request_token');
            $table->string('initial_session')->nullable();
            $table->string('session');
            $table->string('api_key')->nullable();
            $table->unsignedBigInteger('casino_id');
            $table->unsignedBigInteger('player_id')->nullable();
            $table->unsignedBigInteger('provider_id');
            $table->tinyInteger('is_active')->default(1);
            $table->string('game_name');
            $table->enum('status', ['created', 'error in create', 'sent', 'send faild', 'received successfully', 'confirmed']);
            $table->longText('url')->nullable();
            $table->longText('error')->nullable();
            $table->tinyInteger('is_demo')->default(0);
            $table->integer('free_spin')->default(0);
            $table->integer('free_spin_played')->default(0);
            $table->string('free_spin_token')->nullable();
            $table->tinyInteger('free_spin_activated')->default(0);
            $table->enum('device', ['mobile', 'desktop']);
            $table->string('lang');
            $table->string('currency');
            $table->string('provider');
            $table->string('parent_provider');
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
            $table->tinyInteger('is_lobby')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_sessions');
    }
}