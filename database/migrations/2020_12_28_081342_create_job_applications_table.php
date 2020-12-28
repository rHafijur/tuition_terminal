<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('job_offer_id');
            $table->foreign('job_offer_id')->references('id')->on('job_offers')->onDelete('cascade');
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            $table->unsignedBigInteger('taken_by_id')->nullable();
            $table->foreign('taken_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp("taken_at")->nullable();
            $table->timestamp("waiting_stage")->nullable();
            $table->timestamp("waiting_date")->nullable();
            $table->timestamp("meeting_stage")->nullable();
            $table->timestamp("meeting_date")->nullable();
            $table->timestamp("trial_stage")->nullable();
            $table->timestamp("trial_date")->nullable();
            $table->timestamp("confirm_stage")->nullable();
            $table->timestamp("confirm_date")->nullable();
            $table->timestamp("payment_date")->nullable();
            $table->timestamp("cancel_stage")->nullable();
            $table->string('cancel_note')->nullable();
            $table->timestamp("repost_date")->nullable();
            $table->string('repost_note')->nullable();
            $table->string('note')->nullable();
            $table->float('tuition_salary')->nullable();
            $table->float('commission')->nullable();
            $table->float('receivable_amount')->nullable();
            $table->float('net_receivable_amount')->nullable();
            $table->tinyInteger('is_reposted')->default(0);
            $table->tinyInteger('is_canceled')->default(0);
            $table->tinyInteger('is_taken')->default(0);
            $table->tinyInteger('is_seen')->default(0);
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
        Schema::dropIfExists('job_applications');
    }
}
