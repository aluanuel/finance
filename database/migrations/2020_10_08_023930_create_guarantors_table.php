<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuarantorsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('guarantors', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_loan');
			$table->unsignedBigInteger('id_client');
			$table->string('guarantor_name');
			$table->string('guarantor_address');
			$table->string('guarantor_telephone');
			$table->text('guarantor_photo');
			$table->string('guarantor_relationship')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('guarantors');
	}
}
