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
            $table->string('full_name', 50);
            $table->string('spouse_name', 50)->nullable();
            //$table->string('index_card_no', 100)->unique();
            $table->string('index_card_no', 100)->nullable()->comment('This will be the index no that will be generated as soon as he enters his education details');
            $table->enum('sex', ['MALE', 'FEMALE', 'OTHERS'])->comment('gender');
            $table->enum('religion', ['BUDDHISM', 'CHRISTIANITY', 'HINDUISM', 'ISLAM', 'JAINISM', 'PARSI', 'SIKHISM', 'OTHERS']);
            $table->enum('marital_status', ['UNMARRIED', 'MARRIED', 'DIVORCEE', 'WIDOW'])->default('UNMARRIED');
            $table->date('dob')->comment('Date of birth');
            $table->string('address')->nullable();
            $table->integer('city_id', false)->nullable()->unsigned()->comment('State now only for arunachal');
            $table->integer('district_id', false)->nullable()->unsigned()->comment('District foreign key');
            $table->integer('pin_code', false)->nullable();
            $table->integer('institute_id', false)->nullable();
            //Physical Measurement
            $table->decimal('physical_height', 5, 2)->nullable()->comment('in cm');
            $table->decimal('physical_weight', 5, 2)->nullable()->comment('in k.g.');
            $table->string('photo_url', 200)->nullable()->comment('Photo URL');
            $table->string('cv_url', 200)->nullable()->comment('CV URL');
            //Additional Information :
            $table->integer('proof_details_id', false, true)->comment('Proof of Residence');
            $table->string('proof_no', 100)->nullable()->comment('Residence Proof/Id No');
            $table->enum('relocated', ['No', 'Within State', 'Within Country', 'Outside Country'])->default('No')->comment('Willing to Relocate :');
            $table->string('additional_info')->nullable()->comment('Additional Information');
            $table->timestamps();
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('institute_id')->references('id')->on('institutes');
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
