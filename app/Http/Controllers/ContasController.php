<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ContaReceber;

class ContasController extends Controller
{
    public function index()
    {
        // Carrega clientes com suas contas a receber (via vendas)
        $clientes = Cliente::with(['vendas.conta', 'vendas.produto'])->get();
        return view('dashboard.contas.index', compact('clientes'));
    }

    public function update(Request $request, $id)
    {
        // Atualiza a conta a receber vinculada à venda
        $conta = ContaReceber::where('venda_id', $id)->firstOrFail();
        $conta->status = 'Pago';
        $conta->valor_pago = $conta->valor; // marca como pago total
        $conta->save();

        return redirect()->route('contas.index')->with('success', 'Conta marcada como paga!');
    }
}
