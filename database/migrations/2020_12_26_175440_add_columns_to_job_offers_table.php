<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_offers', function (Blueprint $table) {
            $table->unsignedBigInteger('tutor_study_type_id')->nullable();
            $table->foreign('tutor_study_type_id')->references('id')->on('study_types')->onDelete('cascade');

            $table->unsignedBigInteger('tutor_religion_id')->nullable();
            $table->foreign('tutor_religion_id')->references('id')->on('religions')->onDelete('cascade');

            $table->unsignedBigInteger('tutor_university_id')->nullable();
            $table->foreign('tutor_university_id')->references('id')->on('institutes')->onDelete('cascade');

            $table->unsignedBigInteger('tutor_school_id')->nullable();
            $table->foreign('tutor_school_id')->references('id')->on('institutes')->onDelete('cascade');

            $table->unsignedBigInteger('tutor_college_id')->nullable();
            $table->foreign('tutor_college_id')->references('id')->on('institutes')->onDelete('cascade');

            $table->unsignedBigInteger('tutor_category_id')->nullable();
            $table->foreign('tutor_category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('taken_by_1_id')->nullable();
            $table->foreign('taken_by_1_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('taken_by_2_id')->nullable();
            $table->foreign('taken_by_2_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('university_type')->nullable();
            $table->string('group')->nullable();
            $table->string('reference_name')->nullable();
            $table->string('reference_contact')->nullable();

            $table->unsignedBigInteger('reference_city_id')->nullable();
            $table->foreign('reference_city_id')->references('id')->on('cities');
            $table->string('email')->nullable();
            $table->string('additional_contact')->nullable();
            $table->string('source')->nullable();
            $table->string('spicial_note')->nullable();
            $table->string('tutor_department')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_offers', function (Blueprint $table) {
            //
        });
    }
}
