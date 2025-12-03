<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque - Stokki-Life</title>

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
            <h1 class="text-2xl font-bold text-stokki-green-dark">Stokki-Life</h1>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-stokki-gray-text hover:text-stokki-green-dark font-medium">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                Voltar ao Dashboard
            </a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8 fade-in">
        <h2 class="text-3xl font-bold text-stokki-green-dark mb-2">Estoque</h2>
        <p class="text-stokki-gray-text mb-8">Gerencie suas categorias e produtos</p>

        @if (session('success'))
            <div class="bg-stokki-green text-white px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulário unificado --}}
        <form method="POST" action="{{ route('estoque.store') }}" class="bg-white rounded-lg shadow-md p-6 mb-10">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-stokki-gray-text mb-1">Tipo de Cadastro</label>
                    <select name="tipo" id="tipoCadastro" class="w-full border border-stokki-gray-border rounded px-4 py-2">
                        <option value="categoria">Criar Pasta</option>
                        <option value="produto">Adicionar Produto</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-stokki-gray-text mb-1">Nome</label>
                    <input type="text" name="nome" class="w-full border border-stokki-gray-border rounded px-4 py-2" placeholder="Nome da pasta ou produto">
                </div>

                <div id="produtoCampos" style="display: none;" class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-stokki-gray-text mb-1">Quantidade</label>
                        <input type="number" name="quantidade" class="w-full border border-stokki-gray-border rounded px-4 py-2" min="1">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-stokki-gray-text mb-1">Pasta</label>
                        <select name="folder_id" class="w-full border border-stokki-gray-border rounded px-4 py-2">
                            <option value="">Selecione uma pasta</option>
                            @foreach ($folders as $folder)
                                <option value="{{ $folder->id }}">{{ $folder->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-stokki-gray-text mb-1">Data de Vencimento</label>
                        <input type="date" name="data_vencimento" class="w-full border border-stokki-gray-border rounded px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-stokki-gray-text mb-1">Dias até acabar</label>
                        <input type="number" name="dias_restantes" min="1" class="w-full border border-stokki-gray-border rounded px-4 py-2" placeholder="Ex: 30">
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-stokki-green text-white px-6 py-2 rounded hover:bg-stokki-green-dark transition">
                    Salvar
                </button>
            </div>
        </form>

        <script>
            const tipoSelect = document.getElementById('tipoCadastro');
            const produtoCampos = document.getElementById('produtoCampos');

            tipoSelect.addEventListener('change', function () {
                produtoCampos.style.display = this.value === 'produto' ? 'grid' : 'none';
            });
        </script>

        {{-- Listagem por pasta --}}
        @foreach($folders as $folder)
            <div class="mb-10">
                <h3 class="text-xl font-bold text-stokki-green-dark mb-4">{{ $folder->nome }}</h3>

                @if($folder->produtos->isEmpty())
                    <p class="text-stokki-gray-text">Nenhum produto nesta pasta.</p>
                @else
                    <table class="w-full mt-2 bg-white rounded-lg shadow-md overflow-hidden">
                        <thead class="bg-stokki-gray-light text-stokki-gray-text text-sm">
                            <tr>
                                <th class="px-4 py-2 text-left">Produto</th>
                                <th class="px-4 py-2 text-left">Quantidade</th>
                                <th class="px-4 py-2 text-left">Data de Vencimento</th>
                                <th class="px-4 py-2 text-left">Dias Restantes</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-stokki-gray-text divide-y divide-stokki-gray-border">
                            @foreach($folder->produtos as $produto)
                                <tr>
                                    <td class="px-4 py-2 flex items-center gap-2">
                                        {{ $produto->nome }}
                                        @if($produto->quantidade < 5)
                                            <span class="w-2 h-2 bg-red-500 rounded-full inline-block" title="Estoque baixo"></span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $produto->quantidade }}</td>
                                    <td class="px-4 py-2">
                                        {{ $produto->data_vencimento ? \Carbon\Carbon::parse($produto->data_vencimento)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $produto->dias_restantes ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endforeach
    </main>

    <script>lucide.createIcons();</script>
</body>
</html>
