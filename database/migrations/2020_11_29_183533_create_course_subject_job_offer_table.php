<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSubjectJobOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_subject_job_offer', function (Blueprint $table) {
            $table->unsignedBigInteger('job_offer_id');
            $table->foreign('job_offer_id')->references('id')->on('job_offers')->onDelete('cascade');
            $table->unsignedBigInteger('course_subject_id');
            $table->foreign('course_subject_id')->references('id')->on('course_subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_subject_job_offer');
    }
}
