<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id', false, true)->unsigned();
            $table->string('field_of_study')->nullable();
            $table->string('school_university_name')->nullable();
            $table->enum('degree_level', ['HS', 'VT', 'DIPLO', 'BA', 'MBA', 'PHD'])->nullable();
            $table->tinyInteger('is_studying')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('country_name')->nullable();
            $table->integer('city_id', false, true)->unsigned();
            $table->string('grade')->comment('e.g 9/10, A, 100%')->nullable();
            $table->longText('description')->nullable();
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('edu_details');
    }
}
