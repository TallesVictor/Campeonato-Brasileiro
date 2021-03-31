<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRodadasTimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rodadas_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('time_1');
            $table->foreign('time_1')->references('id')->on('times');
            $table->unsignedBigInteger('time_2');
            $table->foreign('time_2')->references('id')->on('times');
            $table->integer('gols');
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
        Schema::dropIfExists('rodadas_times');
    }
}
