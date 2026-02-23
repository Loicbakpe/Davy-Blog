@extends('layouts.main')

@section('title', 'Le Blog')

@section('content')
<div class="bg-indigo-50 dark:bg-slate-800/50 border-b border-indigo-100 dark:border-slate-800 py-12 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white font-serif mb-4">Le Blog</h1>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            @if(request('q'))
                Résultats de recherche pour "<span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ request('q') }}</span>"
            @else
                Tous nos articles, tutoriels et réflexions sur le développement web et l'écosystème Laravel.
            @endif
        </p>
    </div>
</div>

<div class="bg-gray-50 dark:bg-slate-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <!-- Liste des articles (Gauche) -->
            <div class="lg:w-2/3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($posts as $post)
                    <article class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-slate-700 overflow-hidden transition-all duration-300 group flex flex-col h-full">
                        <a href="{{ route('posts.show', $post) }}" class="block relative h-56 w-full overflow-hidden bg-gray-200 dark:bg-slate-700">
                            @if($post->cover_image)
                                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-slate-500">
                                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 ring-1 ring-inset ring-black/10 dark:ring-white/10"></div>
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold backdrop-blur-md bg-white/90 dark:bg-slate-900/90 shadow-sm" style="color: {{ $post->category->color }}">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </a>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-3">
                                <time datetime="{{ $post->published_at }}">{{ $post->published_at->format('d M Y') }}</time>
                                <span>&bull;</span>
                                <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>{{ $post->comments_count }}</span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-serif line-clamp-2 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </h2>
                            <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-6 flex-grow leading-relaxed">
                                {{ $post->excerpt }}
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100 dark:border-slate-700">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-slate-700 flex items-center justify-center text-indigo-700 dark:text-indigo-400 font-bold text-sm">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <span class="ml-2 text-sm font-medium text-gray-900 dark:text-white">{{ $post->user->name }}</span>
                                </div>
                                <a href="{{ route('posts.show', $post) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                                    Lire &rarr;
                                </a>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-full py-16 text-center bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-2xl">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-slate-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7M4 6h16M4 10h16M4 14h16"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Aucun article trouvé</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">Essayez de modifier votre recherche ou revenez plus tard.</p>
                        @if(request('q'))
                            <div class="mt-6">
                                <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Voir tous les articles
                                </a>
                            </div>
                        @endif
                    </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Sidebar (Droite) -->
            <div class="lg:w-1/3 space-y-8">
                
                <!-- Search -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 font-serif">Recherche</h3>
                    <form action="{{ route('posts.index') }}" method="GET" class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm shadow-sm transition-all">
                        <svg class="absolute left-3 top-3 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </form>
                </div>

                <!-- Categories -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-700 overflow-hidden shadow-sm">
                    <div class="p-6 border-b border-gray-100 dark:border-slate-700 bg-gray-50/50 dark:bg-slate-800/30">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white font-serif">Catégories</h3>
                    </div>
                    <ul class="divide-y divide-gray-100 dark:divide-slate-700">
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('categories.show', $category) }}" class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors group">
                                <span class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                    <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $category->color }}"></span>
                                    {{ $category->name }}
                                </span>
                                <span class="bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-400 py-0.5 px-2.5 rounded-full text-xs font-semibold group-hover:bg-indigo-100 dark:group-hover:bg-indigo-900/50 group-hover:text-indigo-700 dark:group-hover:text-indigo-300 transition-colors">
                                    {{ $category->posts_count }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tags -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-gray-100 dark:border-slate-700 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 font-serif">Tags Populaires</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                        <a href="{{ route('tags.show', $tag) }}" class="inline-block px-3 py-1.5 bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-gray-300 text-sm rounded-lg hover:bg-indigo-100 hover:text-indigo-700 dark:hover:bg-indigo-900/50 dark:hover:text-indigo-300 transition-colors">
                            #{{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
