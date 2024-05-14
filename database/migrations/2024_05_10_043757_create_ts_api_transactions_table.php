<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id');
            $table->enum('status', ['created', 'delivered', 'failed']);
            $table->unsignedBigInteger('casino_id');
            $table->string('api_key')->nullable();
            $table->string('game_name');
            $table->unsignedBigInteger('player_id');
            $table->string('currency')->nullable();
            $table->string('session_id')->nullable();
            $table->double('bet')->default(0);
            $table->double('win')->default(0);
            $table->double('jackpot_win', 20, 2)->default(0.00);
            $table->double('refund')->default(0);
            $table->double('blocked')->default(0);
            $table->double('transfer_fund')->default(0);
            $table->text('desc')->nullable();
            $table->string('provider');
            $table->string('parent_provider');
            $table->string('game_type');
            $table->string('round_id')->nullable();
            $table->double('in_game')->default(0);
            $table->double('in_jackpot')->default(0);
            $table->string('jackpot_id')->nullable();
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
            $table->tinyInteger('transferred')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_transactions');
    }
}
