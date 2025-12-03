<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acessos - Stokki-Life</title>
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
    <main class="max-w-4xl mx-auto px-4 py-8 fade-in">
        
        {{-- Botão de voltar ao Dashboard --}}
        <div class="mb-6">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center gap-2 text-stokki-green hover:text-stokki-green-dark font-medium">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                Voltar ao Dashboard
            </a>
        </div>

        <h2 class="text-3xl font-bold text-stokki-green-dark mb-2">Histórico de Acessos</h2>
        <p class="text-stokki-gray-text mb-6">Visualize os produtos que entraram no estoque e os que foram vendidos.</p>

        <section>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-stokki-gray-border">
                    <thead class="bg-stokki-gray-light text-stokki-gray-text text-sm">
                        <tr>
                            <th class="px-4 py-2 text-left">Data</th>
                            <th class="px-4 py-2 text-left">Tipo</th>
                            <th class="px-4 py-2 text-left">Produto</th>
                            <th class="px-4 py-2 text-left">Quantidade</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-stokki-gray-text divide-y divide-stokki-gray-border">
                        @foreach ($entradas as $entrada)
                            <tr>
                                <td class="px-4 py-2">{{ $entrada->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 text-green-600 font-semibold">Entrada</td>
                                <td class="px-4 py-2">{{ $entrada->produto }}</td>
                                <td class="px-4 py-2">+{{ $entrada->quantidade }}</td>
                            </tr>
                        @endforeach

                        @foreach ($vendas as $venda)
                            <tr>
                                <td class="px-4 py-2">{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 text-red-600 font-semibold">Venda</td>
                                <td class="px-4 py-2">{{ $venda->produto }}</td>
                                <td class="px-4 py-2">-{{ $venda->quantidade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>lucide.createIcons();</script>
</body>
</html>
