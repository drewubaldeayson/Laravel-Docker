<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsApiFailedJobsTable extends Migration
{
    public function up()
    {
        Schema::create('ts_api_failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid');
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ts_api_failed_jobs');
    }
}