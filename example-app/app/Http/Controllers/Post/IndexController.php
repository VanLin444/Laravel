<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use App\Http\Filters\PostFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterRequest;
use Illuminate\Support\Facades\Gate;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
        $posts = Post::filter($filter)->paginate(10);

        return view('post.index', compact('posts'));
    }
}
