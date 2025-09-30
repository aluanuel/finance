<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->string('group_description');
            $table->string('group_address');
            $table->integer('group_code');
            $table->string('group_schedule_day')->nullable();
            $table->unsignedBigInteger('id_lead_credit_officer');
            $table->boolean('group_status')->default(0);
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
        Schema::dropIfExists('loan_groups');
    }
}
