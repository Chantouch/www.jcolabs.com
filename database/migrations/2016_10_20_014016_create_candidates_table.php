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
            $table->string('email')->unique();
            $table->string('mobile_num');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('password');
            $table->tinyInteger('status');
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
