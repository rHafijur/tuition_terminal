<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->string('channel')->default('System');
            $table->float('received_amount')->default(0);
            $table->timestamp("due_date")->nullable();
            $table->tinyInteger('is_payment_turned_off')->default(0);
            $table->string('payment_turned_off_reason')->nullable();
            $table->float('turned_off_amount')->nullable();
            $table->float('reference_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            //
        });
    }
}
