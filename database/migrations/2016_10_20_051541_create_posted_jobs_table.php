<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posted_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_job_id')->comment('Job ID')->unique();
            $table->string('post_name')->comment('Name of the POST');
            $table->string('slug')->unique();
            $table->integer('no_of_post', false)->nullable();
            $table->integer('industry_id', false, true)->unsigned()->comment('Foreign key for industry types Nature of Job sector');
            $table->integer('category_id', false, true)->unsigned()->comment('Foreign key for category types Nature of Job sector');
            $table->integer('place_of_employment_city_id', false, true)->unsigned();
            $table->integer('place_of_employment_district_id', false, true)->unsigned();
            $table->integer('salary_offered_min', false)->nullable()->comment('Salary offered min');
            $table->integer('salary_offered_max', false)->nullable()->comment('Salary offered max');
            $table->longText('other_benefits')->nullable()->comment('Other benefits offered');
            $table->integer('preferred_age_min', false)->nullable()->comment('preferred age min');
            $table->integer('preferred_age_max', false)->nullable()->comment('preferred age max');
            $table->timestamp('published_date')->comment('Date of publishing job');
            $table->timestamp('closing_date')->nullable()->comment('Date of closing job');
            $table->enum('preferred_religion', ['BUDDHISM', 'CHRISTIANITY', 'HINDUISM', 'ISLAM', 'JAINISM', 'PARSI', 'SIKHISM', 'OTHERS', 'ANY']);
            $table->enum('preferred_sex', ['MALE', 'FEMALE', 'OTHERS', 'ANY'])->comment('gender');
            $table->integer('subject_id', false)->unsigned()->default('0')->comment('Subject foreign key from master subjects');
            $table->integer('preferred_experience', false)->default(0)->comment('preferred years of experience');
            $table->enum('level', ['Non-Executive', 'Fresh Entry', 'Junior', 'Senior', 'Manager', 'CEO', 'Top Management'])->default('Non-Executive')->comment('Whether Ex-serviceman needed');
            $table->enum('job_type', ['Full Time', 'Part Time', 'Contract', 'Freelancer', 'Internship', 'Volunteer'])->default('Full Time')->comment('Whether Job is part time, full time or others?');
            $table->longText('description')->nullable();
            $table->integer('qualification_id')->unsigned()->nullable()->comment('Store qualification for candidate needed');
            $table->boolean('is_negotiable')->nullable()->comment('Store salary negotiable');
            $table->tinyInteger('is_expired')->nullable()->default(0);
            $table->longText('requirement_description')->nullable();
            $table->tinyInteger('status')->comment('whether it is still available or filled or na, 0 means not verified, 1 means available, 2 means filled up ');
            $table->integer('created_by', false, true)->unsigned()->comment('The employer id , who have created this job');
            $table->integer('contact_person_id', false, true)->unsigned()->comment('For contact person , that candidate can contact to.');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('industry_id')->references('id')->on('industry_types')->onDelete('cascade');
            $table->foreign('place_of_employment_city_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('place_of_employment_district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('employers')->onDelete('cascade');
            $table->foreign('contact_person_id')->references('id')->on('contact_people')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posted_jobs');
    }
}
