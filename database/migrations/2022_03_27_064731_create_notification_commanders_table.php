<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationCommandersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_commanders', function (Blueprint $table) {
            $table->id();
            $table->string('link_redirect')->nullable();
            $table->string('setting')->nullable();
            $table->string('order');
            $table->enum('jenis',['redirect','setting']);
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
        Schema::dropIfExists('notification_commanders');
    }
}
