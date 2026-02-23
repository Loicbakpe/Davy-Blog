@extends('layouts.main')

@section('title', 'À propos')

@section('content')
<div class="bg-white dark:bg-slate-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white font-serif tracking-tight mb-4">À propos de Davy Blog</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Partager la passion du code, une ligne à la fois.
            </p>
        </div>

        <div class="prose prose-lg dark:prose-invert prose-indigo mx-auto">
            <p>
                Bienvenue sur <strong>Davy Blog</strong>. Ce projet est né de la volonté de créer un espace de partage autour de l'écosystème web moderne, et plus particulièrement du framework Laravel et de PHP.
            </p>
            
            <h3>La Stack Technique</h3>
            <p>
                Ce blog est construit avec des outils performants et modernes pour garantir une expérience utilisateur fluide et agréable :
            </p>
            <ul>
                <li><strong>Laravel 11</strong> en backend pour sa robustesse et son élégance.</li>
                <li><strong>Tailwind CSS v3</strong> pour un design sur mesure et responsive.</li>
                <li><strong>Alpine.js</strong> pour les interactions dynamiques côté client.</li>
                <li><strong>SQLite</strong> (ou MySQL en production) pour le stockage efficace des données.</li>
            </ul>

            <h3>Notre Mission</h3>
            <p>
                Aider les développeurs de tous niveaux à améliorer leurs compétences, découvrir de nouvelles astuces, et se tenir à jour des best practices de l'industrie. Les articles sont rédigés avec soin pour être à la fois théoriques et pratiques.
            </p>

            <div class="mt-12 bg-indigo-50 dark:bg-slate-800 rounded-2xl p-8 border border-indigo-100 dark:border-slate-700 text-center">
                <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Envie d'échanger ?</h4>
                <p class="text-gray-600 dark:text-gray-300 mb-6">N'hésitez pas à me contacter ou à me retrouver sur les réseaux sociaux.</p>
                <a href="mailto:hello@example.com" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition">
                    Me contacter par email
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
