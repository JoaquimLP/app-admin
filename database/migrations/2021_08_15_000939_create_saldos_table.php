<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movimento_id');
            $table->string('movimento_type');
            $table->double('valor', 10,2)->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status_id', ['A', 'I'])->default("A");
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas');
            //$table->foreign('estoque_id')->references('id')->on('estoques');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saldos');
    }
}
