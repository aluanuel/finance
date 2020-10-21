<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToMemberAssetsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('member_assets', function (Blueprint $table) {
			$table->foreign('id_client')
				->references('id')
				->on('register_clients')
				->onDelete('cascade');
			$table->foreign('id_group')
				->references('id')
				->on('client_groups')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('member_assets', function (Blueprint $table) {
			//
		});
	}
}
