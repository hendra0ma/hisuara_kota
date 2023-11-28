<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegencyCrowdC1STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regency_crowd_c1', function (Blueprint $table) {
            $table->id();
            $table->char('province_id',3);
            $table->string('name',90);
            $table->bigInteger('suaraKpu1')->default(0);
            $table->bigInteger('suaraKpu2')->default(0);
            $table->bigInteger('suaraKpu3')->default(0);
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
        Schema::dropIfExists('regency_crowd_c1');
    }
}
