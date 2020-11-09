<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanWitnessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_witnesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_loan');
            $table->unsignedBigInteger('id_client');
            $table->string('witness_name');
            $table->string('witness_relationship');
            $table->date('witness_on');
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
        Schema::dropIfExists('loan_witnesses');
    }
}
