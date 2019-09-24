<?php

namespace App\Http\Requests;

class ArticleRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => 'required|string|min:6',
                    'cover_image' => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                    'type' => 'required|in:markdown,html',
                    'content.body' => 'required_if:type,html',
                    'content.markdown' => 'required_if:type,markdown',
                    'is_draft' => 'boolean',
                ];
                break;

            case 'PATCH':
                return [
                    'title' => 'required|string|min:6',
                    'cover_image' => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                    'type' => 'required|in:markdown,html',
                    'content.body' => 'required_if:type,html',
                    'content.markdown' => 'required_if:type,markdown',
                    'is_draft' => 'boolean',
                ];
                break;

            default:
                // code...
                break;
        }
    }
}
