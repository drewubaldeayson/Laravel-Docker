<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiCasinoProviderTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_casino_provider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('casino_id');
            $table->unsignedBigInteger('provider_id');
            $table->double('jackpot_distrib_percent', 8, 2)->default(0.00);
            $table->double('casino_percent', 8, 2)->default(0.00);
            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('modify_uid');
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_casino_provider');
    }
}