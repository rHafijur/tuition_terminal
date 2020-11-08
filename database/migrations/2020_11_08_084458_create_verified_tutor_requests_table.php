<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifiedTutorRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verified_tutor_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->tinyInteger('status')->default(-1);
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
        Schema::dropIfExists('verified_tutor_requests');
    }
}
