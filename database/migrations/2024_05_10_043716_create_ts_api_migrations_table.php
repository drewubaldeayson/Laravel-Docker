<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiMigrationsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_migrations', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('migration');
            $table->integer('batch');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_migrations');
    }
}
