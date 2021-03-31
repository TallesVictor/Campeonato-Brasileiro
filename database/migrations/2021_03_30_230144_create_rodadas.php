<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRodadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rodadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('time_casa');
            $table->foreign('time_casa')->references('id')->on('times');
            $table->unsignedBigInteger('time_fora');
            $table->integer('gols_time_casa');
            $table->foreign('time_fora')->references('id')->on('times');
            $table->integer('gols_time_fora');
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
        Schema::dropIfExists('rodadas');
    }
}
