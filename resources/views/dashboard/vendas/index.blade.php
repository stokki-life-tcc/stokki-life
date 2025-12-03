@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-stokki-green hover:text-stokki-green-dark font-medium">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        Voltar ao Dashboard
    </a>
</div>

<h2 class="text-3xl font-bold text-stokki-green-dark mb-2">Vendas Registradas</h2>
<p class="text-stokki-gray-text mb-6">Aqui estão todas as vendas registradas no sistema.</p>

@if (session('success'))
    <div class="bg-stokki-green text-white p-4 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

@if ($vendas->isEmpty())
    <p class="text-stokki-gray-text">Nenhuma venda registrada até o momento.</p>
@else
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-stokki-gray-border">
            <thead class="bg-stokki-gray-light">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-stokki-gray-text uppercase">Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-stokki-gray-text uppercase">Produto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-stokki-gray-text uppercase">Tipo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-stokki-gray-text uppercase">Qtd Fechado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-stokki-gray-text uppercase">Qtd Copos</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-stokki-gray-text uppercase">Valor Pago</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-stokki-gray-text uppercase">Valor Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-stokki-gray-text uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-stokki-gray-text uppercase">Data</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stokki-gray-border">
                @foreach ($vendas as $venda)
                    <tr>
                        <td class="px-6 py-4 text-sm text-stokki-gray-text">{{ $venda->cliente->nome }}</td>
                        <td class="px-6 py-4 text-sm text-stokki-gray-text">{{ $venda->produto->nome }}</td>
                        <td class="px-6 py-4 text-sm text-stokki-gray-text">{{ $venda->tipo_venda }}</td>
                        <td class="px-6 py-4 text-sm text-stokki-gray-text">{{ $venda->quantidade_fechado }}</td>
                        <td class="px-6 py-4 text-sm text-stokki-gray-text">{{ $venda->quantidade_copos }}</td>
                        <td class="px-6 py-4 text-sm text-stokki-gray-text">R$ {{ number_format($venda->valor_pago, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-stokki-gray-text">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-stokki-gray-text">{{ $venda->status_pagamento }}</td>
                        <td class="px-6 py-4 text-sm text-stokki-gray-text">{{ $venda->data_venda->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<div class="mt-6">
    <a href="{{ route('vendas.create') }}" class="inline-flex items-center gap-2 bg-stokki-green text-white font-bold py-2 px-4 rounded hover:bg-stokki-green-dark transition">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        Nova Venda
    </a>
</div>

<script>
    lucide.createIcons();
</script>
@endsection
