<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000'
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $validated['body'],
            'approved' => false // Commentaires modérés à priori
        ]);

        return back()->with('status', 'Votre commentaire a été soumis et est en attente de validation par un modérateur.');
    }
}
