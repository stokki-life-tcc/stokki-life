<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    use HasFactory;

    // Nome correto da tabela
    protected $table = 'contas_receber';

    protected $fillable = [
        'cliente_id',
        'venda_id',
        'valor',
        'valor_pago',
        'status',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class, 'venda_id');
    }
}
