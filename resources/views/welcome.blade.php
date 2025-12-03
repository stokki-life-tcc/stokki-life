<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao Stokki-Life</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        'stokki-green': { DEFAULT: '#38A169', dark: '#2F855A' },
                        'stokki-gray': { light: '#F7FAFC', text: '#718096', border: '#E2E8F0' }
                    }
                }
            }
        }
    </script>
    <style>
        .fade-in { animation: fadeIn 0.6s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/icon.png') }}">
</head>

<body class="bg-stokki-gray-light font-sans antialiased fade-in">

    <!-- Header -->
    <header class="bg-white shadow border-b border-stokki-gray-border fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/LogoStokkiLife.png') }}" alt="Stokki-Life" class="h-10 w-10 rounded-full object-cover">
                <span class="font-bold text-stokki-green-dark text-lg">Stokki-Life</span>
            </div>
            <nav class="flex gap-6 text-stokki-gray-text font-medium">
                <a href="#funcionalidades" class="hover:text-stokki-green-dark">Funcionalidades</a>
                <a href="#faq" class="hover:text-stokki-green-dark">FAQ</a>
                <a href="#video" class="hover:text-stokki-green-dark">Apresentação</a>
                <a href="{{ route('login') }}" class="hover:text-stokki-green-dark">Entrar</a>
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="bg-gradient-to-r from-stokki-green to-stokki-green-dark text-white py-32 text-center mt-20">
        <h1 class="text-5xl font-bold mb-4">Controle seu estoque de forma simples e eficiente</h1>
        <p class="text-xl max-w-2xl mx-auto mb-6">Com o Stokki-Life, você organiza, vende e cresce em apenas alguns cliques.</p>
        <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-stokki-green-dark font-semibold rounded-lg shadow hover:bg-stokki-gray-light transition">Quero começar agora</a>
    </section>

    <!-- Funcionalidades -->
    <section id="funcionalidades" class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-stokki-green-dark text-center mb-12">Funcionalidades do Stokki-Life</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <i data-lucide="package" class="w-8 h-8 text-stokki-green-dark mx-auto mb-3"></i>
                <h3 class="text-lg font-semibold text-stokki-green-dark">Gestão de Estoque</h3>
                <p class="text-stokki-gray-text mt-2">Cadastre produtos, controle entradas e saídas, e receba alertas de estoque baixo.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <i data-lucide="shopping-cart" class="w-8 h-8 text-stokki-green-dark mx-auto mb-3"></i>
                <h3 class="text-lg font-semibold text-stokki-green-dark">Registro de Vendas</h3>
                <p class="text-stokki-gray-text mt-2">Venda por copo ou fechado, com atualização automática do estoque.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <i data-lucide="credit-card" class="w-8 h-8 text-stokki-green-dark mx-auto mb-3"></i>
                <h3 class="text-lg font-semibold text-stokki-green-dark">Contas a Receber</h3>
                <p class="text-stokki-gray-text mt-2">Controle pagamentos pendentes e marque como recebido com um clique.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <i data-lucide="bar-chart-2" class="w-8 h-8 text-stokki-green-dark mx-auto mb-3"></i>
                <h3 class="text-lg font-semibold text-stokki-green-dark">Relatórios Inteligentes</h3>
                <p class="text-stokki-gray-text mt-2">Veja os produtos mais vendidos e os que estão parados no estoque.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <i data-lucide="bell" class="w-8 h-8 text-stokki-green-dark mx-auto mb-3"></i>
                <h3 class="text-lg font-semibold text-stokki-green-dark">Notificações via WhatsApp</h3>
                <p class="text-stokki-gray-text mt-2">Receba alertas automáticos sobre vencimento e estoque baixo.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <i data-lucide="shield" class="w-8 h-8 text-stokki-green-dark mx-auto mb-3"></i>
                <h3 class="text-lg font-semibold text-stokki-green-dark">Segurança de Dados</h3>
                <p class="text-stokki-gray-text mt-2">Controle quem acessa informações sensíveis como custo e fornecedores.</p>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="max-w-4xl mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-stokki-green-dark text-center mb-8">Dúvidas Frequentes</h2>
        <ul class="space-y-6 text-stokki-gray-text">
            <li><strong>O Stokki funciona para lojas físicas e online?</strong><br>Sim! O sistema é flexível e atende qualquer tipo de operação.</li>
            <li><strong>Consigo usar mesmo tendo feito controle manual?</strong><br>Claro! A interface é simples e pensada para quem nunca usou sistema.</li>
            <li><strong>O sistema ajuda a evitar perdas?</strong><br>Sim! Com alertas de vencimento e estoque baixo, você evita desperdícios.</li>
            <li><strong>O Stokki envia notificações?</strong><br>Sim! Você recebe avisos direto no WhatsApp.</li>
        </ul>
    </section>

    <!-- Vídeo -->
    <section id="video" class="max-w-5xl mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-stokki-green-dark text-center mb-6">Veja como funciona</h2>
        <p class="text-center text-stokki-gray-text mb-6">Assista ao vídeo e descubra como o Stokki-Life pode transformar a gestão do seu negócio.</p>
        <div class="aspect-w-16 aspect-h-9">
            <iframe class="w-full h-96 rounded" src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Apresentação Stokki-Life" frameborder="0" allowfullscreen></iframe>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="bg-white border-t border-stokki-gray-border py-6 text-center text-stokki-gray-text">
        <p>&copy; {{ date('Y') }} Stokki-Life. Todos os direitos reservados. | Versão 1.0</p>
        <p class="mt-2 italic">“O estoque representa dinheiro parado — gerencie com inteligência e cresça com segurança.”</p>
    </footer>

    <script>lucide.createIcons();</script>
</body>
</html>
