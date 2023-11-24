<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatKoreksiDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_koreksi_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('voice'); 
            $table->bigInteger('paslon_id');
            $table->bigInteger('riwayat_koreksi_Id');
            $table->string("province_id");
            $table->string("petugas_id")->nullable();
            $table->string("regency_id");
            $table->string("tps_id");
            $table->string("village_id");
            $table->string("district_id");
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
        Schema::dropIfExists('riwayat_koreksi_data');
    }
}
