<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiOutCallsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_out_calls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');
            $table->string('call_token')->nullable();
            $table->string('session_key')->nullable();
            $table->string('transaction_key')->nullable();
            $table->string('api_key')->nullable();
            $table->longText('header');
            $table->longText('body');
            $table->integer('status_code')->nullable();
            $table->string('type')->nullable();
            $table->enum('to', ['game_provider', 'casino']);
            $table->unsignedBigInteger('reciever_id');
            $table->unsignedBigInteger('modify_uid');
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_out_calls');
    }
}
