<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SaksiC1C extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saksi_c1_c8', function (Blueprint $table) {
            $table->id();
            $table->text('c_images');
            $table->bigInteger('district_id');
            $table->bigInteger('village_id');
            $table->bigInteger('regency_id');
            $table->enum('tipe',['c2','c3','c4','c5','c6','c7','c8']);
            $table->bigInteger('tps_id');
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
