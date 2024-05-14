<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiMonthTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_month_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('casino_id');
            $table->string('api_key')->nullable();
            $table->string('game_name')->nullable();
            $table->string('currency')->nullable();
            $table->double('bet', 8, 2)->default(0.00);
            $table->double('win', 8, 2)->default(0.00);
            $table->double('refund', 8, 2)->default(0.00);
            $table->double('blocked', 8, 2)->default(0.00);
            $table->double('transfer_fund', 8, 2)->default(0.00);
            $table->string('provider')->nullable();
            $table->string('parent_provider')->nullable();
            $table->string('game_type')->nullable();
            $table->double('in_game', 8, 2)->default(0.00);
            $table->double('in_jackpot', 8, 2)->default(0.00);
            $table->double('GGR', 8, 2)->default(0.00);
            $table->double('RTP', 8, 2)->default(0.00);
            $table->string('date');
            $table->enum('type', ['casino', 'game']);
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_month_transactions');
    }
}
