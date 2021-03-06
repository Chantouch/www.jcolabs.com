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
            $table->integer('candidate_id', false, true)->unsigned();
            $table->string('company_name', 50)->nullable()->comment('Name of the Employer or Company');
            $table->tinyInteger('is_working')->nullable();
            $table->integer('city_id', false, true)->unsigned();
            $table->string('country')->nullable();
            $table->enum('contract_type', ['Full Time', 'Part Time', 'Contract', 'Freelancer', 'Internship', 'Volunteer'])->default('Full Time')->comment('Whether Job is part time, full time or others?');
            $table->string('job_title', 50)->nullable()->comment('The title of job');
            $table->integer('salary', false)->nullable()->comment('Salary');
            $table->integer('industry_id', false, true)->comment('This will be the foreign key for Industry/Sector');
            $table->longText('description')->nullable()->comment('This field is for specifying job description or anything else');
            $table->integer('department_id', false, true)->unsigned();
            $table->enum('career_level', ['Student / internship', 'Entry level', 'Experienced (non-manager)', 'Manager (supervisor of staff)', 'Executive (VP, department head, etc.)', 'Senior Executive (President, CEO, etc.)', 'Top Management', 'Other'])->default('Student / internship')->comment('Whether Ex-serviceman needed');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('industry_id')->references('id')->on('industry_types');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('department_id')->references('id')->on('departments');
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
