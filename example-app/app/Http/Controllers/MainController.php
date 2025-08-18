<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {

        /* $posts = POST::all();
        return view('main', compact('posts')); */
        $post = Post::find(1);
        $tag = Tag::find(1);
        return view('main');
    }
}
