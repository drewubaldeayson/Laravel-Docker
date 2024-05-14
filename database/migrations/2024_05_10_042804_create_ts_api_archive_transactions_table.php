<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiArchiveTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_archive_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id');
            $table->enum('status', ['created', 'delivered', 'failed']);
            $table->unsignedBigInteger('casino_id');
            $table->string('api_key')->nullable();
            $table->string('game_name');
            $table->unsignedBigInteger('player_id');
            $table->string('currency')->nullable();
            $table->string('session_id')->nullable();
            $table->double('bet', 8, 2)->default(0.00);
            $table->double('win', 8, 2)->default(0.00);
            $table->double('jackpot_win', 20, 2)->default(0.00);
            $table->double('refund', 8, 2)->default(0.00);
            $table->double('blocked', 8, 2)->default(0.00);
            $table->double('transfer_fund', 8, 2)->default(0.00);
            $table->text('desc')->nullable();
            $table->string('provider');
            $table->string('parent_provider');
            $table->string('game_type');
            $table->string('round_id')->nullable();
            $table->double('in_game', 8, 2)->default(0.00);
            $table->double('in_jackpot', 8, 2)->default(0.00);
            $table->string('jackpot_id')->nullable();
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->tinyInteger('transferred')->default(0);
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_archive_transactions');
    }
}