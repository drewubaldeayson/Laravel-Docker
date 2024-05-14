<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiUsersTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('casino_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('role_id')->default(3);
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->tinyInteger('is_blocked')->default(0);
            $table->unsignedBigInteger('modify_uid')->nullable();
            $table->dateTime('create_dt');
            $table->dateTime('modify_dt');
            $table->dateTime('delete_dt')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_users');
    }
}