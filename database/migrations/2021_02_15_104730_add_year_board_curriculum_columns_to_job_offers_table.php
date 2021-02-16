<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYearBoardCurriculumColumnsToJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_offers', function (Blueprint $table) {
            $table->string('year_or_semester')->nullable();
            $table->unsignedBigInteger('curriculum_id')->nullable();
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
