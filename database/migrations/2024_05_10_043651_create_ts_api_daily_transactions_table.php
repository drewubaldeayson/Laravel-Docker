<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiDailyTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_daily_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('casino_id');
            $table->unsignedBigInteger('player_id')->nullable();
            $table->string('api_key');
            $table->string('game_name');
            $table->string('currency');
            $table->decimal('bet', 10, 2);
            $table->decimal('win', 10, 2);
            $table->decimal('refund', 10, 2);
            $table->decimal('blocked', 10, 2)->nullable();
            $table->decimal('transfer_fund', 10, 2)->nullable();
            $table->string('provider');
            $table->string('parent_provider');
            $table->string('game_type')->nullable();
            $table->decimal('in_game', 10, 2)->nullable();
            $table->decimal('in_jackpot', 10, 2)->nullable();
            $table->decimal('RTP', 10, 2)->nullable();
            $table->decimal('GGR', 10, 2)->nullable();
            $table->dateTime('date');
            $table->enum('type', ['casino', 'game', 'player']);
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_daily_transactions');
    }
}