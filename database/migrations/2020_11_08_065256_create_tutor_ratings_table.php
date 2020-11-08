<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            $table->tinyInteger('rating');
            $table->bigInteger('user_id')->nullable();
            $table->enum('source', ['employee', 'guardian','test']);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutor_ratings');
    }
}
