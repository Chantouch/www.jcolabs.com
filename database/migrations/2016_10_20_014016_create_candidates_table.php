<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('email')->unique()->default('candidate@jcolabs.com')->nullable();
            // Cached from GitHub
            $table->string('github_id')->unique();
            $table->string('avatar');
            $table->string('mobile_num')->default('070375783');
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('password');
            $table->string('temp_enrollment_no');
            $table->tinyInteger('status')->default(0);
            $table->string('confirmation_code', 100)->index()->nullable();
            $table->enum('verified_status', ['Verified', 'Not Verified', 'Halted'])->default('Not Verified');
            $table->integer('verified_by', false)->unsigned()->default('0')->comment('verified by whom admin');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('candidates');
    }
}
