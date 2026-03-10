<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(5);
        return response()->json($articles);
    }

    public function show($id)
    {
        $article = Article::with('comments')->findOrFail($id);
        return response()->json($article);
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'moderator') {
            return response()->json(['message' => 'Доступ запрещён'], 403);
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

        return response()->json($article, 201);
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

        return response()->json($article);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete', $article);
        $article->delete();
        return response()->json(['message' => 'Статья удалена']);
    }
}