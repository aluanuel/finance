<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanApplicationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('loan_applications', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_client');
			$table->integer('loan_number');
			$table->double('application_fee');
			$table->datetime('application_date');
			$table->boolean('application_status')->default(0);
			$table->unsignedBigInteger('application_by');
			$table->unsignedBigInteger('payment_received_by')->nullable();
			$table->double('proposed_amount')->nullable();
			$table->double('interest_rate');
			$table->string('borrowing_purpose')->nullable();
			$table->text('income_sources')->nullable();
			$table->double('recommended_amount')->nullable();
			$table->double('total_loan')->nullable();
			$table->unsignedBigInteger('recommended_by')->nullable();
			$table->double('loan_amount_issued')->nullable();
			$table->double('loan_interest')->nullable();
			$table->double('security')->nullable();
			$table->integer('loan_period')->nullable();
			$table->double('loan_recovered')->nullable();
			$table->double('loan_balance')->nullable();
			$table->datetime('start_date')->nullable();
			$table->datetime('end_date')->nullable();
			$table->boolean('assessment_status')->nullable();
			$table->boolean('approval_status')->nullable();
			$table->string('loan_status')->nullable();
			$table->unsignedBigInteger('issued_by')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('loan_applications');
	}
}
