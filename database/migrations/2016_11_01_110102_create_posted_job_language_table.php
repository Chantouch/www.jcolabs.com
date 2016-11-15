<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostedJobLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_posted_job', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('posted_job_id')->unsigned();
            $table->foreign('posted_job_id')->references('id')->on('posted_job')
                ->onUpdate('cascade')->onDelete('cascade');

            //$table->primary(['posted_job_id', 'language_id']);

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
        Schema::dropIfExists('language_posted_job');
    }
}
