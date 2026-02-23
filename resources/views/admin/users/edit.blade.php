@extends('admin.layouts.app')

@section('header', 'Modifier Utilisateur')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 max-w-2xl">
    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Éditer: {{ $user->name }}</h2>
        <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 text-sm">
            &larr; Retour à la liste
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adresse Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nouveau mot de passe <span class="text-xs text-gray-500 font-normal">(Laissez vide pour ne pas modifier)</span></label>
            <input type="password" name="password" id="password" minlength="8"
                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder-gray-400">
            @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rôle <span class="text-red-500">*</span></label>
            <select name="role" id="role" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="reader" {{ old('role', $user->role) == 'reader' ? 'selected' : '' }}>Lecteur (Ne peut que commenter)</option>
                <option value="author" {{ old('role', $user->role) == 'author' ? 'selected' : '' }}>Auteur (Peut écrire des articles)</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrateur (Accès total)</option>
            </select>
            @if($user->id === auth()->id())
                <p class="mt-1 text-xs text-orange-500">Attention, modifier votre propre rôle peut vous faire perdre l'accès à l'administration.</p>
            @endif
            @error('role')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Biographie (Optionnelle)</label>
            <textarea name="bio" id="bio" rows="3"
                class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('bio', $user->bio) }}</textarea>
            @error('bio')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-medium">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
