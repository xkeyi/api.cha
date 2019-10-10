<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Arr;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'cover_image', 'category_id', 'published_at'];

    protected $casts = [
        'cache' => 'array',
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function content()
    {
        return $this->morphOne(Content::class, 'contentable');
    }

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', now())
            ->whereNull('deleted_at');
    }
}
