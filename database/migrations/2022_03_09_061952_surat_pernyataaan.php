<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SuratPernyataaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pernyataan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('qrcode_hukum_id');
            $table->text('deskripsi');
            $table->integer('saksi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_pernyataan');
    }
}
