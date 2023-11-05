<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahBeberapaKolom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crowd_c1', function (Blueprint $table) {
            $table->string('district_id')->nullable();
            $table->string('village_id')->nullable();
            $table->string('tps_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crowd_c1', function (Blueprint $table) {
            //
        });
    }
}
