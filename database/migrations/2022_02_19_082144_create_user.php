<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saksi', function (Blueprint $table) {
            $table->integer('district_id');
            $table->bigInteger('village_id');
            $table->bigInteger('regency_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saksi', function (Blueprint $table) {
            //
        });
    }
}
