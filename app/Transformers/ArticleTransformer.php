<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'category', 'tags'];

    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'category_id' => $article->category_id,
            'user_id' => $article->user_id,
            'published_at' => (string) $article->published_at,
        ];
    }

    public function includeUser(Article $article)
    {
        return $this->item($article->user, new UserTransformer());
    }

    public function includeCategory(Article $article)
    {
        return $this->item($article->category, new CategoryTransformer());
    }

    public function includeTags(Article $article)
    {
        return $this->collection($article->tags, new TagTransformer());
    }
}
