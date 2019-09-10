<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Facades\Purifier;

class Content extends Model
{
    use SoftDeletes;

    protected $fillable = ['contentable_id', 'contentable_type', 'body', 'markdown'];

    protected $casts = [
        'contentable_id' => 'int',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($content) {
            // isDirty () 去判断一个模型或者给定的属性是否被更改了
            if ($content->isDirty('markdown') && !empty($content->markdown)) {
                $content->body = self::toHTML($content->markdown);
            }

            $content->body = Purifier::clean($content->body);
        });
    }

    public static function toHTML(string $markdown)
    {
        return app(\ParsedownExtra::class)->text(\emoji($markdown));
    }

    public function contentable()
    {
        return $this->morphTo();
    }
}
