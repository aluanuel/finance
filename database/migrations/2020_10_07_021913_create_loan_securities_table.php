<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanSecuritiesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('loan_securities', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_client');
			$table->unsignedBigInteger('id_loan');
			$table->unsignedBigInteger('id_guarantor')->nullable();
			$table->string('security_name');
			$table->string('security_number')->nullable();
			$table->double('security_value');
			$table->text('security_attachment')->nullable();
			$table->text('security_agreement')->nullable();
			$table->boolean('security_status')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('loan_securities');
	}
}
