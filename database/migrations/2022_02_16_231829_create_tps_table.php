<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('district_id')->nullable();
            $table->string('villages_id')->nullable();
            $table->string('number')->nullable();
            $table->string('sample')->nullable();
            $table->string('user_id')->nullable();
            $table->enum('setup', ['terisi', 'belum terisi']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tps');
    }
}
