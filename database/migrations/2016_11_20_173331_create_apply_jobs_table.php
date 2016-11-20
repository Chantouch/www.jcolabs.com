<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id', false, true)->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 15);
            $table->string('subject');
            $table->longText('message');
            $table->string('cv');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('job_id')->references('id')->on('posted_job')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('apply_jobs');
    }
}
