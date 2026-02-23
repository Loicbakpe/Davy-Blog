<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->with(['category', 'user'])
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

        return view('tags.show', compact('tag', 'posts', 'categories', 'tags'));
    }
}
