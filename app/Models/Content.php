<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mews\Purifier\Facades\Purifier;

class Content extends Model
{
    use SoftDeletes;

    protected $fillable = ['contentable_id', 'contentable_type', 'body'];

    protected $casts = [
        'contentable_id' => 'int',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($content) {
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

    public function getActivityLogContentAttribute()
    {
        return \str_limit(\strip_tags($this->body), 100);
    }
}
