<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_degrees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            $table->unsignedBigInteger('institute_id');
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->unsignedBigInteger('curriculum_id');
            $table->foreign('curriculum_id')->references('id')->on('curricula')->onDelete('cascade');
            $table->unsignedBigInteger('degree_id');
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('cascade');
            $table->float('gpa')->nullable();
            $table->integer('education_board')->nullable();
            $table->integer('group')->nullable();
            $table->integer('passing_year')->nullable();
            $table->boolean('currently_studying')->default(0);
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
        Schema::dropIfExists('tutor_degrees');
    }
}
