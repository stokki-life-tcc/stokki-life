<?php
// app/Models/Cliente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'numero_cliente',
        // adicione outros campos que existirem na sua tabela clientes
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function contas()
    {
        return $this->hasMany(ContaReceber::class, 'cliente_id');
    }
}
