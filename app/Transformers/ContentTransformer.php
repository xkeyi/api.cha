<?php

namespace App\Transformers;

use App\Models\Content;
use League\Fractal\TransformerAbstract;

class ContentTransformer extends TransformerAbstract
{
    public function transform(Content $content)
    {
        return [
            'body' => $content->body,
            'markdown' => $content->markdown,
            'activity_log_content' => $content->activity_log_content,
        ];
    }
}
