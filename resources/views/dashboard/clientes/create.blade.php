<link rel="icon" type="image/jpeg" href="{{ asset('images/icon.png') }}">
@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('clientes.index') }}" class="inline-flex items-center gap-2 text-stokki-green hover:text-stokki-green-dark font-medium">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        Voltar à lista de clientes
    </a>
</div>

<h2 class="text-3xl font-bold text-stokki-green-dark mb-2">Cadastrar Cliente</h2>
<p class="text-stokki-gray-text mb-6">Preencha os dados abaixo para cadastrar um novo cliente.</p>

@if ($errors->any())
    <div class="bg-stokki-red text-white p-4 rounded mb-6">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('clientes.store') }}" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf

    {{-- Nome do Cliente --}}
    <div>
        <label for="nome" class="block text-sm font-medium text-stokki-gray-text mb-1">Nome Completo</label>
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required
               class="w-full border border-stokki-gray-border rounded px-4 py-2"
               placeholder="Digite nome e sobrenome">
    </div>

    {{-- Número do Cliente (opcional) --}}
    <div>
        <label for="numero_cliente" class="block text-sm font-medium text-stokki-gray-text mb-1">Número do Cliente</label>
        <input type="text" name="numero_cliente" id="numero_cliente" value="{{ old('numero_cliente') }}"
               class="w-full border border-stokki-gray-border rounded px-4 py-2"
               placeholder="Digite um identificador opcional">
    </div>

    <div>
        <button type="submit"
                class="w-full flex justify-center items-center gap-2 bg-stokki-green text-white font-bold py-3 rounded hover:bg-stokki-green-dark transition">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            Salvar Cliente
        </button>
    </div>
</form>

<script>
    lucide.createIcons();
</script>
@endsection
