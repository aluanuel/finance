<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('loan_number');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_group_loan_cohort')->nullable();
            $table->double('loan_request_amount');
            $table->integer('loan_period');
            $table->double('interest_rate');
            $table->double('loan_processing_rate');
            $table->double('loan_approved')->nullable();
            $table->double('total_loan')->nullable();
            $table->double('loan_instalment')->nullable();
            $table->date('date_loan_application');
            $table->date('date_loan_approved')->nullable();
            $table->date('date_loan_disbursed')->nullable();
            $table->date('date_loan_fully_recovered')->nullable();
            $table->string('borrowing_purpose');
            $table->string('main_income_source')->nullable();
            $table->string('other_income_sources')->nullable();
            $table->double('total_monthly_income')->nullable();
            $table->double('total_monthly_expenditure')->nullable();
            $table->string('collateral_security');
            $table->string('loan_status')->default('Pending Assessment');
            $table->double('loan_recovered')->default(0);
            $table->double('loan_outstanding')->default(0);
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
        Schema::dropIfExists('loans');
    }
}
