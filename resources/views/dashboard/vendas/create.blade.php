@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-stokki-green hover:text-stokki-green-dark font-medium">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        Voltar ao Dashboard
    </a>
</div>

<h2 class="text-3xl font-bold text-stokki-green-dark mb-2">Registrar Venda</h2>
<p class="text-stokki-gray-text mb-6">Preencha os dados abaixo para registrar uma nova venda.</p>

@if ($errors->any())
    <div class="bg-stokki-red text-white p-4 rounded mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('vendas.store') }}" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf

    {{-- Nome do Cliente --}}
    <div>
        <label for="nome_cliente" class="block text-sm font-medium text-stokki-gray-text mb-1">Nome do Cliente</label>
        <input type="text" name="nome_cliente" id="nome_cliente" value="{{ old('nome_cliente') }}" required
               class="w-full border border-stokki-gray-border rounded px-4 py-2"
               placeholder="Digite nome e sobrenome">
    </div>

    {{-- Produto --}}
    <div>
        <label for="produto_id" class="block text-sm font-medium text-stokki-gray-text mb-1">Produto</label>
        <select name="produto_id" id="produto_id" required class="w-full border border-stokki-gray-border rounded px-4 py-2">
            <option value="">Selecione o produto</option>
            @foreach ($produtos as $produto)
                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
            @endforeach
        </select>
    </div>

    {{-- Tipo de Venda --}}
    <div>
        <label for="tipo_venda" class="block text-sm font-medium text-stokki-gray-text mb-1">Tipo de Venda</label>
        <select name="tipo_venda" id="tipo_venda" required class="w-full border border-stokki-gray-border rounded px-4 py-2">
            <option value="Produto Fechado">Produto Fechado</option>
            <option value="Por Copo">Por Copo</option>
        </select>
    </div>

    {{-- Quantidade --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="quantidade_fechado" class="block text-sm font-medium text-stokki-gray-text mb-1">Quantidade (Fechado)</label>
            <input type="number" name="quantidade_fechado" id="quantidade_fechado" min="1"
                   class="w-full border border-stokki-gray-border rounded px-4 py-2">
        </div>
        <div>
            <label for="quantidade_copos" class="block text-sm font-medium text-stokki-gray-text mb-1">Copos (Copo)</label>
            <input type="number" name="quantidade_copos" id="quantidade_copos" min="1"
                   class="w-full border border-stokki-gray-border rounded px-4 py-2">
        </div>
    </div>

    {{-- Pagamento --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="status_pagamento" class="block text-sm font-medium text-stokki-gray-text mb-1">Status do Pagamento</label>
            <select name="status_pagamento" id="status_pagamento" required class="w-full border border-stokki-gray-border rounded px-4 py-2">
                <option value="Pago">Pago</option>
                <option value="Pendente">Pendente</option>
                <option value="Parcialmente Pago">Parcialmente Pago</option>
            </select>
        </div>
        <div>
            <label for="valor_pago" class="block text-sm font-medium text-stokki-gray-text mb-1">Valor Pago</label>
            <input type="number" step="0.01" name="valor_pago" id="valor_pago"
                   class="w-full border border-stokki-gray-border rounded px-4 py-2">
        </div>
    </div>

    {{-- Número do Cliente (aparece só se pendente/parcial) --}}
    <div id="numero_cliente_field" class="hidden">
        <label for="numero_cliente" class="block text-sm font-medium text-stokki-gray-text mb-1">Número do Cliente</label>
        <input type="text" name="numero_cliente" id="numero_cliente"
               class="w-full border border-stokki-gray-border rounded px-4 py-2"
               placeholder="Digite o número do cliente">
    </div>

    <div>
        <button type="submit" class="w-full flex justify-center items-center gap-2 bg-stokki-green text-white font-bold py-3 rounded hover:bg-stokki-green-dark transition">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            Registrar Venda
        </button>
    </div>
</form>

<script>
    lucide.createIcons();

    const statusPagamento = document.getElementById('status_pagamento');
    const numeroClienteField = document.getElementById('numero_cliente_field');

    function toggleNumero() {
        const v = statusPagamento.value;
        if (v === 'Pendente' || v === 'Parcialmente Pago') {
            numeroClienteField.classList.remove('hidden');
        } else {
            numeroClienteField.classList.add('hidden');
        }
    }

    statusPagamento.addEventListener('change', toggleNumero);
    toggleNumero(); // chama na carga inicial
</script>
@endsection
