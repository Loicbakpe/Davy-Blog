@extends('layouts.main')

@section('title', 'Catégorie : ' . $category->name)

@section('content')
<!-- Header Catégorie -->
<div class="bg-surface-light dark:bg-surface-darker border-b border-gray-100 dark:border-white/5 pt-12 pb-20 relative overflow-hidden" style="--category-color: {{ $category->color }};">
    <!-- Abstract Decor based on category color -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 blur-[100px] rounded-full pointer-events-none opacity-10 dark:opacity-20" style="background-color: var(--category-color);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold shadow-soft mb-6 bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/5 mx-auto" style="color: {{ $category->color }}">
            Catégorie
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white mb-6 font-serif tracking-tight flex items-center justify-center gap-4">
            <span class="w-4 h-4 rounded-full shadow-sm" style="background-color: {{ $category->color }}"></span>
            {{ $category->name }}
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
            @if($category->description)
                {{ $category->description }}
            @else
                Explorez tous nos articles concernant {{ $category->name }}.
            @endif
        </p>
    </div>
</div>

<section class="py-16 lg:py-24 bg-surface-light dark:bg-surface-darker -mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12">
            <!-- Main Content -->
            <div class="lg:col-span-8">
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-10">
                <!-- Navigation des catégories (Pills) -->
                <div>
                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-4">Filtrer par catégorie</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $cat)
                            <a href="{{ route('categories.show', $cat) }}" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium {{ $category->id === $cat->id ? 'bg-primary-50 dark:bg-primary-900/40 border-primary-200 dark:border-primary-500/50 text-primary-700 dark:text-primary-300' : 'bg-white dark:bg-surface-dark border-gray-200 dark:border-white/10 text-gray-700 dark:text-gray-300 hover:border-primary-300 hover:text-primary-600 dark:hover:border-primary-500/30 dark:hover:text-primary-400' }} border shadow-sm transition-all group">
                                <span class="w-2 h-2 rounded-full mr-2" style="background-color: {{ $cat->color }}"></span>
                                {{ $cat->name }}
                                <span class="ml-2 text-xs {{ $category->id === $cat->id ? 'text-primary-500 dark:text-primary-400' : 'text-gray-400 dark:text-gray-500 group-hover:text-primary-500' }}">({{ $cat->posts_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Nuage de tags -->
                <div class="bg-gray-50 dark:bg-surface-dark rounded-[2rem] p-8 border border-gray-100 dark:border-white/5">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 font-serif">Tags populaires</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $t)
                            <a href="{{ route('tags.show', $t) }}" class="inline-flex items-center px-3 py-1.5 bg-white dark:bg-surface-darker text-gray-600 dark:text-gray-400 text-xs font-medium rounded-lg border border-gray-200 dark:border-white/5 hover:border-primary-500 hover:text-primary-600 dark:hover:border-primary-500 dark:hover:text-primary-400 transition-colors shadow-sm">
                                #{{ $t->name }}
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
