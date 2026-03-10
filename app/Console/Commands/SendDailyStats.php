<?php

namespace App\Console\Commands;

use App\Mail\DailyStats;
use App\Models\Comment;
use App\Models\PageView;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyStats extends Command
{
    protected $signature = 'stats:send';
    protected $description = 'Send daily stats to moderator';

    public function handle()
    {
        $views = PageView::whereDate('created_at', today())->count();
        $comments = Comment::whereDate('created_at', today())->count();

        $moderator = User::where('role', 'moderator')->first();
        Mail::to($moderator->email)->send(new DailyStats($views, $comments));

        $this->info('Stats sent!');
    }
}