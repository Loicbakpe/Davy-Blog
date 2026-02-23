<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('posts')->orderBy('name')->paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:tags',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        Tag::create($validated);

        return redirect()->route('admin.tags.index')->with('success', 'Tag créé avec succès.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:tags,name,' . $tag->id,
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $tag->update($validated);

        return redirect()->route('admin.tags.index')->with('success', 'Tag modifié avec succès.');
    }

    public function destroy(Tag $tag)
    {
        // Detach tag from all posts first
        $tag->posts()->detach();
        $tag->delete();
        
        return redirect()->route('admin.tags.index')->with('success', 'Tag supprimé avec succès.');
    }
}
