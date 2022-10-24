<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->smallInteger('gender')->comment('1 for male and 2 for female');
            $table->string('email');
            $table->smallInteger('age');
            $table->smallInteger('height');
            $table->smallInteger('weight');
            $table->char('country_code', 2);
            $table->string('phone_code');
            $table->string('phone_number');
            $table->string('social_network_note')->nullable();
            $table->boolean('is_qualified')->default(null)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
