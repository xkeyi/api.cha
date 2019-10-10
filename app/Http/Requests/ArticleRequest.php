<?php

namespace App\Http\Requests;

use App\Models\Tag;

class ArticleRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => 'required|string|min:5',
                    'cover_image' => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                    'type' => 'required|in:markdown,html',
                    'content.body' => 'required_if:type,html',
                    'content.markdown' => 'required_if:type,markdown',
                    'is_draft' => 'boolean',
                    'tags' => [
                        'array',
                        function ($attribute, $tags, $fail) {
                            foreach ($tags as $tag) {
                                if (!Tag::find($tag)) {
                                    return $fail('该标签不存在');
                                }
                            }
                        },
                    ]
                ];
                break;

            case 'PATCH':
                return [
                    'title' => 'required|string|min:5',
                    'cover_image' => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                    'type' => 'required|in:markdown,html',
                    'content.body' => 'required_if:type,html',
                    'content.markdown' => 'required_if:type,markdown',
                    'is_draft' => 'boolean',
                    'tags' => [
                        'array',
                        function ($attribute, $tags, $fail) {
                            foreach ($tags as $tag) {
                                if (!Tag::find($tag)) {
                                    return $fail('该标签不存在');
                                }
                            }
                        },
                    ]
                ];
                break;

            default:
                // code...
                break;
        }
    }
}
