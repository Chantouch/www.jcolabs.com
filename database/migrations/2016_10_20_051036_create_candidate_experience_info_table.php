<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateExperienceInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_experience_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id', false, true);
            $table->string('employers_name', 50)->nullable()->comment('Name of the Employer or Company');
            $table->string('post_held', 50)->nullable()->comment('Position held');
            $table->integer('year_experience', false)->nullable()->comment('Years of experience');
            $table->integer('salary', false)->nullable()->comment('Salary');
            $table->integer('experience_id', false, true)->comment('This will be the foreign key for subjects/trade');
            $table->integer('industry_id', false, true)->comment('This will be the foreign key for Industry/Sector');
            $table->string('note')->nullable()->comment('This field is for specifying job description or anything else');
            $table->timestamps();
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('experience_id')->references('id')->on('subjects');
            $table->foreign('industry_id')->references('id')->on('industry_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_experience_details');
    }
}
