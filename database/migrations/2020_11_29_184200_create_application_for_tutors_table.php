<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationForTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_for_tutors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            $table->unsignedBigInteger('job_offer_id');
            $table->foreign('job_offer_id')->references('id')->on('job_offers')->onDelete('cascade');
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
        Schema::dropIfExists('application_for_tutors');
    }
}
