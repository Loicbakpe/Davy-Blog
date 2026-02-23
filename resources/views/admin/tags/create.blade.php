@extends('admin.layouts.app')

@section('header', 'Nouveau Tag')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 max-w-2xl">
    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Ajouter un tag</h2>
        <a href="{{ route('admin.tags.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-sm">
            &larr; Retour à la liste
        </a>
    </div>

    <form action="{{ route('admin.tags.store') }}" method="POST" class="p-6">
        @csrf

        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom du tag <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder-gray-400"
                placeholder="Ex: Laravel, React, PHP...">
            @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Le slug sera généré automatiquement à partir de ce nom.</p>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="px-4 py-2 bg-indigo-600 cursor-pointer text-white rounded hover:bg-indigo-700 transition font-medium">
                Enregistrer le tag
            </button>
        </div>
    </form>
</div>
@endsection
