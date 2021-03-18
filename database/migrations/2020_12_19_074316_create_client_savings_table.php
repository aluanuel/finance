<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_savings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->double('savings_balance');
            $table->double('amount_figures');
            $table->text('amount_words');
            $table->string('person_name')->nullable();
            $table->string('person_telephone')->nullable();
            $table->string('transaction_type');
            $table->unsignedBigInteger('id_user');
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
        Schema::dropIfExists('client_savings');
    }
}
