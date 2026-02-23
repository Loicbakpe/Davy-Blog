<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->with(['category', 'user'])
            ->withCount('comments')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $categories = Category::withCount(['posts' => function($q) {
            $q->where('status', 'published');
        }])->orderBy('posts_count', 'desc')->take(10)->get();
        
        $tags = Tag::withCount(['posts' => function($q) {
            $q->where('status', 'published');
        }])->orderBy('posts_count', 'desc')->take(20)->get();

        return view('categories.show', compact('category', 'posts', 'categories', 'tags'));
    }
}
