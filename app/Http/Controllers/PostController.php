<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'user'])
            ->withCount('comments')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc');

        if ($request->has('q')) {
            $search = $request->get('q');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(12)->withQueryString();
        
        $categories = Category::withCount(['posts' => function($q) {
            $q->where('status', 'published');
        }])->orderBy('posts_count', 'desc')->take(10)->get();
        
        $tags = Tag::withCount(['posts' => function($q) {
            $q->where('status', 'published');
        }])->orderBy('posts_count', 'desc')->take(20)->get();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published' && (!auth()->check() || auth()->user()->role !== 'admin')) {
            abort(404);
        }

        $post->load(['user', 'category', 'tags', 'comments' => function($query) {
            $query->where('approved', true)->with('user')->latest();
        }]);

        // Incrémente le nombre de vues
        $post->increment('views');

        // Articles similaires
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}
