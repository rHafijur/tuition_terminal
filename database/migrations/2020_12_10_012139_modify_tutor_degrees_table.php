<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTutorDegreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutor_degrees', function (Blueprint $table) {
            $table->unsignedBigInteger('study_type_id')->nullable();
            $table->foreign('study_type_id')->references('id')->on('study_types')->onDelete('cascade');
            $table->string('department')->nullable();
            $table->string('university_type')->nullable();
            $table->string('year_or_semester')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutor_degrees', function (Blueprint $table) {
            //
        });
    }
}
