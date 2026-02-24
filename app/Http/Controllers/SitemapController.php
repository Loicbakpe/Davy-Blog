<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest()->get();
        $categories = Category::all();
        $tags = Tag::all();

        return response()->view('sitemap', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ])->header('Content-Type', 'text/xml');
    }
}
