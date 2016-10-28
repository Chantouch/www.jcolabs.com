<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateEduDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_edu_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('candidate_id', false, true);
            $table->integer('exam_id', false, true)->comment('This will be the foreign key for exam passed');
            $table->integer('board_id', false, true)->comment('This will be the foreign key for Board/university passed');
            $table->integer('subject_id', false)->unsigned()->default('0')->comment('Subject by whom');
            $table->string('specialization', 50)->nullable();
            $table->integer('pass_year', false)->nullable();
            $table->decimal('percentage', 5, 2)->comment('Pass percentage');
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('board_id')->references('id')->on('boards');
            $table->foreign('subject_id')->references('id')->on('subjects');
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
        Schema::dropIfExists('candidate_edu_details');
    }
}
