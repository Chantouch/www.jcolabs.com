<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactPeopleTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_name')->unique();
            $table->integer('department_id', false, true);
            $table->integer('position_id', false, true);
            $table->integer('employer_id', false, true);
            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('department_id')->references('id')->on('department_types');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('employer_id')->references('id')->on('employers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contact_people');
    }
}
