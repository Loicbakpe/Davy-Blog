@extends('layouts.main')

@section('title', $post->title)

@section('meta')
@section('meta_description', $post->excerpt)
@section('og_type', 'article')
@section('og_title', $post->title . ' — Davy Blog')
@section('og_description', $post->excerpt)
@if($post->cover_image)
    @section('og_image', asset('storage/' . $post->cover_image))
@endif
    <meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
    <meta property="article:author" content="{{ $post->user->name }}">
    <meta property="article:section" content="{{ $post->category->name }}">
@endsection


@section('content')
<!-- En-tête de l'article avec effet visuel -->
<div class="relative w-full overflow-hidden bg-surface-darker pt-16">
    @if($post->cover_image)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-40 blur-sm scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-surface-darker via-surface-darker/80 to-transparent"></div>
        </div>
    @else
        <!-- Fallback pattern -->
        <div class="absolute inset-0 z-0 opacity-20 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LSAyNTUtIDI1NSwgMC4wNSkiLz48L3N2Zz4=')]"></div>
    @endif

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-16 pb-12 lg:pt-24 lg:pb-16 text-center">
        <!-- Catégorie -->
        <a href="{{ route('categories.show', $post->category) }}" class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold shadow-soft mb-8 bg-surface-dark/50 backdrop-blur-md border border-white/10 hover:bg-surface-dark transition-colors" style="color: {{ $post->category->color }}">
            <span class="w-2.5 h-2.5 rounded-full mr-2 shadow-sm" style="background-color: {{ $post->category->color }}"></span>
            {{ $post->category->name }}
        </a>
        
        <!-- Titre -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-8 font-serif leading-tight tracking-tight shadow-sm">{{ $post->title }}</h1>
        
        <!-- Méta Infos -->
        <div class="flex flex-wrap items-center justify-center gap-6 text-sm text-gray-300 font-medium">
                <a href="{{ route('authors.show', $post->user) }}" class="flex items-center gap-3 bg-surface-dark/50 px-4 py-2 rounded-2xl backdrop-blur-sm border border-white/5 hover:bg-surface-dark transition-colors">
                    <div class="h-8 w-8 rounded-full bg-primary-900/50 flex items-center justify-center text-primary-300 font-bold border border-white/10 overflow-hidden">
                        @if($post->user->avatar)
                            <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="{{ $post->user->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($post->user->name, 0, 1) }}
                        @endif
                    </div>
                    <span class="text-white">{{ $post->user->name }}</span>
                </a>
            
            <div class="flex items-center gap-6 bg-surface-dark/50 px-5 py-2 rounded-2xl backdrop-blur-sm border border-white/5">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <time datetime="{{ $post->published_at }}">{{ $post->published_at->format('d M Y') }}</time>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <span>{{ ceil(str_word_count(strip_tags($post->body)) / 200) }} min</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <span>{{ number_format($post->views) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-surface-light dark:bg-surface-darker pb-20 pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            <!-- Colonne Principale (Image, Contenu, Commentaires) -->
            <div class="lg:col-span-8 lg:w-2/3 max-w-4xl mx-auto w-full">
                
                <!-- Image de couverture (Clean, intégrée différemment de la vignette floue) -->
                @if($post->cover_image)
                    <div class="w-full h-80 md:h-[30rem] rounded-3xl overflow-hidden shadow-soft dark:shadow-soft-dark border border-gray-100 dark:border-white/5 mb-12 -mt-16 relative z-20">
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <!-- Excerpt (Mise en avant) -->
                <div class="text-xl md:text-2xl text-gray-700 dark:text-gray-300 font-serif leading-relaxed italic mb-10 pl-6 border-l-4 border-primary-500">
                    {{ $post->excerpt }}
                </div>

                <!-- Corps de l'article -->
                <div class="prose prose-lg md:prose-xl dark:prose-invert prose-primary max-w-none prose-img:rounded-2xl prose-headings:font-serif prose-a:text-primary-600 dark:prose-a:text-primary-400 mb-16">
                    {!! str($post->body)->markdown() !!}
                </div>

                <!-- À propos de l'auteur -->
                <div class="bg-gray-50 dark:bg-surface-dark rounded-3xl p-8 md:p-10 border border-gray-100 dark:border-white/5 mb-16 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 rounded-full blur-3xl -mr-10 -mt-10"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start gap-8">
                        <div class="shrink-0">
                            <div class="w-24 h-24 rounded-2xl overflow-hidden shadow-soft border-4 border-white dark:border-surface-dark bg-white dark:bg-surface-dark flex items-center justify-center">
                                @if($post->user->avatar)
                                    <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="{{ $post->user->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-3xl font-bold text-primary-500 uppercase">{{ substr($post->user->name, 0, 1) }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <span class="text-xs font-bold text-primary-600 dark:text-primary-400 uppercase tracking-widest mb-2 block">À propos de l'auteur</span>
                            <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-3 font-serif line-clamp-1">
                                <a href="{{ route('authors.show', $post->user) }}" class="hover:text-primary-600 transition-colors">{{ $post->user->name }}</a>
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400 mb-6 font-serif italic line-clamp-3">
                                {{ $post->user->bio ?? "Passionnée par les mots et les histoires qui voyagent." }}
                            </p>
                            <a href="{{ route('authors.show', $post->user) }}" class="inline-flex items-center text-sm font-bold text-primary-600 dark:text-primary-400 hover:gap-2 transition-all">
                                Voir tous ses articles
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer de l'article : Tags et Partage -->
                <div class="flex flex-col sm:flex-row items-center justify-between py-6 border-t border-b border-gray-100 dark:border-white/5 mb-16 gap-6">
                    <!-- Tags -->
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm font-bold text-gray-900 dark:text-white mr-2 uppercase tracking-wide">Tags :</span>
                        @forelse($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag) }}" class="inline-flex items-center px-3 py-1 bg-gray-50 dark:bg-surface-dark border border-gray-200 dark:border-white/5 text-gray-600 dark:text-gray-400 text-xs font-semibold rounded-lg hover:border-primary-500 hover:text-primary-600 transition-colors">
                                #{{ $tag->name }}
                            </a>
                        @empty
                            <span class="text-sm text-gray-500 italic">Aucun tag</span>
                        @endforelse
                    </div>

                    <!-- Boutons Partage -->
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-gray-900 dark:text-white mr-2 uppercase tracking-wide">Partager :</span>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-50 dark:bg-surface-dark border border-gray-200 dark:border-white/5 flex items-center justify-center text-gray-500 hover:text-blue-500 hover:border-blue-500 transition-all" title="Partager sur Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-50 dark:bg-surface-dark border border-gray-200 dark:border-white/5 flex items-center justify-center text-gray-500 hover:text-blue-700 hover:border-blue-700 transition-all" title="Partager sur Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Section des commentaires -->
                <div id="comments" class="scroll-mt-24">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white font-serif mb-8 flex items-center gap-3">
                        Commentaires
                        <span class="bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300 px-3 py-1 rounded-xl text-base font-bold">{{ $post->comments->count() }}</span>
                    </h2>

                    <!-- Formulaire -->
                    @auth
                        @if(session('status'))
                            <div class="bg-green-50 dark:bg-green-900/20 text-green-800 dark:text-green-300 p-4 rounded-xl mb-6 flex items-center gap-3 border border-green-200 dark:border-green-800/50">
                                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-soft dark:shadow-soft-dark border border-gray-100 dark:border-white/5 mb-10">
                            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="body" class="sr-only">Votre commentaire</label>
                                    <textarea id="body" name="body" rows="3" required class="w-full rounded-xl border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-surface-darker text-gray-900 dark:text-white focus:ring-primary-500 focus:border-primary-500 placeholder-gray-400 resize-none shadow-sm" placeholder="Partagez vos impressions..."></textarea>
                                    @error('body')
                                        <p class="text-accent-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-xl font-bold text-sm shadow-md hover:bg-primary-700 transition-colors">Publier le commentaire</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="bg-gray-50 dark:bg-surface-dark rounded-2xl p-8 border border-gray-100 dark:border-white/5 text-center mb-10">
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Rejoignez la discussion avec la communauté Davy Blog.</p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ route('login') }}" class="px-6 py-2.5 bg-white xl:bg-surface-darker text-gray-900 dark:text-white border border-gray-200 dark:border-white/10 shadow-sm rounded-xl font-medium hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                    Se connecter
                                </a>
                                <a href="{{ route('register') }}" class="px-6 py-2.5 bg-primary-600 text-white rounded-xl font-bold shadow-[0_4px_14px_0_rgba(124,58,237,0.39)] hover:bg-primary-700 transition-colors">
                                    Créer un compte
                                </a>
                            </div>
                        </div>
                    @endauth

                    <!-- Liste des commentaires -->
                    <div class="space-y-6">
                        @forelse($post->comments as $comment)
                        <div class="bg-white dark:bg-surface-dark p-6 rounded-2xl border border-gray-100 dark:border-white/5 shadow-soft dark:shadow-soft-dark">
                            <div class="flex items-center gap-4 mb-4 border-b border-gray-50 dark:border-white/5 pb-4">
                                <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-700 dark:text-primary-300 font-bold border border-white dark:border-surface-dark ring-2 ring-transparent">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">{{ $comment->user->name }}</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">il y a {{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="prose prose-sm dark:prose-invert text-gray-700 dark:text-gray-300">
                                <p>{{ $comment->body }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12 text-gray-500 dark:text-gray-400 italic">
                            Soyez le premier à commenter cet article.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Colonne Latérale (Articles Relatifs) -->
            <div class="lg:col-span-4 lg:w-1/3 space-y-8 mt-16 lg:mt-0">
                <div class="sticky top-28 bg-white dark:bg-surface-dark rounded-3xl p-6 sm:p-8 border border-gray-100 dark:border-white/5 shadow-soft dark:shadow-soft-dark">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 font-serif">Dans la même catégorie</h3>
                    
                    @if($relatedPosts->count() > 0)
                        <div class="flex flex-col gap-6">
                            @foreach($relatedPosts as $related)
                            <a href="{{ route('posts.show', $related) }}" class="group block border-b border-gray-100 dark:border-white/5 pb-6 last:border-0 last:pb-0">
                                <h4 class="font-bold text-gray-900 dark:text-white mb-2 leading-snug group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                    {{ $related->title }}
                                </h4>
                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                    <time>{{ $related->published_at->format('d/m/Y') }}</time>
                                    <span class="mx-2">&bull;</span>
                                    <span>{{ $related->views }} vues</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-100 dark:border-white/5 text-center">
                            <a href="{{ route('categories.show', $post->category) }}" class="text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-700 transition flex items-center justify-center gap-1 group">
                                Voir plus de {{ $post->category->name }}
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                            Aucun autre article dans cette catégorie pour le moment.
                        </p>
                    @endif
            </div>

        </div>
    </div>
</div>
@endsection
