<?php

namespace App\Transformers;

use App\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    public function transform(Tag $tag)
    {
        return [
            'id' => $tag->id,
            'category_id' => $tag->category_id,
            'name' => $tag->name,
            'description' => $tag->description,
            'badge' => $tag->badge,
        ];
    }
}
