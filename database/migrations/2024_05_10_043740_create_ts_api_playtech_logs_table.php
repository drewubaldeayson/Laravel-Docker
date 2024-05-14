<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiPlaytechLogsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_playtech_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('is_request');
            $table->string('requestId');
            $table->string('gameRoundCode')->nullable();
            $table->string('transactionCode')->nullable();
            $table->string('externalToken')->nullable();
            $table->string('internal_transaction_key')->nullable();
            $table->longText('body');
            $table->string('type');
            $table->unsignedBigInteger('modify_uid');
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_playtech_logs');
    }
}