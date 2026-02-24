@extends('layouts.main')

@section('title', $user->name)

@section('meta')
    <meta name="description" content="{{ Str::limit($user->bio, 160) }}">
    <meta property="og:title" content="{{ $user->name }} - Auteur sur {{ config('app.name') }}">
    <meta property="og:description" content="{{ Str::limit($user->bio, 160) }}">
    @if($user->avatar)
        <meta property="og:image" content="{{ asset('storage/' . $user->avatar) }}">
    @endif
@endsection

@section('content')
<!-- Author Profile Header -->
<div class="bg-surface-light dark:bg-surface-darker border-b border-gray-100 dark:border-white/5 pt-16 pb-24 md:pt-24 md:pb-32 relative overflow-hidden">
    <!-- Abstract Decor -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-primary-500/10 dark:bg-primary-500/20 blur-[100px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-accent-500/10 dark:bg-accent-500/10 blur-[80px] rounded-full pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-8 md:gap-12">
            <!-- Avatar -->
            <div class="relative shrink-0">
                <div class="w-32 h-32 md:w-48 md:h-48 rounded-[2rem] overflow-hidden shadow-soft dark:shadow-soft-dark border-4 border-white dark:border-surface-dark ring-1 ring-gray-100 dark:ring-white/5 bg-white dark:bg-surface-dark flex items-center justify-center">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-4xl md:text-6xl font-bold text-primary-500 uppercase">{{ substr($user->name, 0, 1) }}</span>
                    @endif
                </div>
                <!-- Badge Role -->
                <div class="absolute -bottom-2 right-4 px-4 py-1.5 bg-primary-600 text-white text-xs font-bold rounded-full shadow-glow">
                    {{ ucfirst($user->role) }}
                </div>
            </div>

            <!-- Info -->
            <div class="flex-1 text-center md:text-left pt-4">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white mb-6 font-serif tracking-tight">
                    {{ $user->name }}
                </h1>
                
                @if($user->bio)
                    <div class="prose prose-lg dark:prose-invert prose-primary mb-8 font-serif italic text-gray-600 dark:text-gray-300 leading-relaxed max-w-2xl mx-auto md:mx-0">
                        {!! nl2br(e($user->bio)) !!}
                    </div>
                @endif

                <!-- Links & Social -->
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
                    @if($user->website_url)
                        <a href="{{ $user->website_url }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/5 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 shadow-soft transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            Site Web
                        </a>
                    @endif

                    @if($user->twitter_url)
                        <a href="{{ $user->twitter_url }}" target="_blank" class="p-2.5 bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/5 rounded-xl text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 shadow-soft transition-all">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
                        </a>
                    @endif

                    @if($user->facebook_url)
                        <a href="{{ $user->facebook_url }}" target="_blank" class="p-2.5 bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/5 rounded-xl text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 shadow-soft transition-all">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path></svg>
                        </a>
                    @endif

                    @if($user->instagram_url)
                        <a href="{{ $user->instagram_url }}" target="_blank" class="p-2.5 bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/5 rounded-xl text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 shadow-soft transition-all">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.012 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.012 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.012-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07s-3.585-.015-4.85-.074c-1.17-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Author's Posts -->
<section class="py-16 lg:py-24 bg-surface-light dark:bg-surface-darker -mt-8 relative z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-12 font-serif flex items-center gap-4">
            <span class="w-12 h-1 bg-primary-500 rounded-full"></span>
            Articles publiés par {{ $user->name }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <article class="bg-white dark:bg-surface-dark rounded-[1.5rem] shadow-soft dark:shadow-soft-dark border border-gray-100 dark:border-white/5 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col h-full hover:-translate-y-1">
                <a href="{{ route('posts.show', $post) }}" class="relative h-52 w-full overflow-hidden bg-gray-100 dark:bg-surface-darker block shrink-0">
                    @if($post->cover_image)
                        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300 dark:text-slate-600">
                            <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent opacity-40"></div>
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400">
                            {{ $post->category->name }}
                        </span>
                        <time class="text-xs text-gray-500 dark:text-gray-400" datetime="{{ $post->published_at }}">
                            {{ $post->published_at->format('d M Y') }}
                        </time>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 font-serif line-clamp-2 leading-snug group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-6 flex-grow leading-relaxed">
                        {{ $post->excerpt }}
                    </p>
                    <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center text-primary-600 dark:text-primary-400 font-bold text-sm group/link">
                        Lire la suite
                        <svg class="ml-1 w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-20 px-6 rounded-[2rem] border-2 border-dashed border-gray-200 dark:border-white/10">
                <p class="text-gray-500 dark:text-gray-400 font-serif text-lg">Cet auteur n'a pas encore publié d'articles.</p>
            </div>
            @endforelse
        </div>

        @if($posts->hasPages())
        <div class="mt-12 pt-8">
            {{ $posts->links() }}
        </div>
        @endif

    </div>
</section>
@endsection
