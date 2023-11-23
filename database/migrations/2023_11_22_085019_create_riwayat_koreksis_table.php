<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatKoreksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_koreksi', function (Blueprint $table) {
            $table->id();
            $table->text('c1_images');
            $table->bigInteger('user_id');
            $table->enum('from',['verifikator','auditor']);
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
        Schema::dropIfExists('riwayat_koreksi');
    }
}
