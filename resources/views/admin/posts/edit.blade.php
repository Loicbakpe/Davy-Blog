@extends('admin.layouts.app')

@section('header', 'Modifier Article')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Éditer: {{ Str::limit($post->title, 40) }}</h2>
        <a href="{{ route('admin.posts.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-sm">
            &larr; Retour à la liste
        </a>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Colonne Principale (Titre, Extrait, Contenu) -->
            <div class="md:col-span-2 space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Titre <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg font-semibold">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Extrait (Résumé) <span class="text-red-500">*</span></label>
                    <textarea name="excerpt" id="excerpt" rows="2" required
                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="markdown-editor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Contenu <span class="text-red-500">*</span></label>
                    <textarea name="body" id="markdown-editor" rows="15" required
                        class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm">{{ old('body', $post->body) }}</textarea>
                    @error('body')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Colonne Latérale (Paramètres) -->
            <div class="space-y-6">
                <!-- Statut & Visibilité -->
                <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg border border-gray-100 dark:border-gray-600">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-4 uppercase tracking-wider">Publication</h3>
                    
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Statut</label>
                        <select name="status" id="status" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Brouillon (Non visible)</option>
                            <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Publié (Visible de tous)</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $post->featured) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <label for="featured" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            Article en vedette
                        </label>
                    </div>
                </div>

                <!-- Catégorie & Tags -->
                <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg border border-gray-100 dark:border-gray-600">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-4 uppercase tracking-wider">Organisation</h3>
                    
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catégorie <span class="text-red-500">*</span></label>
                        <select name="category_id" id="category_id" required class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tags</label>
                        @php
                            $postTags = old('tags', $post->tags->pluck('id')->toArray());
                        @endphp
                        <select name="tags[]" id="tags" multiple class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 h-32">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, $postTags) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Maintenez CTRL ou CMD pour sélectionner plusieurs tags.</p>
                        @error('tags')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Image de couverture -->
                <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-lg border border-gray-100 dark:border-gray-600">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-4 uppercase tracking-wider">Image de couverture</h3>
                    
                    @if($post->cover_image)
                        <div class="mb-4">
                            <p class="text-xs text-gray-500 mb-2">Image actuelle :</p>
                            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Couverture" class="w-full h-auto rounded-md shadow-sm">
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Changer l'image (Optionnel)</label>
                        <input type="file" name="cover_image" id="cover_image" accept="image/*"
                            class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-800 dark:file:text-gray-300">
                        @error('cover_image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end">
            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition font-semibold shadow-sm">
                Mettre à jour l'article
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
@vite('resources/js/editor.js')
@endpush
