<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

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

        Article::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'preview_image' => 'preview.jpg',
        ]);

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
}