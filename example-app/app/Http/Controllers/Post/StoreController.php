<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'string',
            'category_id' => 'string',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        $post = POST::create($data);
        $post->tags()->attach($tags);
        return redirect()->route('post.index');
    }
}
