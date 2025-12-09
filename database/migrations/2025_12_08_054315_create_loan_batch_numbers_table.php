<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanBatchNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_batch_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_number');
            $table->unsignedBigInteger('id_loan_group');
            $table->double('total_group_loan');
            $table->double('total_loan_recovered');
            $table->double('total_loan_outstanding');
            $table->date('loan_start_date')->nullable();
            $table->date('loan_end_date')->nullable();
            $table->string('batch_status');
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
        Schema::dropIfExists('loan_batch_numbers');
    }
}
