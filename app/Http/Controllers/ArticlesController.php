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
        $this->authorize('create', $article);

        // 添加文章数据
        $article->fill([
            'title' => $request->input('title'),
            'cover_image' => $request->input('cover_image'),
            'category_id' => $request->input('category_id'),
        ]);
        // 文章作者
        $article->user_id = $this->user()->id;
        // 不是草稿
        if (!$request->is_draft) {
            $article->published_at = now();
        }
        // 保存文章
        $article->save();

        // 添加文章内容
        $article->content()->create($request->content);

        // 添加标签
        if ($tags = $request->tags) {
            $article->tags()->sync($tags);
        }

        return $this->response->item($article, new ArticleTransformer());
    }

    public function show(Article $article)
    {
        // 文章被禁用，不允许查看
        if ($article->banned_at) {
            return $this->response->errorNotFound();
        }

        // 文章未发布，只允许作者自己查看
        if (!$article->published_at) {
            if (!$this->user() || ($this->user()->id !== $article->user_id && !$this->user()->is_admin)) {
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
        $this->authorize('delete', $article);

        $article->delete();

        return $this->response->noContent();
    }

    public function update(ArticleRequest $request, Article $article)
    {
        // 权限验证
        $this->authorize('update', $article);

        $data = [
            'title' => $request->input('title'),
            'cover_image' => $request->input('cover_image'),
            'category_id' => $request->input('category_id'),
        ];

        if (!$article->published_at && !$request->is_draft) {
            $data['published_at'] = now();
        }

        $article->update($data);

        // 更新文章内容
        $content = $article->content;
        $content['body'] = $request->content['body'] ?: $content->body;
        $content['markdown'] = $request->content['markdown'];
        $content->save();

        // 直接使用 update（此处相当于批量更新）不会出发 content 的 saving 事件
        // $article->content()->update($request->content);

        // 更新标签
        $tags = $request->tags ?: [];
        $article->tags()->sync($tags);

        return $this->response->item($article, new ArticleTransformer());
    }
}
