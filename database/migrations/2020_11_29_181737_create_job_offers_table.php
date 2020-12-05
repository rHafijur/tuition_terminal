<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->integer('days_in_week');
            $table->string('time');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->enum('studet_gender',['male','female']);
            $table->enum('tutor_gender',['male','female']);
            $table->string('name_of_institute');
            $table->integer('number_of_students');
            $table->text('requirements');
            $table->string('hiring_from');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('job_offers');
    }
}
