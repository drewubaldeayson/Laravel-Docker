<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ISO');
            $table->string('name');
            $table->unsignedBigInteger('modify_uid')->default(0);
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_countries');
    }
}