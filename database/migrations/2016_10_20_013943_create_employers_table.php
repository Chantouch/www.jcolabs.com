<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organization_name')->comment('Organization Name')->unique();
            $table->enum('organization_type', ['Placement Agency', 'Employer', 'Govt Training Providing Organisation']);
            $table->enum('organization_sector', ['Private', 'Central Govt', 'State Govt', 'Central PSU', 'State PSU', 'Local Bodies', 'Statutory Bodies', 'Others'])->comment('Organisation Sector *');
            $table->integer('industry_id', false, true)->comment('Foreign key for industry types')->nullable();
            $table->string('photo', 200)->nullable()->default('default.jpg')->comment('Photo URL');
            $table->string('path', 255)->comment('For storing path of image.');
            $table->string('tag_line', 100)->nullable()->comment('Company Tag line');
            $table->string('details', 500)->nullable()->comment('Company Details');
            $table->string('address')->nullable();
            $table->integer('employees')->nullable()->comment('The employee number');
            $table->string('products')->nullable()->comment('Show the product for company');
            $table->string('services')->nullable()->comment('Show the services for company');
            $table->string('longitude')->nullable()->comment('Show the Longitude for company');
            $table->string('latitude')->nullable()->comment('Show the Latitude for company');
            $table->integer('city_id', false, true)->nullable();
            $table->integer('district_id', false, true)->nullable();
            $table->integer('pin_code', false)->nullable();
            $table->string('phone_no_ext', 5)->nullable();
            $table->string('phone_no_main', 10)->nullable();
            $table->string('organisation_email', 100)->unique()->nullable();
            $table->string('web_address')->nullable();
            $table->string('organisation_id_proof')->nullable();
            $table->string('organisation_profile')->nullable();
            $table->string('organisation_pan_card')->nullable();
            $table->string('contact_people_id')->nullable();
            //Contact person details or login
            $table->string('contact_name', 50)->comment('Contact Person Name')->unique();//Required field
            $table->string('contact_designation', 50)->comment('Contact Person Designation')->nullable();
            $table->string('contact_mobile_no', 10)->unique();
            $table->string('contact_email')->unique();
            $table->string('password', 60);//Required field
            $table->tinyInteger('status')->default(0);
            $table->string('confirmation_code', 255)->nullable();
            $table->string('temp_enrollment_no')->nullable();
            $table->string('enrollment_no')->nullable();
            $table->integer('verified_by', false)->unsigned()->default('0')->comment('verified by whom admin');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('industry_id')->references('id')->on('industry_types');
            $table->foreign('city_id')->references('id')->on('states');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('contact_people_id')->references('id')->on('contact_people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
}
