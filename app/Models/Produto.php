<?php
// app/Models/Produto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'codigo',
        'preco_venda',
        'quantidade',
        'categoria_id',
        'folder_id',
        'data_vencimento',
        'data_consumo',
        'dias_restantes', // <-- adiciona aqui
    ];

    public function itensVenda()
    {
        return $this->hasMany(ItemVenda::class, 'produto_id');
    }

    public function acessos()
    {
        return $this->hasMany(Acesso::class, 'produto_id');
    }
}
