<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category'])
            ->withCount('comments')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required|string',
            'body' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured' => 'boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);
        $validated['featured'] = $request->has('featured');

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('posts', 'public');
            $validated['cover_image'] = $path;
        }

        $post = Post::create($validated);
        
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required|string',
            'body' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured' => 'boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['featured'] = $request->has('featured');

        // Gérer la date de publication si le statut change vers 'published'
        if ($validated['status'] === 'published' && $post->status === 'draft') {
            $validated['published_at'] = now();
        } elseif ($validated['status'] === 'draft') {
            $validated['published_at'] = null;
        }

        // Gérer l'upload d'image
        if ($request->hasFile('cover_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $path = $request->file('cover_image')->store('posts', 'public');
            $validated['cover_image'] = $path;
        }

        $post->update($validated);

        // Mettre à jour les tags
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.index')->with('success', 'Article modifié avec succès.');
    }

    public function destroy(Post $post)
    {
        // Supprimer l'image de couverture associée
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Article supprimé avec succès.');
    }
}
