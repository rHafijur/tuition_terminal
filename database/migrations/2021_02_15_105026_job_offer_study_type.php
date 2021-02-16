<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobOfferStudyType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offer_study_type', function (Blueprint $table) {
            $table->unsignedBigInteger('job_offer_id');
            $table->foreign('job_offer_id')->references('id')->on('job_offers')->onDelete('cascade');
            $table->unsignedBigInteger('study_type_id');
            $table->foreign('study_type_id')->references('id')->on('study_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
