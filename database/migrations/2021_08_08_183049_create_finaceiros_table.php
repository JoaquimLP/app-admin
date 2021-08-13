<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinaceirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finaceiros', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->nullable();
            //$table->double('qtd', 10,2)->nullable();
            //$table->double('valor_compra', 10,2)->nullable();
            $table->double('preco', 10,2)->nullable();
            $table->date('data_pagamento')->nullable();
            $table->enum('tipo', ['E', 'S']);
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas');
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
        Schema::dropIfExists('finaceiros');
    }
}
