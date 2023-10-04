<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumbSolutionFraudIdAtTableListKecurangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_kecurangan', function (Blueprint $table) {
            $table->foreignId('solution_fraud_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_kecurangan', function (Blueprint $table) {
            //
        });
    }
}
