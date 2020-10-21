<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberAssetsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('member_assets', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_client');
			$table->unsignedBigInteger('id_group');
			$table->string('name_asset');
			$table->string('size_asset');
			$table->integer('value_asset');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('member_assets');
	}
}
