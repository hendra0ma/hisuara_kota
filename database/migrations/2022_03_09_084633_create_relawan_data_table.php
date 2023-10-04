<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelawanDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c1_relawan_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('relawan_id');
            $table->foreignId('paslon_id');
            $table->foreignId('village_id');
            $table->foreignId('regency_id');
            $table->integer('voice');

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
        Schema::dropIfExists('relawan_data');
    }
}
