<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTsApiGamesTable extends Migration
{
    public function up()
    {
        Schema::table('ts_api_games', function (Blueprint $table) {
            $table->longText('lang')->default('[]')->change();
        });
    }
}
