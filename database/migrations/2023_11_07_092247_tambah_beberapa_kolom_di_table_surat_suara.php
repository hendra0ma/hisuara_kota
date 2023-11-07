<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahBeberapaKolomDiTableSuratSuara extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_suara', function (Blueprint $table) {
            $table->string("regency_id");
            $table->string("tps_id");
            $table->string("village_id");
            $table->string("district_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_suara', function (Blueprint $table) {
            //
        });
    }
}
