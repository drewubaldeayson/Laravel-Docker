<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiWebsocketsStatisticsEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_websockets_statistics_entries', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('app_id');
            $table->integer('peak_connection_count');
            $table->integer('websocket_message_count');
            $table->integer('api_message_count');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_websockets_statistics_entries');
    }
}
