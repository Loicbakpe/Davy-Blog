@extends('admin.layouts.app')

@section('header', 'Liste des Abonnés')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-[1.5rem] shadow-soft dark:shadow-soft-dark border border-gray-100 dark:border-white/5 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white font-serif">Abonnés à la Newsletter</h2>
        <div class="px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 rounded-full text-xs font-bold">
            {{ $subscribers->total() }} au total
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 dark:bg-white/5 text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-bold">Email</th>
                    <th class="px-6 py-4 font-bold">Date d'inscription</th>
                    <th class="px-6 py-4 font-bold">Statut</th>
                    <th class="px-6 py-4 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                @forelse($subscribers as $subscriber)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $subscriber->email }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $subscriber->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($subscriber->isConfirmed())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                    Confirmé
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                    En attente
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet abonné ?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" title="Supprimer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <p class="text-gray-500 dark:text-gray-400">Aucun abonné pour le moment.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($subscribers->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 dark:border-white/5">
            {{ $subscribers->links() }}
        </div>
    @endif
</div>
@endsection
