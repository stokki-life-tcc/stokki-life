<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Lista todos os clientes
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('dashboard.clientes.index', compact('clientes'));
    }

    /**
     * Mostra formulário de criação
     */
    public function create()
    {
        return view('dashboard.clientes.create');
    }

    /**
     * Salva novo cliente
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'numero_cliente' => 'nullable|string|max:30',
        ]);

        // Verifica duplicidade de nome
        $existe = Cliente::where('nome', $request->nome)->first();

        if ($existe) {
            return redirect()->back()->withErrors([
                'nome' => 'Já existe um cliente com esse nome. Adicione sobrenome ou detalhe para diferenciar.'
            ])->withInput();
        }

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Edita cliente
     */
    public function edit(Cliente $cliente)
    {
        return view('dashboard.clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza cliente
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'numero_cliente' => 'nullable|string|max:30',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove cliente
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }
}
