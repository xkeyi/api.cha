<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Tag;
use App\Transformers\ArticleTransformer;

class ArticlesController extends Controller
{
    public function store(ArticleRequest $request, Article $article)
    {
        // 权限验证
        $this->authorize('admin', $article);

        $article->fill($request->all());
        $article->user_id = $this->user()->id;
        if (!$request->is_draft) {
            $article->published_at = now();
        }
        $article->save();

        // 添加文章内容
        $content = $request->content;
        $article->content()->create($content);

        // 添加标签
        if ($tags = $request->tags) {
            $tags = Tag::whereIn('id', $tags)->pluck('id');
            if ($tags) {
                $article->tags()->sync($tags);
            }
        }

        return $this->response->item($article, new ArticleTransformer());
    }

    public function show(Article $article)
    {
        // 判断文章是否删除或者禁用或者未发布
        if (!$article->published_at) {
            if (!$this->user() || $this->user()->id !== 1) {
                return $this->response->errorNotFound();
            }
        }

        return $this->response->item($article, new ArticleTransformer());
    }

    public function index(Request $request)
    {
        $builder = Article::published();

        if ($category_id = $request->category_id) {
            $builder->where('category_id', $category_id);
        }

        $articles = $builder->orderBy('published_at', 'desc')->paginate();

        return $this->response->paginator($articles, new ArticleTransformer());
    }

    public function destroy(Article $article)
    {
        // 权限验证
        $this->authorize('admin', $article);

        $article->delete();

        return $this->response->noContent();
    }

    public function update(ArticleRequest $request, Article $article)
    {
        // 权限验证
        $this->authorize('admin', $article);

        $article->update($request->all());

        // 更新文章内容
        $content = $request->content;
        $article->content()->update($content);

        // 更新标签
        $tags = $request->tags ?: [];
        $article->tags()->sync($tags);

        return $this->response->item($article, new ArticleTransformer());
    }
}
