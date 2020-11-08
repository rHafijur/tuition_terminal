<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorPersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_personal_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->enum('gender',['male','female'])->nullable();
            $table->string('additional_phone')->nullable();
            $table->text('full_address')->nullable();
            $table->string('id_number')->nullable();
            $table->string('nationality')->nullable();
            $table->string('facebook_profile')->nullable();
            $table->string('blood_group')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('fathers_phone')->nullable();
            $table->string('mothers_phone')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('short_description')->nullable();
            $table->text('reasones_to_get_hired')->nullable();
            $table->longText('overview')->nullable();
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
        Schema::dropIfExists('tutor_personal_information');
    }
}
