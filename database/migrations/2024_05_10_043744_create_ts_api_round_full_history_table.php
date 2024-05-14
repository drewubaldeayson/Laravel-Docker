<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiRoundFullHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_round_full_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_uuid');
            $table->text('game_history_url');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_round_full_history');
    }
}