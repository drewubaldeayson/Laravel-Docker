<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiGameProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_game_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('url');
            $table->string('port')->nullable();
            $table->tinyInteger('is_internal')->default(1);
            $table->unsignedBigInteger('modify_uid');
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_game_providers');
    }
}