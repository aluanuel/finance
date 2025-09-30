<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLoanSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_loan_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_loan_group');
            $table->text('loan_cohort_number');
            $table->double('total_loan_disbursed');
            $table->double('total_loan_recovered');
            $table->double('total_loan_outstanding');
            $table->date('date_loan_disbursed');
            $table->date('date_loan_fully_recovered');
            $table->unsignedBigInteger('id_credit_officer');
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
        Schema::dropIfExists('group_loan_schedules');
    }
}
