<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mobile Service') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Dark Mode Style -->
    <style>
        body {
            background-color: rgba(73, 72, 72, 0.15);
            transition: .3s;
            color: #111;
        }
        .dark-mode {
            background-color: #111 !important;
            color: white !important;
        }
        .dark-mode nav,
        .dark-mode footer {
            background: #222 !important;
        }
        .dark-mode .card,
        .dark-mode .modal-content,
        .dark-mode .table {
            background-color: #222 !important;
            color: white !important;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-dark bg-dark navbar-expand-md px-3">
        <a class="navbar-brand text-white" href="/">
            Mobile Service Center
        </a>

        <button id="themeToggle" class="btn btn-outline-light btn-sm me-2">
            🌙
        </button>

        @auth
        <div class="dropdown ms-auto">
            <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                {{ Auth::user()->name }}
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth

        @guest
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Sign in</a>
            <a href="{{ route('register') }}" class="btn btn-light btn-sm">Sign up</a>
        </div>
        @endguest
    </nav>


    <main style="min-height:85vh;">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-2">
        © {{ date('Y') }} Mobile Service Management App
    </footer>


    <!-- JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dark Mode Toggle -->
    <script>
        const body = document.body;
        const toggleBtn = document.getElementById("themeToggle");

        if (localStorage.getItem("theme") === "dark") {
            body.classList.add("dark-mode");
            toggleBtn.textContent = "☀️";
        }

        toggleBtn.addEventListener("click", () => {
            body.classList.toggle("dark-mode");
            const isDark = body.classList.contains("dark-mode");
            localStorage.setItem("theme", isDark ? "dark" : "light");
            toggleBtn.textContent = isDark ? "☀️" : "🌙";
        });
    </script>

    <!-- Page-specific scripts like Chart.js -->
    @stack('scripts')

</body>

</html>
