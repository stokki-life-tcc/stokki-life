<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'produto_id',
        'tipo_venda',
        'quantidade_fechado',
        'quantidade_copos',
        'status_pagamento',
        'valor_pago',
        'valor_total',
        'data_venda',
    ];

    protected $casts = [
        'data_venda'   => 'datetime',
        'valor_pago'   => 'decimal:2',
        'valor_total'  => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function conta()
    {
        return $this->hasOne(ContaReceber::class, 'venda_id');
    }
}
