<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditOfficerLoanGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_officer_loan_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_credit_officer');
            $table->unsignedBigInteger('id_loan_group');
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
        Schema::dropIfExists('credit_officer_loan_groups');
    }
}
