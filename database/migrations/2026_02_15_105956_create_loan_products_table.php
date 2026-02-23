<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_products', function (Blueprint $table) {
            $table->id();
            $table->string('loan_category');
            $table->string('product_name');
            $table->string('product_description')->nullable();
            $table->double('interest_rate');
            $table->double('loan_processing_rate');
            $table->double('interest_on_defaulting');
            $table->timestamps();
        });

        DB::table('loan_products')->insert(['loan_category'=>'Default','product_name'=>'Default','product_description'=>'Default loan product','interest_rate'=>'2.8','loan_processing_rate'=>'10','interest_on_defaulting'=>'2']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_products');
    }
}
