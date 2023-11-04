<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableDptIndonesia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dpt_indonesia', function (Blueprint $table) {
            $table->bigInteger('regency_id');
            $table->bigInteger('province_id');
            $table->bigInteger('district_id');
            $table->bigInteger('village_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dpt_indonesia', function (Blueprint $table) {
            //
        });
    }
}
