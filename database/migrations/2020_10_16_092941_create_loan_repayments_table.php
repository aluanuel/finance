<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRepaymentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('loan_repayments', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_loan');
			$table->double('deposit');
			$table->string('depositer');
			$table->integer('receipt_number');
			$table->unsignedBigInteger('recorded_by');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('loan_repayments');
	}
}
