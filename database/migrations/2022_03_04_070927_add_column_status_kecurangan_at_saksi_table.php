<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusKecuranganAtSaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saksi', function (Blueprint $table) {
            $table->enum('status_kecurangan', ['NULL', 'belum terverifikasi','ditolak verifikator', 'terverifikasi', 'ditolak', 'terverifikasi validator','diproses']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saksi', function (Blueprint $table) {
            //
        });
    }
}
