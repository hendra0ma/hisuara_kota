<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuickSaksiMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('QuickSaksi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('c1_images');
            $table->string('verification');
            $table->string('audit');
            $table->integer('district_id');
            $table->bigInteger('village_id');
            $table->bigInteger('regency_id');
            $table->bigInteger('tps_id');
            $table->integer('koreksi');
            $table->enum('kecurangan',['yes','no']);
            $table->enum('status_kecurangan',['NULL','Ditolak','Panggil','Selesai','Tidak Menjawab']);
            $table->bigInteger('verifikator_id');
            $table->bigInteger('hukum_id');
            $table->string('overlimit');
            $table->integer('kecurangan_id_users');
            $table->string('pending');
            $table->enum('makamah_konsitusi',['NULL','Ditolak','Panggil','Selesai','Tidak Menjawab']);
            $table->integer('batalkan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('QuickSaksi');
    }
}
