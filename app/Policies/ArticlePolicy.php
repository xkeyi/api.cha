<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function create(User $user, Article $article)
    {
        return $user->is_admin;
    }

    public function update(User $user, Article $article)
    {
        return $user->is_admin || $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->is_admin || $user->id === $article->user_id;
    }
}
