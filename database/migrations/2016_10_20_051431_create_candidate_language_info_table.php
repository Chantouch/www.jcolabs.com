<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateLanguageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_language_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id', false, true)->unsigned();
            $table->string('name');
            $table->enum('read', ['b', 'c', 'd', 'e', 'f']);
            $table->enum('write', ['b', 'c', 'd', 'e', 'f']);
            $table->enum('listen', ['b', 'c', 'd', 'e', 'f']);
            $table->enum('speak', ['b', 'c', 'd', 'e', 'f']);
//            $table->enum('can_read', ['YES', 'NO'])->default('NO')->comment('language the candidate can read?');
//            $table->enum('can_write', ['YES', 'NO'])->default('NO')->comment('if the language the candidate can write');
//            $table->enum('can_speak', ['YES', 'NO'])->default('NO')->comment('if the language the candidate can Speak?');
//            $table->enum('can_speak_fluently', ['YES', 'NO'])->default('NO')->comment('if the language the candidate can Speak Fluently?');
            $table->enum('level', ['Basic Knowledge', 'Conversational', 'Full working proficiency', 'Native Tongue']);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('candidate_id')->references('id')->on('candidates');
//            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidate_language_info');
    }
}
