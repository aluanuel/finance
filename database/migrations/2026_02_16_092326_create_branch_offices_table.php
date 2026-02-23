<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use DB;

class CreateBranchOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_offices', function (Blueprint $table) {
            $table->id();
            $table->string('branch_name');
            $table->string('location');
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('branch_status')->default(1);
            $table->timestamps();
        });

        DB::table('branch_offices')->insert(['branch_name' => 'Main','location' => 'Head office']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_offices');
    }
}
