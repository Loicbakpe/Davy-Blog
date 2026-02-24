@extends('layouts.main')

@section('title', 'Accueil')

@section('content')
<!-- Hero Section -->
<section class="relative bg-surface-light dark:bg-surface-darker overflow-hidden border-b border-gray-100 dark:border-white/5">
    <!-- Abstract Background Pattern (Subtle & Elegant) -->
    <div class="absolute inset-0 pointer-events-none w-full h-full overflow-hidden z-0">
        <!-- Glow accents -->
        <div class="absolute -top-32 -right-32 w-[30rem] h-[30rem] bg-primary-400/10 dark:bg-primary-600/20 blur-[100px] rounded-full mix-blend-multiply dark:mix-blend-screen"></div>
        <div class="absolute top-1/2 -left-32 w-[25rem] h-[25rem] bg-accent-400/10 dark:bg-accent-600/10 blur-[80px] rounded-full mix-blend-multiply dark:mix-blend-screen"></div>
        <!-- Dot pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMTMyLSAxNy0gMjExLCAwLjA1KSIvPjwvc3ZnPg==')] dark:bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LSAyNTUtIDI1NSwgMC4wNSkiLz48L3N2Zz4=')] [mask-image:linear-gradient(to_bottom,white,transparent)] z-0"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20 pb-28 md:pt-32 md:pb-40 flex flex-col items-center text-center">
        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold shadow-soft mb-6 bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/5 mx-auto text-primary-600 dark:text-primary-400 font-serif italic">
            Bienvenue dans mon univers
        </span>
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-6 font-serif max-w-4xl leading-[1.1]">
            Fragments de vie et <br class="hidden sm:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-500">Chroniques Romanesques</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 mb-10 font-serif italic leading-relaxed max-w-2xl text-center">
            Installez-vous confortablement. Découvrez mes inspirations, plongez dans l'envers du décor de l'écriture et suivez l'actualité de mes parutions.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center w-full sm:w-auto">
            <a href="#recent-posts" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-medium rounded-2xl text-white bg-primary-600 hover:bg-primary-700 shadow-[0_4px_14px_0_rgba(124,58,237,0.39)] hover:shadow-[0_6px_20px_rgba(124,58,237,0.23)] hover:-translate-y-0.5 transition-all duration-200">
                Explorer les articles
            </a>
            <a href="{{ route('about') }}" class="inline-flex justify-center items-center px-8 py-4 border border-gray-200 dark:border-white/10 text-base font-medium rounded-2xl text-gray-700 dark:text-gray-200 bg-white/50 dark:bg-surface-dark/50 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-white/5 transition-all duration-200">
                En savoir plus
            </a>
        </div>
    </div>
</section>

<!-- Featured Posts -->
@if($featuredPosts->count() > 0)
<section class="py-20 bg-gray-50/50 dark:bg-surface-dark/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white font-serif tracking-tight">À la une</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Notre sélection des articles incontournables.</p>
            </div>
            <div class="mt-4 md:mt-0 hidden md:block">
                <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-700 transition flex items-center gap-1 group">
                    Tous les articles <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredPosts as $post)
            <article class="bg-white dark:bg-surface-dark rounded-[1.5rem] shadow-soft dark:shadow-soft-dark border border-gray-100 dark:border-white/5 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col h-full hover:-translate-y-1">
                <div class="relative h-56 lg:h-64 w-full overflow-hidden bg-gray-100 dark:bg-surface-darker">
                    @if($post->cover_image)
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                    @endif
                    <!-- Overlay Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-gray-900/0 to-transparent opacity-60"></div>
                    <div class="absolute top-4 left-4 z-10">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/90 dark:bg-surface-dark/90 backdrop-blur text-gray-900 dark:text-white shadow-sm ring-1 ring-black/5 dark:ring-white/10">
                            <span class="w-2 h-2 rounded-full mr-2" style="background-color: {{ $post->category->color }}"></span>
                            {{ $post->category->name }}
                        </span>
                    </div>
                </div>
                <div class="p-6 md:p-8 flex flex-col flex-grow relative">
                    <div class="text-xs font-medium text-primary-600 dark:text-primary-400 mb-3 flex items-center justify-between">
                        <span>{{ $post->published_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-3 font-serif line-clamp-2 leading-snug group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                        <a href="{{ route('posts.show', $post) }}"><span class="absolute inset-0"></span>{{ $post->title }}</a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-6 flex-grow leading-relaxed">
                        {{ $post->excerpt }}
                    </p>
                    <div class="flex items-center mt-auto pt-4 relative z-20 pointer-events-none">
                        <div class="h-10 w-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-700 dark:text-primary-300 font-bold text-sm ring-2 ring-white dark:ring-surface-dark">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ ceil(str_word_count(strip_tags($post->body)) / 200) }} min de lecture</p>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Main Content Grid -->
<section id="recent-posts" class="py-20 lg:py-28 bg-surface-light dark:bg-surface-darker">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            
            <!-- Left Column: Recent Posts -->
            <div class="lg:col-span-8">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white font-serif tracking-tight">Dernières publications</h2>
                </div>

                <div class="space-y-8">
                    @forelse($recentPosts as $post)
                    <article class="group relative flex flex-col sm:flex-row gap-6 items-start p-4 sm:p-6 rounded-[1.5rem] bg-white dark:bg-surface-dark border border-transparent hover:border-gray-100 dark:hover:border-white/5 hover:shadow-soft dark:hover:shadow-soft-dark transition-all duration-300">
                        <div class="w-full sm:w-48 h-48 sm:h-auto sm:aspect-square shrink-0">
                            <div class="relative w-full h-full rounded-2xl overflow-hidden bg-gray-100 dark:bg-surface-darker">
                                @if($post->cover_image)
                                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 dark:text-slate-600">
                                        <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 ring-1 ring-inset ring-black/5 dark:ring-white/10 rounded-2xl"></div>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center h-full">
                            <div class="flex items-center gap-3 text-xs font-semibold tracking-wide uppercase text-gray-500 dark:text-gray-400 mb-3">
                                <span style="color: {{ $post->category->color }}">{{ $post->category->name }}</span>
                                <span>&bull;</span>
                                <time datetime="{{ $post->published_at }}">{{ $post->published_at->format('d M, Y') }}</time>
                            </div>
                            <h3 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white mb-3 font-serif leading-snug group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                <a href="{{ route('posts.show', $post) }}"><span class="absolute inset-0"></span>{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2 leading-relaxed mb-4">
                                {{ $post->excerpt }}
                            </p>
                            <div class="mt-auto flex items-center gap-2">
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $post->user->name }}</span>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="text-center py-20 px-6 rounded-[2rem] border-2 border-dashed border-gray-200 dark:border-white/10">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white font-serif">Aucun texte pour l'instant.</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">Revenez très bientôt pour découvrir mes prochains récits.</p>
                    </div>
                    @endforelse
                </div>

                @if($recentPosts->hasPages())
                <div class="mt-12 pt-8">
                    {{ $recentPosts->links() }}
                </div>
                @endif
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-4 space-y-10">
                <!-- Search Widget -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <form action="{{ route('posts.index') }}" method="GET">
                        <input type="text" name="q" placeholder="Rechercher un article..." class="block w-full pl-11 pr-4 py-3.5 border-none rounded-2xl bg-white dark:bg-surface-dark shadow-soft dark:shadow-soft-dark text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-primary-500 transition-shadow text-sm">
                    </form>
                </div>

                <!-- Categories -->
                <div class="bg-white dark:bg-surface-dark rounded-3xl shadow-soft dark:shadow-soft-dark border border-gray-50 dark:border-white/5 overflow-hidden p-1">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white px-5 pt-6 pb-4 font-serif">Catégories</h3>
                    <ul class="space-y-1 p-2">
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('categories.show', $category) }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                                <span class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                    <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $category->color }}"></span>
                                    {{ $category->name }}
                                </span>
                                <span class="bg-gray-100 dark:bg-surface-darker text-gray-500 dark:text-gray-400 py-1 px-3 rounded-lg text-xs font-semibold group-hover:bg-primary-50 group-hover:text-primary-600 dark:group-hover:bg-primary-900/20 transition-colors">
                                    {{ $category->posts_count }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Newsletter Widget -->
                <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-8 text-white relative overflow-hidden shadow-glow">
                    <!-- Decor -->
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10 blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-accent-400 opacity-20 blur-xl"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-3 font-serif">Le Club des Lecteurs</h3>
                        <p class="text-primary-100 text-sm mb-6 leading-relaxed">
                            Restez informé(e) de mes prochaines sorties littéraires, des séances de dédicaces exclusives, et plongez dans les coulisses de l'écriture en rejoignant la communauté.
                        </p>
                        <form action="{{ route('newsletter.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <input type="email" name="email" required placeholder="votre@email.com" class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-primary-200 focus:ring-2 focus:ring-white focus:border-transparent text-sm backdrop-blur-sm">
                            </div>
                            <button type="submit" class="w-full bg-white text-primary-700 hover:bg-primary-50 px-4 py-3 rounded-xl text-sm font-bold transition-colors shadow-sm">
                                Je m'abonne
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
