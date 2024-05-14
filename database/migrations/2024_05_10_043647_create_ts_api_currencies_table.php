<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ISO');
            $table->unsignedBigInteger('modify_uid')->default(0);
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_currencies');
    }
}