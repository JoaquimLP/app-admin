<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->char('tipo', 10);
            $table->string('nome');
            $table->string('razao_social')->nullable();
            $table->char('documento', 14);
            $table->char('ie_rg', 25);
            $table->string('nome_contato')->nullable();
            $table->char('celular', 12)->nullable();
            $table->char('telefone', 12)->nullable();
            $table->string('email')->unique();
            $table->string('endereco', 255)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('estado', 50)->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento', 50)->nullable();
            $table->text('observacao')->nullable();
            $table->enum('status_id', ['A', 'I'])->default("A");
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
        Schema::dropIfExists('empresas');
    }
}
