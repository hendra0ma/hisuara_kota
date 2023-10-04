<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnC1RelawanIdAtTableC1RelawanData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c1_relawan_data', function (Blueprint $table) {
            $table->foreignId('c1_relawan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c1_relawan_data', function (Blueprint $table) {
            //
        });
    }
}
