<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c1_relawan', function (Blueprint $table) {
            $table->id();
            $table->string('c1_images');
            $table->foreignId('district_id');
            $table->foreignId('village_id');
            $table->foreignId('relawan_id');
            $table->foreignId('regency_id');
            $table->foreignId('tps_id');
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
        Schema::dropIfExists('relawan');
    }
}
