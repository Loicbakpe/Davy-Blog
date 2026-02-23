<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Articles en vedette
        $featuredPosts = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->where('featured', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        // Articles récents
        $recentPosts = Post::with(['category', 'user'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(6);

        // Catégories pour la sidebar
        $categories = Category::withCount(['posts' => function($query) {
            $query->where('status', 'published');
        }])->orderBy('posts_count', 'desc')->take(6)->get();

        return view('home', compact('featuredPosts', 'recentPosts', 'categories'));
    }
}
