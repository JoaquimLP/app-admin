<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['E', 'S']);
            $table->double('qtd', 10,2)->nullable();
            $table->double('valor', 10,2)->nullable();
            $table->enum('status_id', ['A', 'I'])->default("A");
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('produto_id')->references('id')->on('produtos');
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
        Schema::dropIfExists('estoques');
    }
}
