<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['post', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['approved' => !$comment->approved]);
        
        $status = $comment->approved ? 'approuvé' : 'désapprouvé';
        return back()->with('success', "Le commentaire a été {$status} avec succès.");
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Commentaire supprimé avec succès.');
    }
}
