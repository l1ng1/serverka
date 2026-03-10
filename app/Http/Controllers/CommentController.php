<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'content' => 'required|min:3',
        ]);

        Comment::create([
            'article_id' => $articleId,
            'user_id' => auth()->id(),
            'content' => $request->content,
            'is_approved' => false,
        ]);

        return back()->with('comment_pending', 'Комментарий отправлен на модерацию.');
    }

    public function moderation()
    {
        if (auth()->user()->role !== 'moderator') {
            abort(403);
        }
        $comments = Comment::where('is_approved', false)->with('article', 'user')->get();
        return view('comments.moderation', ['comments' => $comments]);
    }

    public function approve($id)
    {
        if (auth()->user()->role !== 'moderator') {
            abort(403);
        }
        $comment = Comment::findOrFail($id);
        $comment->update(['is_approved' => true]);
        Cache::forget('article_' . $comment->article_id);
        return back();
    }

    public function reject($id)
    {
        if (auth()->user()->role !== 'moderator') {
            abort(403);
        }
        $comment = Comment::findOrFail($id);
        Cache::forget('article_' . $comment->article_id);
        $comment->delete();
        return back();
    }
}