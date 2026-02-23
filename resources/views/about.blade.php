@extends('layouts.main')

@section('title', 'À propos')

@section('content')
<!-- Header About -->
<div class="bg-surface-light dark:bg-surface-darker border-b border-gray-100 dark:border-white/5 pt-16 pb-24 md:pt-20 md:pb-32 relative overflow-hidden">
    <!-- Abstract Decor -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-primary-500/10 dark:bg-primary-500/20 blur-[100px] rounded-full pointer-events-none"></div>
    <div class="absolute top-1/2 left-0 -ml-20 w-80 h-80 bg-accent-500/10 dark:bg-accent-500/10 blur-[80px] rounded-full pointer-events-none"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold shadow-soft mb-6 bg-white dark:bg-surface-dark border border-gray-100 dark:border-white/5 mx-auto text-primary-600 dark:text-primary-400">
            Qui sommes-nous ?
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-gray-900 dark:text-white mb-6 font-serif tracking-tight">
            À propos de <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-500">Davy Blog</span>
        </h1>
        <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed italic font-serif">
            Partager la passion du code, une ligne à la fois.
        </p>
    </div>
</div>

<section class="py-16 lg:py-24 bg-surface-light dark:bg-surface-darker -mt-8 relative z-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white dark:bg-surface-dark rounded-[2rem] p-8 md:p-12 shadow-soft dark:shadow-soft-dark border border-gray-100 dark:border-white/5 mb-16 relative overflow-hidden">
            <div class="prose prose-lg md:prose-xl dark:prose-invert prose-primary mx-auto prose-img:rounded-[1.5rem] prose-headings:font-serif">
                <p class="lead text-gray-700 dark:text-gray-300 text-lg md:text-xl leading-relaxed mb-8">
                    Bienvenue sur <strong>Davy Blog</strong>. Ce projet est né de la volonté de créer un espace de partage autour de l'écosystème web moderne, et plus particulièrement du framework Laravel et de PHP.
                </p>
                
                <hr class="border-gray-100 dark:border-white/5 my-10">

                <h3 class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    La Stack Technique
                </h3>
                <p>
                    Ce blog est construit avec des outils performants et modernes pour garantir une expérience utilisateur fluide et agréable :
                </p>
                <ul class="space-y-2 mt-4">
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-primary-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span><strong>Laravel 11</strong> en backend pour sa robustesse et son élégance.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-primary-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span><strong>Tailwind CSS v3</strong> pour un design sur mesure, réactif et élégant.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-primary-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span><strong>Alpine.js</strong> pour les interactions dynamiques et fluides côté client.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-primary-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span><strong>SQLite / MySQL</strong> pour le stockage efficace et sécurisé des données.</span>
                    </li>
                </ul>

                <hr class="border-gray-100 dark:border-white/5 my-10">

                <h3 class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-accent-100 dark:bg-accent-900/30 flex items-center justify-center text-accent-600 dark:text-accent-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    Notre Mission
                </h3>
                <p>
                    Aider les développeurs de tous niveaux à améliorer leurs compétences, découvrir de nouvelles astuces, et se tenir à jour des best practices de l'industrie. Les articles sont rédigés avec soin pour être à la fois théoriques et éminemment pratiques.
                </p>
            </div>
        </div>

        <!-- Call to Action Box -->
        <div class="bg-gradient-to-br from-primary-900 to-surface-darker rounded-[2rem] p-10 md:p-12 text-center relative overflow-hidden shadow-soft-dark text-white border border-primary-800/50">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,...')] opacity-10"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-6 border border-white/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h4 class="text-3xl font-bold font-serif mb-4">Envie d'échanger ?</h4>
                <p class="text-primary-100 mb-8 max-w-lg mx-auto text-lg">
                    Vous avez une question, une suggestion d'article ou vous souhaitez simplement discuter ? N'hésitez pas à nous contacter.
                </p>
                <a href="mailto:hello@davyblog.com" class="inline-flex items-center px-8 py-4 border border-transparent shadow-glow text-base font-bold rounded-xl text-primary-900 bg-white hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300">
                    Me contacter par email
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
