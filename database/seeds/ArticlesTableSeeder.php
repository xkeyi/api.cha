<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = 1;

        $cover_images = [
            'https://cdn.pigjian.com/cover/2018/03/01/HlFgqAjAvIiSN96GGk1ZZSf5Igq3Njx7gnLJEkSd.png',
            'https://cdn.pigjian.com/cover/2018/10/11/mzcJBgfUXAJWC7E4YOqcysOP4L7vXvadI71nSCtS.jpg',
            'https://cdn.pigjian.com/cover/2018/01/07/Mi1Ht9NaSvhGE4jzXozR42xOdAprrjvXrK5Kxuul.png',
        ];

        // 所有分类 ID 数组，如：[1,2,3,4]
        $category_ids = Category::all()->pluck('id')->toArray();

        // 获取所有的标签 ID 数组
        $tag_ids = Tag::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $articles = factory(Article::class)
                        ->times(100)
                        ->make()
                        ->each(function ($article) use ($user_id, $category_ids, $cover_images, $faker) {
                            $article->user_id = $user_id;
                            $article->cover_image = $faker->randomElement($cover_images);
                            // 话题分类
                            $article->category_id = $faker->randomElement($category_ids);
                        });


        Article::insert($articles->toArray());

        $articles = Article::all();

        foreach ($articles as $article) {
            // 添加标签
            $article->tags()->sync($faker->randomElements($tag_ids, 3));

            // 添加内容
            $content['markdown'] = $faker->text();
            $article->content()->create($content);
        }
    }
}
