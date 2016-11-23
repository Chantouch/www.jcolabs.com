<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_job', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('emp_status', ['Actively searching', 'Employed but open to opportunities', 'Employed, not open to opportunities']);
            $table->integer('candidate_id', false, true)->unsigned();
            $table->enum('contract_type', ['Full Time', 'Part Time', 'Contract', 'Freelancer', 'Internship', 'Volunteer'])->default('Full Time')->comment('Whether Job is part time, full time or others?');
            $table->enum('desired_salary', ['Unspecified', '0 - 199 USD', '200 - 499 USD', '500 - 999 USD', '1,000 - 1,999 USD', '2,000 USD+']);
            $table->integer('industry_id', false, true)->unisgned();
            $table->integer('city_id', false, true)->unisgned();
            $table->timestamps();

            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('target_job');
    }
}
