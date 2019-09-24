<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\TagTransformer;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return $this->response->collection($tags, new TagTransformer());
    }
}
