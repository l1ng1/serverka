<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function create(User $user)
    {
        return $user->role === 'moderator';
    }

    public function update(User $user, Article $article)
    {
        return $user->role === 'moderator';
    }

    public function delete(User $user, Article $article)
    {
        return $user->role === 'moderator';
    }
}