<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterClientsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('register_clients', function (Blueprint $table) {
			$table->id();
			$table->string('account',10);
			$table->string('name');
			$table->string('telephone');
			$table->string('gender');
			$table->string('marital_status');
			$table->string('work_place');
			$table->string('occupation')->nullable();
			$table->string('district')->nullable();
			$table->text('photo')->default('1611593817.png');
			$table->string('resident_village')->nullable();
			$table->string('resident_parish')->nullable();
			$table->string('resident_division')->nullable();
			$table->string('resident_district')->nullable();
			$table->string('next_of_kin')->nullable();
			$table->unsignedBigInteger('id_group')->nullable();
			$table->string('role')->nullable();
			$table->boolean('member_status')->nullable();
			$table->date('member_joined_on')->nullable();
			$table->unsignedBigInteger('group_administrator')->nullable();
			$table->date('dob')->nullable();
			$table->string('house_head')->nullable();
			$table->boolean('ever_borrowed_loan')->nullable();
			$table->integer('loan_amount_borrowed')->nullable();
			$table->text('loan_amount_borrowed_words')->nullable();
			$table->string('loan_lending_institution')->nullable();
			$table->unsignedBigInteger('registered_by');
			$table->datetime('registration_date');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('register_clients');
	}
}
