@extends('admin.layouts.app')

@section('header', 'Articles')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Liste des articles</h2>
        <a href="{{ route('admin.posts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
            Nouvel Article
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-700/50">
                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider w-1/3">Titre</th>
                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Auteur</th>
                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Catégorie</th>
                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center">Statut</th>
                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center">Date</th>
                    <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($post->cover_image)
                                <img class="h-10 w-10 rounded object-cover mr-3" src="{{ asset('storage/' . $post->cover_image) }}" alt="">
                            @else
                                <div class="h-10 w-10 rounded bg-gray-200 dark:bg-gray-700 flex items-center justify-center mr-3 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-200 line-clamp-1">{{ $post->title }}</p>
                                <div class="text-xs text-gray-500 flex items-center mt-1">
                                    <span title="Vues" class="mr-2 flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>{{ $post->views }}</span>
                                    <span title="Commentaires" class="flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>{{ $post->comments_count }}</span>
                                    @if($post->featured)
                                        <span class="ml-2 px-1.5 py-0.5 rounded text-[10px] font-medium bg-amber-100 text-amber-800 border border-amber-200">En vedette</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $post->user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium" style="background-color: {{ $post->category->color }}30; color: {{ $post->category->color }}">
                            {{ $post->category->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        @if($post->status === 'published')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">Publié</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">Brouillon</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                        {{ $post->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 mr-3">Modifier</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        Aucun article trouvé.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
        {{ $posts->links() }}
    </div>
</div>
@endsection
