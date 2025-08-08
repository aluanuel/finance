<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->date('dob');
            $table->string('resident_district')->nullable();
            $table->string('resident_division')->nullable();
            $table->string('resident_parish')->nullable();
            $table->string('resident_village')->nullable();
            $table->string('telephone');
            $table->string('alt_telephone')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('district_of_work')->nullable();
            $table->string('nationality')->default('Ugandan');
            $table->string('id_type')->default('National ID');
            $table->string('id_number');
            $table->string('permanent_address');
            $table->string('country')->nullable();
            $table->string('photo_id');
            $table->string('photo_client')->nullable();
            $table->unsignedBigInteger('id_loan_group');
            $table->string('role_group')->default('Member');
            $table->float('registration_fee');
            $table->string('account_number');
            $table->boolean('account_status')->default(1);
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
        Schema::dropIfExists('clients');
    }
}
