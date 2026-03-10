<?php

namespace App\Jobs;

use App\Mail\ArticleCreated;
use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function handle()
    {
        $moderator = User::where('role', 'moderator')->first();
        Mail::to($moderator->email)->send(new ArticleCreated($this->article));
    }
}