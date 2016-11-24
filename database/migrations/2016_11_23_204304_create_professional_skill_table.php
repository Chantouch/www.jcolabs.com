<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profession_skill', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 180);
            $table->integer('candidate_id', false, true)->unsigned();
            $table->enum('level', ['Beginner', 'Intermediate', 'Professional']);
            $table->enum('year_experience', ['1 year or less', '2-5 years', '5-7 years', 'More than 7 years']);
            $table->timestamps();

            $table->foreign('candidate_id')->references('id')->on('candidates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profession_skill');
    }
}
