@extends('layouts.main')

@section('title', 'Accueil')

@section('content')
<!-- Hero Section -->
<section class="relative bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800 overflow-hidden">
    <!-- Abstract Background Pattern -->
    <div class="absolute inset-0 pointer-events-none w-full h-full overflow-hidden opacity-30 dark:opacity-20 z-0">
        <svg class="absolute -top-24 -right-24 w-96 h-96 text-indigo-50 dark:text-indigo-900/30 blur-3xl rounded-full" fill="currentColor" viewBox="0 0 100 100"></svg>
        <svg class="absolute top-1/2 left-0 w-64 h-64 text-purple-50 dark:text-purple-900/30 blur-3xl rounded-full transform -translate-y-1/2 -translate-x-1/2" fill="currentColor" viewBox="0 0 100 100"></svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-16 pb-24 md:pt-24 md:pb-32">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-6 font-serif">
                Explorez le monde du <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Développement Web</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 mb-8 font-sans leading-relaxed">
                Tutoriels, astuces et réflexions autour de Laravel, de l'écosystème PHP, et du développement moderne.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#recent-posts" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 shadow-md hover:shadow-lg transition-all duration-300">
                    Découvrir les articles
                </a>
                <a href="#" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 dark:border-slate-700 text-base font-medium rounded-full text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-all duration-300">
                    S'abonner à la newsletter
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Posts -->
@if($featuredPosts->count() > 0)
<section class="py-16 bg-gray-50 dark:bg-slate-800/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                En Vedette
            </h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredPosts as $post)
            <article class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden hover:shadow-md transition-shadow group flex flex-col h-full">
                <div class="relative h-48 sm:h-56 w-full overflow-hidden bg-gray-200 dark:bg-slate-800">
                    @if($post->cover_image)
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-slate-600">
                            <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold backdrop-blur-md bg-white/80 dark:bg-slate-900/80" style="color: {{ $post->category->color }}">
                            {{ $post->category->name }}
                        </span>
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-2 flex items-center justify-between">
                        <span>{{ $post->published_at->format('d M Y') }}</span>
                        <span>{{ ceil(str_word_count(strip_tags($post->body)) / 200) }} min de lecture</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-serif line-clamp-2 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        <a href="#">{{ $post->title }}</a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4 flex-grow">
                        {{ $post->excerpt }}
                    </p>
                    <div class="flex items-center mt-auto pt-4 border-t border-gray-100 dark:border-slate-800">
                        <div class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-slate-800 flex items-center justify-center text-indigo-700 dark:text-indigo-400 font-bold text-sm">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-900 dark:text-white">{{ $post->user->name }}</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Main Content Grid -->
<section id="recent-posts" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Left Column: Recent Posts -->
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200 dark:border-slate-800">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white font-serif">Articles Récents</h2>
                    <a href="#" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 flex items-center gap-1">
                        Voir tout <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <div class="space-y-10">
                    @forelse($recentPosts as $post)
                    <article class="group flex flex-col md:flex-row gap-6 items-start">
                        <div class="w-full md:w-1/3 shrink-0">
                            <a href="#" class="block relative h-48 md:h-36 w-full rounded-xl overflow-hidden bg-gray-200 dark:bg-slate-800">
                                @if($post->cover_image)
                                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-slate-600">
                                        <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 ring-1 ring-inset ring-black/10 dark:ring-white/10 rounded-xl"></div>
                            </a>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="flex items-center gap-3 text-sm mb-2">
                                <span class="font-medium" style="color: {{ $post->category->color }}">{{ $post->category->name }}</span>
                                <span class="text-gray-300 dark:text-slate-700">&bull;</span>
                                <time class="text-gray-500 dark:text-gray-400" datetime="{{ $post->published_at }}">{{ $post->published_at->format('d M Y') }}</time>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-serif leading-snug group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                <a href="#">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 text-base line-clamp-2 leading-relaxed mb-3">
                                {{ $post->excerpt }}
                            </p>
                            <div class="flex items-center mt-auto">
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $post->user->name }}</span>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="text-center py-12 bg-gray-50 dark:bg-slate-800/50 rounded-2xl border border-gray-100 dark:border-slate-700">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-slate-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7M4 6h16M4 10h16M4 14h16"></path>
                        </svg>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white">Aucun article</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Revenez bientôt pour découvrir nos nouvelles publications.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination (simple pour la home, on affichera le reste via la page blog) -->
                @if($recentPosts->hasPages())
                <div class="mt-10 pt-6 border-t border-gray-100 dark:border-slate-800">
                    {{ $recentPosts->links() }}
                </div>
                @endif
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-1 space-y-10">
                <!-- Search Widget -->
                <div class="bg-gray-50 dark:bg-slate-800/50 rounded-2xl p-6 border border-gray-100 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 font-serif">Recherche</h3>
                    <form action="#" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Rechercher un article..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border-gray-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm shadow-sm transition-all pb">
                        <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </form>
                </div>

                <!-- Categories Widget -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-800 overflow-hidden shadow-sm">
                    <div class="p-6 border-b border-gray-100 dark:border-slate-800 bg-gray-50/50 dark:bg-slate-800/30">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white font-serif">Catégories</h3>
                    </div>
                    <ul class="divide-y divide-gray-100 dark:divide-slate-800">
                        @foreach($categories as $category)
                        <li>
                            <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-slate-800/50 transition-colors group">
                                <span class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                    <span class="w-3 h-3 rounded-full" style="background-color: {{ $category->color }}"></span>
                                    {{ $category->name }}
                                </span>
                                <span class="bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-400 py-0.5 px-2.5 rounded-full text-xs font-semibold group-hover:bg-indigo-100 dark:group-hover:bg-indigo-900/50 group-hover:text-indigo-700 dark:group-hover:text-indigo-300 transition-colors">
                                    {{ $category->posts_count }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- About Widget -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-slate-800 dark:to-indigo-900/20 rounded-2xl p-6 border border-indigo-100 dark:border-indigo-500/20">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3 font-serif">À propos du Blog</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed mb-4">
                        Bienvenue sur Davy Blog. Je partage ici mes connaissances sur la stack Laravel, Vue.js, TailwindCSS et l'art de concevoir des applications web élégantes et rapides.
                    </p>
                    <a href="#" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 inline-flex items-center gap-1 group">
                        En savoir plus 
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
