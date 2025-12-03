<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Stokki-Life</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        'stokki-green': { DEFAULT: '#38A169', dark: '#2F855A' },
                        'stokki-red': { DEFAULT: '#E53E3E' },
                        'stokki-gray': { light: '#F7FAFC', text: '#718096', border: '#E2E8F0' }
                    }
                }
            }
        }
    </script>
    <style>
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/icon.png') }}">
</head>


<body class="bg-stokki-gray-light font-sans antialiased">
    <header class="bg-white border-b border-stokki-gray-border shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/LogoStokkiLife.png') }}" alt="Stokki-Life" class="h-10 w-10 rounded-full object-cover">
                <h1 class="text-2xl font-bold text-stokki-green-dark">Stokki-Life</h1>
            </div>
            <div class="flex items-center gap-4">
                <!-- Botão de Configuração (Perfil) -->
                <a href="{{ route('perfil.edit') }}" class="p-2 rounded hover:bg-stokki-gray-light" title="Configurações">
                    <i data-lucide="settings" class="w-5 h-5 text-stokki-gray-text"></i>
                </a>
                <!-- Botão de Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center gap-2 px-4 py-2 bg-stokki-green text-white rounded-md hover:bg-stokki-green-dark">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Sair
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8 fade-in">
        <h2 class="text-3xl font-bold text-stokki-green-dark mb-2">Bem-vindo, {{ $user->name }}!</h2>
        <p class="text-stokki-gray-text mb-8">Visão Geral de Hoje</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="shopping-cart" class="w-6 h-6 text-stokki-green"></i>
                    <h3 class="text-lg font-semibold text-stokki-gray-text">Vendas no Dia</h3>
                </div>
                <p class="text-3xl font-bold text-stokki-green-dark">{{ $vendasHoje }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-stokki-red"></i>
                    <h3 class="text-lg font-semibold text-stokki-gray-text">Itens em estoque baixo</h3>
                </div>
                <p class="text-3xl font-bold text-stokki-red">{{ $produtosBaixoEstoque }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="credit-card" class="w-6 h-6 text-stokki-green"></i>
                    <h3 class="text-lg font-semibold text-stokki-gray-text">Vendas mensal</h3>
                </div>
                <p class="text-3xl font-bold text-stokki-green-dark">
                    R$ {{ number_format($vendasMensal, 2, ',', '.') }}
                </p>
            </div>
        </div>

        <h3 class="text-xl font-bold text-stokki-green-dark mb-4">Ações Rápidas</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('vendas.create') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition flex items-center gap-3">
                <i data-lucide="plus-circle" class="w-6 h-6 text-stokki-green"></i>
                <span class="text-stokki-gray-text font-semibold">Registrar Venda</span>
            </a>
            <a href="{{ route('acessos.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition flex items-center gap-3">
                <i data-lucide="folder-open" class="w-6 h-6 text-stokki-green"></i>
                <span class="text-stokki-gray-text font-semibold">Acessos</span>
            </a>
            <a href="{{ route('estoque.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition flex items-center gap-3">
                <i data-lucide="package" class="w-6 h-6 text-stokki-green"></i>
                <span class="text-stokki-gray-text font-semibold">Estoque</span>
            </a>
           <a href="{{ route('contas.index') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition flex items-center gap-3">
    <i data-lucide="file-text" class="w-6 h-6 text-stokki-green"></i>
    <span class="text-stokki-gray-text font-semibold">Contas a Receber</span>
</a>

        </div>
    </main>

    <script>lucide.createIcons();</script>
</body>
</html>
