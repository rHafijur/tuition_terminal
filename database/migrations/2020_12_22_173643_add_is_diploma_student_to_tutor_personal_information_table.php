<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDiplomaStudentToTutorPersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutor_personal_information', function (Blueprint $table) {
            $table->tinyInteger("is_diploma_student")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutor_personal_information', function (Blueprint $table) {
            //
        });
    }
}
