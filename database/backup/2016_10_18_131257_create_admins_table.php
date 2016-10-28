<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {

            $table->increments('id');
            $table->string('email')->unique();
            $table->string('mobile_no', 15)->unique();
            $table->string('password', 60);
            $table->string('name', 100);
            $table->boolean('is_super_admin')->default(false);//Only the super admin that can access this page.
            $table->char('usertype', 1)->default('W');
            $table->tinyInteger('verified')->default(0); // this column will be a TINYINT with a default value of 0 , [0 for false & 1 for true i.e. verified]
            $table->string('email_token')->index()->nullable(); // this column will be a VARCHAR with no default value and will also BE NULLABLE
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }
}
