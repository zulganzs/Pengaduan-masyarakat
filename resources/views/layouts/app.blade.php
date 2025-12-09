<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Masyarakat</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN for immediate preview) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            green: '#10B981',
                            blue: '#3B82F6',
                            dark: '#111827',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS for Fluid Typography & Animations -->
    <style>
        :root {
            /* Fluid Typography: min 16px, max 18px */
            --text-base: clamp(1rem, 2vw, 1.125rem); 
            /* Fluid Heading 1: min 32px, max 48px */
            --text-h1: clamp(2rem, 5vw, 3rem);
            /* Fluid Spacing */
            --space-container: clamp(1rem, 5vw, 4rem);
        }
        
        body {
            font-size: var(--text-base);
            font-family: 'Inter', sans-serif;
        }
        
        h1 { font-size: var(--text-h1); }
        
        /* Barba.js Transition Styles */
        .fade-leave-active,
        .fade-enter-active {
            transition: opacity 0.4s ease, transform 0.4s ease;
        }
        .fade-leave-from,
        .fade-enter-to {
            opacity: 1;
            transform: translateY(0);
        }
        .fade-leave-to,
        .fade-enter-from {
            opacity: 0;
            transform: translateY(20px);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased" data-barba="wrapper">
    
    <!-- Navbar -->
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('landing') }}" class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-green to-brand-blue hover:opacity-80 transition">
                        Laporan.
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('landing') }}" class="text-gray-600 hover:text-brand-green transition font-medium">{{ __('Home') }}</a>
                    <a href="{{ route('reports.index') }}" class="text-gray-600 hover:text-brand-green transition font-medium">{{ __('Public Feed') }}</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-brand-green transition font-medium">{{ __('Dashboard') }}</a>
                    @endauth
                </div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Language Toggle -->
                    <div class="flex items-center bg-gray-100 rounded-full p-1">
                        <a href="{{ route('lang.switch', 'en') }}" data-barba-prevent class="px-3 py-1 rounded-full text-xs font-semibold {{ app()->getLocale() == 'en' ? 'bg-white shadow text-brand-green' : 'text-gray-500 hover:text-gray-700' }}">EN</a>
                        <a href="{{ route('lang.switch', 'id') }}" data-barba-prevent class="px-3 py-1 rounded-full text-xs font-semibold {{ app()->getLocale() == 'id' ? 'bg-white shadow text-brand-green' : 'text-gray-500 hover:text-gray-700' }}">ID</a>
                    </div>

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium">{{ __('Logout') }}</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block px-5 py-2 rounded-full bg-brand-green text-white text-sm font-medium hover:bg-green-600 transition shadow-lg shadow-green-200">
                            {{ __('Login') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content (Barba Container) -->
    <main data-barba="container" data-barba-namespace="default" class="pt-16 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-400 text-sm">
            &copy; {{ date('Y') }} Laporan Masyarakat. Built with Laravel.
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/@barba/core"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            barba.init({
                transitions: [{
                    name: 'fade',
                    leave(data) {
                        return new Promise(done => {
                            data.current.container.classList.add('fade-leave-active', 'fade-leave-to');
                            setTimeout(done, 400); // Match CSS duration
                        });
                    },
                    enter(data) {
                        data.next.container.classList.add('fade-enter-from', 'fade-enter-active');
                        return new Promise(done => {
                            setTimeout(() => {
                                data.next.container.classList.remove('fade-enter-from');
                                done();
                            }, 10);
                        });
                    }
                }]
            });
        });
    </script>
</body>
</html>
