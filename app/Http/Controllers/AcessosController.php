<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Venda;

class AcessosController extends Controller
{
    public function index()
    {
        // Entradas: produtos adicionados ao estoque
        $entradas = Produto::select('nome as produto', 'quantidade', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        // Saídas: vendas registradas
        $vendas = Venda::select('produto_id', 'quantidade_fechado', 'quantidade_copos', 'created_at')
            ->with('produto:id,nome')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($venda) {
                return (object) [
                    'produto'    => $venda->produto->nome ?? 'Produto removido',
                    'quantidade' => $venda->tipo_venda === 'Produto Fechado'
                        ? $venda->quantidade_fechado
                        : $venda->quantidade_copos,
                    'created_at' => $venda->created_at,
                ];
            });

        return view('dashboard.acessos.index', compact('entradas', 'vendas'));
    }
}
