<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobOfferUniversity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offer_university', function (Blueprint $table) {
            $table->unsignedBigInteger('job_offer_id');
            $table->foreign('job_offer_id')->references('id')->on('job_offers')->onDelete('cascade');
            $table->unsignedBigInteger('institute_id');
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
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
