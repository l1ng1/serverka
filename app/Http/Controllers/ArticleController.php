<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ArticleCreated;
use Illuminate\Support\Facades\Mail;
use App\Jobs\VeryLongJob;
use App\Notifications\NewArticleNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $articles = Cache::remember('articles_page_' . $page, 60, function () {
            return Article::paginate(5);
        });
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

        $totalPages = ceil(Article::count() / 5);
        for ($i = 1; $i <= $totalPages; $i++) {
            Cache::forget('articles_page_' . $i);
        }

        VeryLongJob::dispatch($article);
        broadcast(new \App\Events\NewArticleEvent($article));

        $readers = User::where('role', 'reader')->get();
        Notification::send($readers, new NewArticleNotification($article));

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

        Cache::flush();

        return redirect('/articles');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete', $article);
        $article->delete();

        Cache::flush();

        return redirect('/articles');
    }

    public function show($id)
    {
        $article = Cache::rememberForever('article_' . $id, function () use ($id) {
            return Article::with('comments.user')->findOrFail($id);
        });
        return view('articles.show', ['article' => $article]);
    }

    public function readNotification($id, $notificationId)
    {
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        return redirect('/articles/' . $id);
    }
}