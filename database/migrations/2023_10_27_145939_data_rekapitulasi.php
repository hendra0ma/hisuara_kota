<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataRekapitulasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_rekapitulasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('paslon_id');
            $table->bigInteger('tps_id');
            $table->bigInteger('village_id');
            $table->bigInteger('district_id');
            $table->bigInteger('regency_id');
            $table->bigInteger('rekapitulasi_id');
            $table->bigInteger('voice');
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
        //
    }
}
