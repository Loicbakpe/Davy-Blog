@extends('layouts.main')

@section('title', $post->title)

@section('meta')
    <meta name="description" content="{{ Str::limit($post->excerpt, 150) }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ Str::limit($post->excerpt, 150) }}">
    @if($post->cover_image)
        <meta property="og:image" content="{{ asset('storage/' . $post->cover_image) }}">
    @endif
@endsection

@section('content')
<!-- Article Header -->
<div class="relative w-full h-64 md:h-96 lg:h-[32rem] bg-gray-900 overflow-hidden">
    @if($post->cover_image)
        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover opacity-60">
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 to-slate-900 opacity-90"></div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
    
    <div class="absolute inset-0 flex flex-col justify-end">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full pb-12 md:pb-16 pt-32">
            <div class="flex items-center gap-3 mb-6">
                <a href="{{ route('categories.show', $post->category) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/20 backdrop-blur-md text-white hover:bg-white/30 transition-colors" style="border-left: 4px solid {{ $post->category->color }}">
                    {{ $post->category->name }}
                </a>
                <span class="text-gray-300 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ ceil(str_word_count(strip_tags($post->body)) / 200) }} min de lecture
                </span>
                <span class="text-gray-300 text-sm flex items-center gap-2 ml-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    {{ $post->views }} vues
                </span>
            </div>
            
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 font-serif leading-tight">
                {{ $post->title }}
            </h1>
            
            <div class="flex items-center text-gray-200">
                <div class="h-12 w-12 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-lg border-2 border-white/20">
                    {{ substr($post->user->name, 0, 1) }}
                </div>
                <div class="ml-4">
                    <p class="font-medium text-white text-lg">{{ $post->user->name }}</p>
                    <p class="text-sm text-gray-400">Publié le {{ $post->published_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-slate-900 py-16 -mt-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 bg-white dark:bg-slate-900 relative z-20 rounded-t-3xl pt-8">
        
        <!-- Extrait -->
        <div class="text-xl md:text-2xl text-gray-500 dark:text-gray-400 font-serif italic mb-12 leading-relaxed border-l-4 border-indigo-500 pl-6 py-2">
            {{ $post->excerpt }}
        </div>

        <!-- Corps de l'article -->
        <article class="prose prose-lg md:prose-xl dark:prose-invert prose-indigo mx-auto font-serif">
            {!! nl2br(e($post->body)) !!}
        </article>

        <!-- Tags -->
        @if($post->tags->count() > 0)
        <div class="mt-16 pt-8 border-t border-gray-100 dark:border-slate-800 flex flex-wrap gap-2 items-center">
            <span class="text-sm font-semibold text-gray-900 dark:text-white mr-2 uppercase tracking-wider">Tags :</span>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', $tag) }}" class="px-3 py-1 bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-gray-300 text-sm rounded-full hover:bg-indigo-100 dark:hover:bg-indigo-900 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
        @endif

        <!-- Partage (Faux liens pour l'instant) -->
        <div class="mt-10 flex gap-4">
            <button class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
            </button>
            <button class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-800 text-white hover:bg-blue-900 transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
            </button>
        </div>

    </div>
</div>

<!-- Section Commentaires -->
<div class="bg-gray-50 dark:bg-slate-800/50 py-16 border-t border-gray-100 dark:border-slate-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 font-serif">Commentaires ({{ $post->comments->count() }})</h3>

        <!-- Formulaire -->
        @auth
            @if(session('status'))
                <div class="bg-green-50 dark:bg-green-900/20 text-green-800 dark:text-green-300 p-4 rounded-xl mb-6 flex items-center gap-3 border border-green-200 dark:border-green-800/50">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('status') }}
                </div>
            @endif
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-700 mb-10">
                <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Votre commentaire</label>
                        <textarea id="body" name="body" rows="3" required class="w-full rounded-xl border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 placeholder-gray-400" placeholder="Partagez vos impressions..."></textarea>
                        @error('body')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-full font-medium shadow-sm hover:bg-indigo-700 transition">Publier</button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-2xl p-6 border border-indigo-100 dark:border-indigo-500/30 mb-10 text-center">
                <p class="text-indigo-800 dark:text-indigo-300 mb-4">Vous devez être connecté pour laisser un commentaire.</p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-white dark:bg-slate-800 text-indigo-600 dark:text-indigo-400 border border-indigo-200 dark:border-slate-600 rounded-full font-medium hover:bg-gray-50 dark:hover:bg-slate-700 transition">Connexion</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-indigo-600 text-white rounded-full font-medium hover:bg-indigo-700 transition">Inscription</a>
                </div>
            </div>
        @endauth

        <!-- Liste -->
        <div class="space-y-6">
            @forelse($post->comments as $comment)
                <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-700">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-slate-700 flex items-center justify-center text-gray-600 dark:text-gray-300 font-bold">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $comment->user->name }}</p>
                                <time class="text-xs text-gray-500 dark:text-gray-400" datetime="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</time>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $comment->body }}</p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400 italic">Aucun commentaire pour l'instant. Soyez le premier !</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Articles Similaires -->
@if($relatedPosts->count() > 0)
<div class="bg-white dark:bg-slate-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 font-serif text-center">Vous aimerez aussi</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedPosts as $related)
            <article class="group">
                <a href="{{ route('posts.show', $related) }}" class="block relative h-48 w-full rounded-2xl overflow-hidden bg-gray-200 dark:bg-slate-800 mb-4">
                    @if($related->cover_image)
                        <img src="{{ asset('storage/' . $related->cover_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-slate-600">
                            <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold backdrop-blur-md bg-white/90 shadow-sm" style="color: {{ $related->category->color }}">
                            {{ $related->category->name }}
                        </span>
                    </div>
                </a>
                <h4 class="text-lg font-bold text-gray-900 dark:text-white font-serif group-hover:text-indigo-600 transition-colors line-clamp-2">
                    <a href="{{ route('posts.show', $related) }}">{{ $related->title }}</a>
                </h4>
            </article>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection
