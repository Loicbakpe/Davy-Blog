@extends('layouts.main')

@section('title', 'Le Blog')

@section('content')
<!-- Header Page -->
<div class="bg-surface-light dark:bg-surface-darker border-b border-gray-100 dark:border-white/5 pt-12 pb-20 relative overflow-hidden">
    <!-- Abstract Decor -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-primary-500/10 dark:bg-primary-500/20 blur-[100px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent-500/10 dark:bg-accent-500/10 blur-[80px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white mb-6 font-serif tracking-tight">Le Blog</h1>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
            Découvrez mes chroniques, réflexions et fragments d'écriture. Entrez dans l'univers d'une plume qui raconte le monde.
        </p>
    </div>
</div>

<section class="py-16 lg:py-24 bg-surface-light dark:bg-surface-darker -mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            
            <!-- Contenu principal (Liste des articles) -->
            <div class="lg:col-span-8">
                
                <!-- Barre d'outils (Recherche texte & Stats) -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4 bg-white dark:bg-surface-dark rounded-[1.5rem] p-4 sm:p-6 shadow-soft dark:shadow-soft-dark border border-gray-100 dark:border-white/5">
                    <div class="text-gray-600 dark:text-gray-400 font-medium text-sm">
                        <span class="text-gray-900 dark:text-white font-bold bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300 px-3 py-1 rounded-lg">{{ $posts->total() }}</span> articles publiés
                    </div>
                    
                    <form action="{{ route('posts.index') }}" method="GET" class="w-full sm:w-auto flex-grow max-w-sm relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Ex: Vite, Eloquent..." class="block w-full pl-10 pr-4 py-2.5 border-none rounded-xl bg-gray-50 dark:bg-surface-darker text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-primary-500 text-sm transition-shadow shadow-inner mix-blend-multiply dark:mix-blend-normal">
                        @if(request('q'))
                            <a href="{{ route('posts.index') }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </a>
                        @endif
                    </form>
                </div>

                @if(request('q'))
                    <div class="mb-10 p-4 bg-primary-50 dark:bg-primary-900/20 text-primary-800 dark:text-primary-200 rounded-2xl flex items-center gap-3 border border-primary-100 dark:border-primary-800/30">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Résultats pour la recherche : <strong>"{{ request('q') }}"</strong></span>
                    </div>
                @endif

                <!-- Grille des articles -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($posts as $post)
                    <article class="bg-white dark:bg-surface-dark rounded-[1.5rem] shadow-soft dark:shadow-soft-dark border border-gray-100 dark:border-white/5 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col h-full hover:-translate-y-1">
                        <a href="{{ route('posts.show', $post) }}" class="relative h-56 w-full overflow-hidden bg-gray-100 dark:bg-surface-darker block shrink-0">
                            @if($post->cover_image)
                                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300 dark:text-slate-600">
                                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent opacity-60"></div>
                            <div class="absolute top-4 left-4 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/90 dark:bg-surface-dark/90 backdrop-blur text-gray-900 dark:text-white shadow-sm ring-1 ring-black/5 dark:ring-white/10">
                                    <span class="w-2 h-2 rounded-full mr-2" style="background-color: {{ $post->category->color }}"></span>
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </a>
                        <div class="p-6 md:p-8 flex flex-col flex-grow relative">
                            <div class="text-xs font-medium text-primary-600 dark:text-primary-400 mb-3 flex items-center justify-between">
                                <time datetime="{{ $post->published_at }}">{{ $post->published_at->format('d M Y') }}</time>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-3 font-serif line-clamp-2 leading-snug group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                <a href="{{ route('posts.show', $post) }}"><span class="absolute inset-0"></span>{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-6 flex-grow leading-relaxed">
                                {{ $post->excerpt }}
                            </p>
                            
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50 dark:border-white/5 relative z-20 pointer-events-none">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-700 dark:text-primary-400 font-bold text-xs ring-2 ring-white dark:ring-surface-dark">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $post->user->name }}</span>
                                </div>
                                <div class="flex items-center text-gray-400 dark:text-gray-500 text-xs">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    {{ $post->comments_count }}
                                </div>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full text-center py-20 px-6 rounded-[2rem] border-2 border-dashed border-gray-200 dark:border-white/10">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-slate-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7M4 6h16M4 10h16M4 14h16"></path></svg>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white font-serif">Aucun article trouvé.</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">Essayez de modifier vos critères de recherche.</p>
                        @if(request('q'))
                            <a href="{{ route('posts.index') }}" class="mt-4 inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-xl text-primary-700 bg-primary-100 hover:bg-primary-200 dark:bg-primary-900/30 dark:text-primary-300 dark:hover:bg-primary-900/50 transition">
                                Effacer la recherche
                            </a>
                        @endif
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                <div class="mt-12 pt-8">
                    {{ $posts->links() }}
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-10">
                <!-- Navigation des catégories (Pills) -->
                <div>
                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-4">Filtrer par catégorie</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category) }}" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-white dark:bg-surface-dark border border-gray-200 dark:border-white/10 text-gray-700 dark:text-gray-300 hover:border-primary-300 hover:text-primary-600 dark:hover:border-primary-500/30 dark:hover:text-primary-400 shadow-sm transition-all group">
                                <span class="w-2 h-2 rounded-full mr-2" style="background-color: {{ $category->color }}"></span>
                                {{ $category->name }}
                                <span class="ml-2 text-xs text-gray-400 dark:text-gray-500 group-hover:text-primary-500">({{ $category->posts_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Nuage de tags -->
                <div class="bg-gray-50 dark:bg-surface-dark rounded-[2rem] p-8 border border-gray-100 dark:border-white/5">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 font-serif">Tags populaires</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('tags.show', $tag) }}" class="inline-flex items-center px-3 py-1.5 bg-white dark:bg-surface-darker text-gray-600 dark:text-gray-400 text-xs font-medium rounded-lg border border-gray-200 dark:border-white/5 hover:border-primary-500 hover:text-primary-600 dark:hover:border-primary-500 dark:hover:text-primary-400 transition-colors shadow-sm">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- Newsletter Minimaliste -->
                <div class="bg-white dark:bg-surface-dark rounded-[2rem] p-8 border border-primary-100 dark:border-primary-900/30 shadow-soft dark:shadow-soft-dark text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-50 dark:bg-primary-900/10 rounded-full blur-2xl -mr-10 -mt-10 pointer-events-none"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 font-serif">Ne manquez rien</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Inscrivez-vous à notre newsletter mensuelle.</p>
                        <form class="space-y-3">
                            <input type="email" placeholder="votre@email.com" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-white/10 dark:bg-surface-darker focus:ring-2 focus:ring-primary-500 text-sm outline-none">
                            <button type="submit" class="w-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-primary-600 dark:hover:bg-primary-500 px-4 py-3 rounded-xl text-sm font-bold transition-colors">S'inscrire</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
