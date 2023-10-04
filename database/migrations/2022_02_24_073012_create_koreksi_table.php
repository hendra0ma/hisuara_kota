<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoreksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koreksi', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('paslon_id');
            $table->integer('district_id');
            $table->bigInteger('village_id');
            $table->bigInteger('regency_id');
            $table->integer('voice');
            $table->foreignId('saksi_id');
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
        Schema::dropIfExists('koreksi');
    }
}
