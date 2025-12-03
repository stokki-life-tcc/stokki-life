<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Produto;

class EstoqueController extends Controller
{
    public function index()
    {
        // Carrega todas as pastas com seus produtos
        $folders = Folder::with('produtos')->get();
        return view('dashboard.estoque.index', compact('folders'));
    }

    public function store(Request $request)
    {
        if ($request->tipo === 'categoria') {
            // Cria uma nova pasta
            Folder::create([
                'nome' => $request->nome,
            ]);
        } elseif ($request->tipo === 'produto') {
            // Verifica se já existe produto com mesmo nome e pasta
            $produto = Produto::where('nome', $request->nome)
                              ->where('folder_id', $request->folder_id)
                              ->first();

            if ($produto) {
                // Soma quantidade
                $produto->quantidade += $request->quantidade;

                // Atualiza data de vencimento se a nova for mais recente
                if ($request->data_vencimento &&
                    (!$produto->data_vencimento || $request->data_vencimento > $produto->data_vencimento)) {
                    $produto->data_vencimento = $request->data_vencimento;
                }

                // Atualiza dias restantes sempre que vier no request
                if ($request->has('dias_restantes')) {
                    $produto->dias_restantes = $request->dias_restantes !== '' 
                        ? (int) $request->dias_restantes 
                        : null;
                }

                $produto->save();
            } else {
                // Cria novo produto
                $produto = Produto::create([
                    'nome'           => $request->nome,
                    'quantidade'     => $request->quantidade,
                    'folder_id'      => $request->folder_id,
                    'data_vencimento'=> $request->data_vencimento,
                    'dias_restantes' => $request->has('dias_restantes') && $request->dias_restantes !== '' 
                        ? (int) $request->dias_restantes 
                        : null,
                ]);
            }

            // 🚨 Se quiser no futuro: aqui pode entrar alerta por e-mail ou WhatsApp
        }

        return redirect()->route('estoque.index')->with('success', 'Cadastro realizado com sucesso!');
    }
}
