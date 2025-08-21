<?php

namespace App\Http\Controllers\Post;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function __invoke($id)
    {
        $categories = Category::all();
        $post = POST::findOrFail($id);
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }
}
