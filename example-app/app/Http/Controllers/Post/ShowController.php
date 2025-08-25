<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ShowController extends BaseController
{
    public function __invoke($id)
    {
        $post = POST::findOrFail($id);
        return view('post.show', compact('post'));
    }
}
