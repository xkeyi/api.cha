<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;
use App\Models\Category;

class TagsController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return $this->response->collection($categories, new CategoryTransformer());
    }
}
