<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyStats extends Mailable
{
    use Queueable, SerializesModels;

    public int $views;
    public int $comments;

    public function __construct(int $views, int $comments)
    {
        $this->views = $views;
        $this->comments = $comments;
    }

    public function build()
    {
        return $this->subject('Статистика сайта за день')
                    ->view('mail.daily_stats');
    }
}