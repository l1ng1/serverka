<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $articles = json_decode(file_get_contents(public_path('articles.json')), true);
        return view('index', ['articles' => $articles]);
    }

    public function gallery($id)
    {
        $articles = json_decode(file_get_contents(public_path('articles.json')), true);
        $article = $articles[$id];
        return view('gallery', ['article' => $article]);
    }
}