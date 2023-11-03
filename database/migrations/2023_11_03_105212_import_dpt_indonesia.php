<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportDptIndonesia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpt_indonesia', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('province_name',150);
            $table->string('regency_name',150);
            $table->string('district_name',150);
            $table->string('village_name',150);
            $table->string('tps',150);
            $table->string('nama_pemilih',150);
            $table->string('usia',150);
            $table->string('rw',150);
            $table->string('rt',150);
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
