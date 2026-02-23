<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Davy Blog') - Davy Blog</title>
    
    @yield('meta')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Dark Mode Initial Script -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="font-sans antialiased text-gray-800 bg-surface-light dark:bg-surface-darker dark:text-gray-200 flex flex-col min-h-screen transition-colors duration-300">

    <!-- Header -->
    <header x-data="{ open: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
            :class="{'bg-white/80 dark:bg-surface-dark/80 backdrop-blur-lg shadow-soft dark:shadow-soft-dark': scrolled, 'bg-transparent': !scrolled}"
            class="fixed w-full top-0 z-50 transition-all duration-300 border-b border-transparent"
            x-bind:class="{'dark:border-white/5 border-black/5': scrolled}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20 transition-all duration-300">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <!-- Stylized Textual Logo -->
                        <div class="relative flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tr from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20 border border-primary-200 dark:border-primary-700/50 shadow-sm transition-transform group-hover:scale-105">
                            <span class="font-serif italic font-bold text-3xl text-primary-600 dark:text-primary-400 leading-none">D</span>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-accent-500 shadow-glow"></div>
                        </div>
                        <span class="font-serif text-2xl tracking-tight text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">Davy.</span>
                    </a>
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition-colors">Accueil</a>
                    <a href="{{ route('posts.index') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition-colors">Blog</a>
                    <a href="{{ route('about') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition-colors">À propos</a>
                </nav>

                <!-- Actions -->
                <div class="hidden md:flex items-center space-x-4">
                    <!-- Theme Toggle Alpine Component -->
                    <div x-data="{ 
                        theme: localStorage.theme || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
                        toggleTheme() {
                            this.theme = this.theme === 'dark' ? 'light' : 'dark';
                            if (this.theme === 'dark') {
                                document.documentElement.classList.add('dark');
                                localStorage.theme = 'dark';
                            } else {
                                document.documentElement.classList.remove('dark');
                                localStorage.theme = 'light';
                            }
                        }
                    }">
                        <button @click="toggleTheme()" class="text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 transition-colors p-2.5 rounded-xl hover:bg-gray-100 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-primary-500/50">
                            <span class="sr-only">Toggle dark mode</span>
                            <svg x-show="theme === 'light'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                            <svg x-show="theme === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </button>
                    </div>

                    <div class="h-6 w-px bg-gray-200 dark:bg-white/10"></div>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium px-4 py-2 rounded-xl text-primary-700 bg-primary-50 hover:bg-primary-100 dark:text-primary-400 dark:bg-primary-900/30 dark:hover:bg-primary-900/50 transition-colors">Dashboard Admin</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition-colors">Profil</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition-colors">Connexion</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium px-5 py-2.5 rounded-xl bg-primary-600 text-white hover:bg-primary-700 shadow-[0_4px_14px_0_rgba(124,58,237,0.39)] hover:shadow-[0_6px_20px_rgba(124,58,237,0.23)] hover:-translate-y-0.5 transition-all duration-200">S'inscrire</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="open = !open" class="text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white focus:outline-none p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-white/5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open" style="display: none;" class="md:hidden bg-white dark:bg-surface-dark border-b border-gray-100 dark:border-white/5 shadow-soft dark:shadow-soft-dark absolute w-full">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-xl text-base font-medium text-primary-600 bg-primary-50 dark:text-primary-400 dark:bg-primary-900/20">Accueil</a>
                <a href="{{ route('posts.index') }}" class="block px-3 py-2.5 rounded-xl text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5">Blog</a>
                <a href="{{ route('about') }}" class="block px-3 py-2.5 rounded-xl text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5">À propos</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow pt-16 md:pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-surface-dark border-t border-gray-100 dark:border-white/5 pt-16 pb-8 mt-12 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-primary-500/50 to-transparent opacity-50"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-8">
                <div class="md:col-span-1 lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-6">
                        <div class="relative flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-tr from-primary-50 to-primary-100 dark:from-primary-900/20 dark:to-primary-800/20 border border-primary-200 dark:border-primary-700/50 shadow-sm">
                            <span class="font-serif italic font-bold text-2xl text-primary-600 dark:text-primary-400 leading-none">D</span>
                            <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full bg-accent-500 shadow-glow"></div>
                        </div>
                        <span class="font-serif text-xl tracking-tight text-gray-900 dark:text-white">Davy.</span>
                    </a>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6 italic">
                        Plumes, récits et émotions. Bienvenue dans l'univers littéraire de Davy. Espace de partage, de chroniques et de découvertes romanesques.
                    </p>
                </div>
                
                <div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Explorer</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('posts.index') }}" class="text-sm text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 transition-colors">Tous les articles</a></li>
                        <li><a href="{{ route('about') }}" class="text-sm text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 transition-colors">À propos</a></li>
                    </ul>
                </div>
                
                <div class="md:col-span-2">
                    <div class="bg-gray-50 dark:bg-white/5 rounded-2xl p-6 border border-gray-100 dark:border-white/5">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-2">Restez informé</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Rejoignez la newsletter pour ne manquer aucune publication, dédicace ou nouvelle sortie.</p>
                        <form class="flex relative">
                            <input type="email" placeholder="votre@email.com" class="w-full pl-4 pr-32 py-3 rounded-xl border-gray-200 dark:border-white/10 bg-white dark:bg-surface-darker text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm shadow-sm transition-all outline-none">
                            <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 bg-primary-600 hover:bg-primary-700 text-white px-5 rounded-lg text-sm font-medium shadow-md transition-all">S'inscrire</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-100 dark:border-white/5 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-400 dark:text-gray-500">
                    &copy; {{ date('Y') }} Séverine Davy. Tous droits réservés.
                </p>
                <div class="flex space-x-5">
                    <!-- GitHub -->
                    <a href="#" class="text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                        <span class="sr-only">GitHub</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
