<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_history', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->string('browser');
            $table->string('device');
            $table->string('url');
            $table->string('ip');
            $table->string('method')->comment('GET|POST');
            $table->integer('timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests_history');
    }
}
