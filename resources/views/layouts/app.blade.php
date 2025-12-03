<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Stokki-Life</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind custom config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        'stokki-green': { DEFAULT: '#38A169', dark: '#2F855A' },
                        'stokki-red': { DEFAULT: '#E53E3E' },
                        'stokki-gray': {
                            light: '#F7FAFC',
                            text: '#718096',
                            border: '#E2E8F0'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom animations + Loader CSS -->
    <style>
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        /* Loader styles */
        .loader {
          width: fit-content;
          height: fit-content;
          display: flex;
          align-items: center;
          justify-content: center;
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          z-index: 50;
          background-color: white;
          padding: 20px;
          border-radius: 12px;
        }
        .truckWrapper {
          width: 200px;
          height: 100px;
          display: flex;
          flex-direction: column;
          position: relative;
          align-items: center;
          justify-content: flex-end;
          overflow-x: hidden;
        }
        .truckBody {
          width: 130px;
          margin-bottom: 6px;
          animation: motion 1s linear infinite;
        }
        @keyframes motion {
          0% { transform: translateY(0px); }
          50% { transform: translateY(3px); }
          100% { transform: translateY(0px); }
        }
        .truckTires {
          width: 130px;
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 0px 10px 0px 15px;
          position: absolute;
          bottom: 0;
        }
        .truckTires svg { width: 24px; }
        .road {
          width: 100%;
          height: 1.5px;
          background-color: #282828;
          position: relative;
          bottom: 0;
          align-self: flex-end;
          border-radius: 3px;
        }
        .road::before {
          content: "";
          position: absolute;
          width: 20px;
          height: 100%;
          background-color: #282828;
          right: -50%;
          border-radius: 3px;
          animation: roadAnimation 1.4s linear infinite;
          border-left: 10px solid white;
        }
        .road::after {
          content: "";
          position: absolute;
          width: 10px;
          height: 100%;
          background-color: #282828;
          right: -65%;
          border-radius: 3px;
          animation: roadAnimation 1.4s linear infinite;
          border-left: 4px solid white;
        }
        .lampPost {
          position: absolute;
          bottom: 0;
          right: -90%;
          height: 90px;
          animation: roadAnimation 1.4s linear infinite;
        }
        @keyframes roadAnimation {
          0% { transform: translateX(0px); }
          100% { transform: translateX(-350px); }
        }
    </style>

    <!-- Favicon global -->
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
</head>
<body class="bg-stokki-gray-light font-sans antialiased fade-in">

    <!-- Loader -->
    <div id="page-loader" class="loader">
      <div class="truckWrapper">
        <div class="truckBody">
          <!-- Caminhão SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 198 93" class="trucksvg">
            <path stroke-width="3" stroke="#282828" fill="#F83D3D"
              d="M135 22.5H177.264C178.295 22.5 179.22 23.133 179.594 24.0939L192.33 56.8443C192.442 57.1332 192.5 57.4404 192.5 57.7504V89C192.5 90.3807 191.381 91.5 190 91.5H135C133.619 91.5 132.5 90.3807 132.5 89V25C132.5 23.6193 133.619 22.5 135 22.5Z"></path>
            <!-- ... restante dos paths do caminhão ... -->
          </svg>
        </div>
        <div class="truckTires">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30" class="tiresvg">
            <circle stroke-width="3" stroke="#282828" fill="#282828" r="13.5" cy="15" cx="15"></circle>
            <circle fill="#DFDFDF" r="7" cy="15" cx="15"></circle>
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30" class="tiresvg">
            <circle stroke-width="3" stroke="#282828" fill="#282828" r="13.5" cy="15" cx="15"></circle>
            <circle fill="#DFDFDF" r="7" cy="15" cx="15"></circle>
          </svg>
        </div>
        <div class="road"></div>
        <svg viewBox="0 0 453.459 453.459" class="lampPost">
          <path d="M252.882,0c-37.781,0-68.686,29.953-70.245,67.358h-6.917v8.954..."></path>
        </svg>
      </div>
    </div>

    <!-- Header com logo e perfil -->
    <header class="bg-white border-b border-stokki-gray-border shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo Stokki -->
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/LogoStokkiLife.png') }}" alt="Stokki-Life" class="h-8 w-8 rounded-full object-cover">
                    <span class="font-bold text-stokki-green-dark">Stokki-Life</span>
                </a>
            </div>

            <!-- Dropdown de perfil -->
            <div class="relative">
                <button id="profile-btn" class="flex items-center gap-2 p-2 rounded hover:bg-stokki-gray-light transition">
                    <i data-lucide="user"></i>
                    <span>{{ auth()->user()->name ?? 'Usuário' }}</span>
                </button>
                <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white border border-stokki-gray-border rounded shadow">
                    <a href="{{ route('perfil.edit') }}" class="block px-4 py-2 hover:bg-stokki-gray-light">Perfil</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full text-left px-4 py-2 hover:bg-stokki-gray-light">Sair</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    @include('components.toast')

    <main class="max-w-3xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <script>
        lucide.createIcons();

        // Dropdown de perfil
        document.getElementById('profile-btn')?.addEventListener('click', () => {
            document.getElementById('profile-menu')?.classList.toggle('hidden');
        });

 // Loader hide after page load
        window.addEventListener('load', () => {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.style.display = 'none';
            }
        });
    </script>
</body>
</html>