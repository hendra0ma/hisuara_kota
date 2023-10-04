<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Koreksiii extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('koreksi', function (Blueprint $table) {
            $table->enum('status',['menunggu','diproses','selesai','ditolak'])->default('menunggu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('koreksi', function (Blueprint $table) {
            //
        });
    }
}
