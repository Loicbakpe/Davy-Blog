<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show(User $user)
    {
        // Only show profiling for admins or authors
        if ($user->role === 'reader') {
            abort(404);
        }

        $posts = $user->posts()
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        return view('authors.show', compact('user', 'posts'));
    }
}
