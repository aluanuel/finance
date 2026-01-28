<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaction');
            $table->unsignedBigInteger('id_loan');
            $table->unsignedBigInteger('id_client');
            $table->double('loan_approved');
            $table->double('total_loan');
            $table->date('date_loan_disbursed');
            $table->date('date_loan_fully_recovered')->nullable();
            $table->string('loan_status');
            $table->double('loan_recovered');
            $table->double('loan_outstanding');       
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
        Schema::dropIfExists('ledgers');
    }
}
