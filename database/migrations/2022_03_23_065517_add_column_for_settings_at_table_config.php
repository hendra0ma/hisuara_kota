<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnForSettingsAtTableConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->enum('lockdown',['no','yes']);
            // $table->enum('publish_count',['no','yes']);
            $table->enum('otonom',['no','yes']);
            $table->enum('multi_admin',['no','yes']);
            $table->enum('darkmode',['no','yes']);
            $table->integer('jumlah_multi_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config', function (Blueprint $table) {
            //
        });
    }
}
