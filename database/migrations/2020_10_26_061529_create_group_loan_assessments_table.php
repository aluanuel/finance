<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLoanAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_loan_assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_loan');
            $table->string('business_type');
            $table->string('business_owner');
            $table->string('business_location');
            $table->string('loan_user');
            $table->double('present_investment');
            $table->double('present_profit');
            $table->double('monthly_expenditure');
            $table->string('capital_source');
            $table->double('present_inventory');
            $table->double('cash_at_hand');
            $table->text('fixed_assets');
            $table->double('sales_seven_days');
            $table->string('member_location');
            $table->string('known_person_name');
            $table->string('known_person_telephone')->nullable();
            $table->unsignedBigInteger('credit_officer');
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
        Schema::dropIfExists('group_loan_assessments');
    }
}
