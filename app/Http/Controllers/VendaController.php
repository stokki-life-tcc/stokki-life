<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\ContaReceber;

class VendaController extends Controller
{
    public function index()
    {
        // Carrega vendas com cliente, produto e conta vinculada
        $vendas = Venda::with(['cliente', 'produto', 'conta'])->get();
        return view('dashboard.vendas.index', compact('vendas'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('dashboard.vendas.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_cliente'        => 'required|string|max:255',
            'produto_id'          => 'required|exists:produtos,id',
            'tipo_venda'          => 'required|string',
            'quantidade_fechado'  => 'nullable|integer|min:1',
            'quantidade_copos'    => 'nullable|integer|min:1',
            'status_pagamento'    => 'required|string',
            'valor_pago'          => 'nullable|numeric|min:0',
            'numero_cliente'      => 'nullable|string|max:255',
        ]);

        // Verifica se cliente já existe
        $cliente = Cliente::where('nome', $request->nome_cliente)->first();

        if (!$cliente) {
            $cliente = Cliente::create([
                'nome' => $request->nome_cliente,
                'numero_cliente' => $request->numero_cliente ?? uniqid('cli_'),
            ]);
        } else {
            // Atualiza número do cliente se pendente/parcial
            if (in_array($request->status_pagamento, ['Pendente', 'Parcialmente Pago']) && $request->filled('numero_cliente')) {
                $cliente->update(['numero_cliente' => $request->numero_cliente]);
            }
        }

        // Busca produto para calcular valor_total
        $produto = Produto::findOrFail($request->produto_id);

        $valor_total = 0;
        if ($request->tipo_venda === 'Por Copo') {
            $valor_total = ($request->quantidade_copos ?? 0) * $produto->preco_venda;
        } elseif ($request->tipo_venda === 'Produto Fechado') {
            $valor_total = ($request->quantidade_fechado ?? 0) * $produto->preco_venda;
        }

        // Cria a venda
        $venda = Venda::create([
            'cliente_id'        => $cliente->id,
            'produto_id'        => $request->produto_id,
            'tipo_venda'        => $request->tipo_venda,
            'quantidade_fechado'=> $request->quantidade_fechado ?? 0,
            'quantidade_copos'  => $request->quantidade_copos ?? 0,
            'status_pagamento'  => $request->status_pagamento,
            'valor_pago'        => $request->valor_pago ?? 0,
            'valor_total'       => $valor_total,
            'data_venda'        => now(),
        ]);

        // Cria conta a receber vinculada à venda
        ContaReceber::create([
            'cliente_id' => $cliente->id,
            'venda_id'   => $venda->id,
            'valor'      => $valor_total,
            'valor_pago' => $request->valor_pago ?? 0,
            'status'     => $request->status_pagamento,
        ]);

        // Redireciona para Contas a Receber
        return redirect()->route('contas.index')->with('success', 'Venda registrada e conta criada com sucesso!');
    }
}
