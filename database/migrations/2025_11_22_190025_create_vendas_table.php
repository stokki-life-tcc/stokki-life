<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('produto_id');
            $table->string('tipo_venda'); // copo ou fechado
            $table->integer('quantidade_fechado')->default(0);
            $table->integer('quantidade_copos')->default(0);
            $table->string('status_pagamento')->default('Pendente');
            $table->decimal('valor_pago', 10, 2)->default(0);
            $table->decimal('valor_total', 10, 2)->default(0); // corrigido com default
            $table->date('data_venda');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
