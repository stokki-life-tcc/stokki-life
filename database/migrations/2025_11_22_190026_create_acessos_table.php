<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('acessos', function (Blueprint $table) {
    $table->id();
    $table->string('tipo'); // entrada ou saída
    $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
    $table->integer('quantidade');
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acessos');
    }
};
