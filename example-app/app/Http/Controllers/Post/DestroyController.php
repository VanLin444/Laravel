<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class DestroyController extends BaseController
{
    public function __invoke(POST $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
