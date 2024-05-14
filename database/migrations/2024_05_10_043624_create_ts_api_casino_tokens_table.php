<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiCasinoTokensTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_casino_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('casino_id');
            $table->string('country_iso');
            $table->text('allowed_ips');
            $table->text('allowed_domains');
            $table->tinyInteger('is_active')->default(1);
            $table->string('api_key');
            $table->string('secret_key');
            $table->enum('type', ['production', 'development']);
            $table->string('wallet_url');
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_casino_tokens');
    }
}