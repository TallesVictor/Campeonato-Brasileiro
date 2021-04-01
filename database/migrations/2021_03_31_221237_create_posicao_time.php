<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosicaoTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posicao_time', function (Blueprint $table) {
            $table->id();
            $table->integer("posicao");
            $table->unsignedBigInteger('time_id');
            $table->foreign('time_id')->references('id')->on('times');
            $table->integer("jogos");
            $table->integer("vitorias");
            $table->integer("empate");
            $table->integer("derrota");
            $table->integer("gols_pro");
            $table->integer("gols_contra");
            $table->integer("status")->default('0');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posicao_time');
    }
}
