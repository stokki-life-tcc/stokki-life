<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // nome do produto
            $table->integer('quantidade')->default(0); // quantidade em estoque
            $table->integer('estoque_minimo')->default(1); // alerta de estoque baixo
            $table->decimal('preco', 10, 2)->default(0); // preço unitário

            // 🔑 campos usados no controller
            $table->date('data_vencimento')->nullable(); // data de vencimento do produto
            $table->integer('dias_restantes')->nullable(); // dias restantes até o vencimento

            $table->string('categoria')->nullable(); // categoria opcional
            $table->string('descricao')->nullable(); // descrição opcional

            // 🔑 relação com folders
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
