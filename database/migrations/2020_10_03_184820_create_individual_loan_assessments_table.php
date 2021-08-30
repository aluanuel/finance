<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualLoanAssessmentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('individual_loan_assessments', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_client');
			$table->unsignedBigInteger('id_loan');
			$table->string('applicant_type');
			$table->string('business_type')->nullable();
			$table->text('business_license')->nullable();
			$table->text('business_account_statement')->nullable();
			$table->text('appointment_letter')->nullable();
			$table->text('supervisor_recommendation')->nullable();
			$table->text('bank_statement')->nullable();
			$table->text('leader_recommendation');
			$table->double('monthly_income');
			$table->text('income_sources')->nullable();
			$table->double('monthly_income_others');
			$table->double('total_monthly_income');
			$table->double('food');
			$table->double('rent')->nullable();
			$table->double('medical')->nullable();
			$table->double('electricity')->nullable();
			$table->double('school_fees')->nullable();
			$table->double('leisure')->nullable();
			$table->double('others')->nullable();
			$table->double('total_monthly_expense');
			$table->boolean('borrowed_money');
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->double('loan_period_borrowed')->nullable();
			$table->string('money_lender')->nullable();
			$table->double('amount_borrowed')->nullable();
			$table->double('loan_period')->nullable();
			$table->double('monthly_instalment')->nullable();
			$table->boolean('other_personal_loan');
			$table->string('money_lender_personal')->nullable();
			$table->double('amount_outstanding')->nullable();
			$table->boolean('running_project');
			$table->string('project_name')->nullable();
			$table->double('project_budget')->nullable();
			$table->double('monthly_project_expense')->nullable();
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
		Schema::dropIfExists('individual_loan_assessments');
	}
}
