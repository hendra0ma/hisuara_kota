<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumnVerifikatorIdAndHukumIdAtSaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saksi', function (Blueprint $table) {
      
            $table->foreignId('verifikator_id')->nullable();
            $table->foreignId('hukum_id')->nullable();
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
