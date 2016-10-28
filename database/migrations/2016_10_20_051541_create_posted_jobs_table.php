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
            $table->integer('industry_id', false, true)->comment('Foreign key for industry types Nature of Job sector');

            $table->integer('place_of_employment_city_id', false, true);
            $table->integer('place_of_employment_district_id', false, true);
            $table->string('place_of_employment_city')->nullable()->comment('city');

            $table->integer('salary_offered_min', false)->nullable()->comment('Salary offered min');
            $table->integer('salary_offered_max', false)->nullable()->comment('Salary offered max');
            $table->integer('other_benefits', false)->nullable()->comment('Other benefits offered');
            $table->integer('preferred_age_min', false)->nullable()->comment('preferred age min');
            $table->integer('preferred_age_max', false)->nullable()->comment('preferred age max');
            $table->string('preferred_caste')->nullable()->comment('Preferred cast');
            //$table->enum('preferred_relegion', ['BUDDISM', 'CHRISTIANITY','HINDUISM','ISLAM','JAINISM','PARSI','SIKHISM', 'OTHERS', 'ANY']);
            $table->enum('preferred_sex', ['MALE', 'FEMALE','OTHERS', 'ANY'])->comment('gender');
            $table->integer('exam_passed_id', false, true)->comment('This will be the foreign key for exam passed');
            $table->integer('subject_id', false)->unsigned()->default('0')->comment('Subject foreign key from master subjects');
            $table->string('specialization', 50)->nullable();
            $table->integer('preferred_experience', false)->default(0)->comment('preferred years of experience');

            $table->enum('ex_service', ['YES', 'NO'])->default('NO')->comment('Whether Ex-serviceman needed');
            //Physical Measurement
            $table->decimal('physical_height', 5, 2)->nullable()->comment('in cm');
            $table->decimal('physical_weight', 5, 2)->nullable()->comment('in k.g.');
            $table->decimal('physical_chest', 5, 2)->nullable()->comment('Measurement in cm');
            $table->enum('physical_challenge', ['YES', 'NO'])->default('NO')->comment('Whether Physically Challenged ?');
            $table->enum('job_type', ['Full Time', 'Part Time'])->default('Full Time')->comment('Whether JOb is part time or full time?');
            $table->enum('job_sub_category', ['Govt. Regular', 'Govt. Contractual', 'Pvt. Regular','Pvt. Contractual', 'Not Specified'])->default('Not Specified')->comment('Sub Categories of job');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->comment('whether it is still available or filled or na, 0 means not verified, 1 means available, 2 means filled up ');
            $table->integer('created_by', false, true)->comment('The employer id , who have created this job');
            $table->integer('contact_person_id', false, true)->comment('For contact person , that candidate can contact to.');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('industry_id')->references('id')->on('industry_types');
            $table->foreign('place_of_employment_city_id')->references('id')->on('states');
            $table->foreign('place_of_employment_district_id')->references('id')->on('districts');
            $table->foreign('exam_passed_id')->references('id')->on('exams');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('created_by')->references('id')->on('employers');
            $table->foreign('contact_person_id')->references('id')->on('contact_people');
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
