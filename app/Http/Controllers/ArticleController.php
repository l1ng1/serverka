<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ArticleCreated;
use Illuminate\Support\Facades\Mail;
use App\Jobs\VeryLongJob;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(5);
        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        if (auth()->user()->role !== 'moderator') {
            abort(403, 'Доступ запрещён');
        }
        return view('articles.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'moderator') {
            abort(403, 'Доступ запрещён');
        }
        $request->validate([
            'name' => 'required|min:3',
            'desc' => 'required|min:10',
        ]);

        $article = Article::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'preview_image' => 'preview.jpg',
        ]);

        $moderator = User::where('role', 'moderator')->first();
        VeryLongJob::dispatch($article);
        broadcast(new \App\Events\NewArticleEvent($article));

        return redirect('/articles');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);
        $request->validate([
            'name' => 'required|min:3',
            'desc' => 'required|min:10',
        ]);

        $article->update([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);

        return redirect('/articles');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete', $article);
        $article->delete();
        return redirect('/articles');
    }
    public function show($id)
    {
        $article = Article::with('comments.user')->findOrFail($id);
        return view('articles.show', ['article' => $article]);
    }
}