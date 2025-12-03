<link rel="icon" type="image/jpeg" href="{{ asset('images/icon.png') }}">
@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-stokki-green-dark">Meu Perfil</h2>
    <a href="{{ route('dashboard') }}" class="text-stokki-green hover:text-stokki-green-dark">Voltar</a>
</div>

@if (session('success'))
    <div id="flash-success" class="bg-stokki-green text-white p-4 rounded mb-6 transition-opacity duration-500">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('flash-success');
            if (el) el.style.opacity = '0';
            setTimeout(() => el && el.remove(), 600);
        }, 5000);
    </script>
@endif

<form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-6">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm text-stokki-gray-text mb-1">Nome</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-stokki-gray-border rounded px-4 py-2">
    </div>

    <div>
        <label class="block text-sm text-stokki-gray-text mb-1">Telefone</label>
        <input type="text" name="telefone" value="{{ old('telefone', $user->telefone ?? '') }}" class="w-full border border-stokki-gray-border rounded px-4 py-2">
    </div>

    <div>
        <label class="block text-sm text-stokki-gray-text mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-stokki-gray-border rounded px-4 py-2">
    </div>

    <div>
        <label class="block text-sm text-stokki-gray-text mb-1">Ícone de Perfil</label>
        <input type="file" name="avatar" accept="image/*" class="w-full border border-stokki-gray-border rounded px-4 py-2">
        @if(!empty($user->avatar_path))
            <img src="{{ asset('storage/'.$user->avatar_path) }}" alt="Avatar" class="mt-3 w-20 h-20 rounded-full object-cover">
        @endif
    </div>

    <button class="bg-stokki-green text-white font-bold py-2 px-4 rounded hover:bg-stokki-green-dark">Salvar</button>
</form>
@endsection
