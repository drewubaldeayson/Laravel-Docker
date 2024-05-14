<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiCasinosTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_casinos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('short_name', 10);
            $table->tinyInteger('is_blocked')->default(0);
            $table->tinyInteger('is_progressive_jackpot')->default(0);
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
            $table->dateTime('delete_dt')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_casinos');
    }
}