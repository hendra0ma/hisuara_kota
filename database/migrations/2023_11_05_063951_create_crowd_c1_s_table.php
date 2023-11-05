<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrowdC1STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crowd_c1', function (Blueprint $table) {
            $table->id();
            $table->text('crowd_c1');
            $table->enum('status',[0,1])->default(0); // 0 = belum terverifikasi, 1 = terverifikasi
            $table->bigInteger('user_id');
            $table->bigInteger('petugas_id')->nullable();
            
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
        Schema::dropIfExists('crowd_c1');
    }
}
