<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherPaymentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('other_payments', function (Blueprint $table) {
			$table->id();
			$table->string('payment_name');
			$table->double('payment_amount');
			$table->string('payment_category');
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
		Schema::dropIfExists('other_payments');
	}
}
