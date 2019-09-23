<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'badge'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
