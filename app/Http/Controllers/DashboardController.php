<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /* visão geral do dashboard como as vendas do dia, 
    produtos que estão em baixo estoque para vender e 
    a venda mensal dos produtos vendidos */
    public function index()
    {
        $vendasHoje = Venda::whereDate('data_venda', Carbon::today())->count();
        $produtosBaixoEstoque = Produto::where('quantidade', '<', 5)->count();
        $vendasMensal = Venda::whereMonth('data_venda', Carbon::now()->month)->sum('valor_total');

        return view('dashboard.index', [
            'user' => Auth::user(),
            'vendasHoje' => $vendasHoje,
            'produtosBaixoEstoque' => $produtosBaixoEstoque,
            'vendasMensal' => $vendasMensal,
        ]);
    }
}
