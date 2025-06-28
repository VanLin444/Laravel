<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPost() {
        $post = Post::find(1);
        dd($post->content);
    }

    public function createPost() {
        $postArr = [
            [
                'title' => 'Laravel project',
                'content' => 'content about project',
                'image' => 'https://ru.wikipedia.org/wiki/PHP#/media/%D0%A4%D0%B0%D0%B9%D0%BB:Webysther_20160423_-_Elephpant.svg',
                'likes' => 27,
                'is_published' => 1,
            ],
            [
                'title' => 'Blog on Laravel',
                'content' => 'content about how to do blog on laravel',
                'image' => 'https://ru.wikipedia.org/wiki/Laravel#/media/%D0%A4%D0%B0%D0%B9%D0%BB:Laravel.svg',
                'likes' => 44,
                'is_published' => 1,
            ],
        ];

        foreach ($postArr as $item) {
            POST::create($item);
        }

        dd('created');
    }

    public function updatePost() {
        $post = POST::find(3);
        $post->update([
            'title' => 'How fix bugs',
            'content' => 'today we learn how fix bugs on php',
        ]);
        dd('updated');
    }
}
