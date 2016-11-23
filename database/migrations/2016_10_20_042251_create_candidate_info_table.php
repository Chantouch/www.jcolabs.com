<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id', false, true);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('index_card_no', 100)->nullable()->comment('This will be the index no that will be generated as soon as he enters his education details');
            $table->enum('sex', ['MALE', 'FEMALE', 'OTHERS'])->comment('gender');
            $table->enum('religion', ['BUDDHISM', 'CHRISTIANITY', 'HINDUISM', 'ISLAM', 'JAINISM', 'PARSI', 'SIKHISM', 'OTHERS']);
            $table->enum('marital_status', ['UNMARRIED', 'MARRIED', 'DIVORCEE', 'WIDOW'])->default('UNMARRIED');
            $table->date('dob')->comment('Date of birth');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('city_id', false)->nullable()->unsigned()->comment('State now only for arunachal');
            $table->integer('district_id', false)->nullable()->unsigned()->comment('District foreign key');
            $table->integer('pin_code', false)->nullable();
            $table->string('photo_url', 200)->nullable()->comment('Photo URL');
            $table->string('cv_url', 200)->nullable()->comment('CV URL');
            $table->timestamps();
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_info');
    }
}
