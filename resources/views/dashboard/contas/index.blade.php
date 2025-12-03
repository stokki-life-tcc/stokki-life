<link rel="icon" type="image/jpeg" href="{{ asset('images/icon.png') }}">
@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-stokki-green hover:text-stokki-green-dark font-medium">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        Voltar ao Dashboard
    </a>
</div>

<h2 class="text-3xl font-bold text-stokki-green-dark mb-2">Contas a Receber</h2>
<p class="text-stokki-gray-text mb-8">Histórico de clientes e status de pagamento</p>

@if (session('success'))
    <div class="bg-stokki-green text-white p-4 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

@foreach ($clientes as $cliente)
    <div class="mb-6 border border-stokki-gray-border rounded-lg shadow-sm">
        <!-- Cabeçalho do cliente -->
        <div class="flex items-center justify-between bg-white p-4 cursor-pointer"
             onclick="toggleCliente('{{ $cliente->id }}')">
            <div>
                <h3 class="text-xl font-bold text-stokki-green-dark">{{ $cliente->nome }}</h3>
                <p class="text-stokki-gray-text">Compras: {{ $cliente->vendas->count() }}</p>
            </div>
            <button class="text-stokki-gray-text hover:text-stokki-green-dark">
                <i data-lucide="chevron-down" id="icon-{{ $cliente->id }}"></i>
            </button>
        </div>

        <!-- Conteúdo expansível -->
        <div id="cliente-{{ $cliente->id }}" 
             class="hidden bg-white p-4 transition-all duration-500 ease-in-out opacity-0">
            <table class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-stokki-gray-border">
                        <th class="px-4 py-2">Data</th>
                        <th class="px-4 py-2">Produto</th>
                        <th class="px-4 py-2">Valor Pago</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Telefone</th>
                        <th class="px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cliente->vendas as $venda)
                        <tr class="border-b border-stokki-gray-border">
                            <td class="px-4 py-2">{{ $venda->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $venda->produto->nome }}</td>

                            {{-- Valor Pago --}}
                            <td class="px-4 py-2">
                                @if($venda->conta)
                                    R$ {{ number_format($venda->conta->valor_pago, 2, ',', '.') }}
                                @else
                                    <span class="text-stokki-red">—</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-2">
                                @if($venda->conta)
                                    <span class="{{ $venda->conta->status === 'Pago' ? 'text-stokki-green-dark font-bold' : 'text-stokki-red font-bold' }}">
                                        {{ ucfirst($venda->conta->status) }}
                                    </span>
                                @else
                                    <span class="text-stokki-red font-bold">Sem conta</span>
                                @endif
                            </td>

                            {{-- Telefone --}}
                            <td class="px-4 py-2">
                                @php
                                    $numero = $venda->cliente->numero_cliente ?? null;
                                @endphp

                                @if(!$numero || Str::startsWith($numero, 'cli_'))
                                    <span class="text-stokki-gray-text">Número não adicionado</span>
                                @else
                                    {{ $numero }}
                                @endif
                            </td>

                            {{-- Ação --}}
                            <td class="px-4 py-2">
                                @if($venda->conta && $venda->conta->status !== 'Pago')
                                    <form action="{{ route('contas.update', $venda->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-stokki-green text-white px-3 py-1 rounded hover:bg-stokki-green-dark">
                                            Marcar como Pago
                                        </button>
                                    </form>
                                @elseif($venda->conta && $venda->conta->status === 'Pago')
                                    <span class="text-stokki-green-dark">✔ Pago</span>
                                @else
                                    <span class="text-stokki-gray-text">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center text-stokki-gray-text">Nenhuma venda registrada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endforeach

<script>
    lucide.createIcons();

    function toggleCliente(id) {
        const section = document.getElementById('cliente-' + id);
        const icon = document.getElementById('icon-' + id);

        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
            setTimeout(() => section.classList.remove('opacity-0'), 10);
            icon.setAttribute('data-lucide', 'chevron-up');
        } else {
            section.classList.add('opacity-0');
            setTimeout(() => section.classList.add('hidden'), 500);
            icon.setAttribute('data-lucide', 'chevron-down');
        }
        lucide.createIcons();
    }
</script>
@endsection
