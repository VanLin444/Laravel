<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $posts = POST::all();
        return view('post.index', compact('posts'));
    }
    public function getPost()
    {
        $post = Post::find(1);
        dd($post->content);
    }

    public function createPost()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
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

    public function show($id)
    {
        $post = POST::findOrFail($id);
        return view('post.show', compact('post'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $post = POST::findOrFail($id);
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(POST $post)
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

        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(POST $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    public function updatePost()
    {
        $post = POST::find(3);
        $post->update([
            'title' => 'How fix bugs',
            'content' => 'today we learn how fix bugs on php',
        ]);
        dd('updated');
    }

    public function deletePost()
    {
        $post = POST::find(2);
        $post->delete();
        dd('post deleted');
    }

    public function firstOrCreate()
    {
        $anotherPost = [
            'title' => 'new project on laravel',
            'content' => 'another project on laravel',
            'image' => 'https://ru.wikipedia.org/wiki/Laravel#/media/%D0%A4%D0%B0%D0%B9%D0%BB:Laravel.svg',
            'likes' => 777,
            'is_published' => 0,
        ];

        // Если есть запись с уникальным полем, то возвращается она
        // Если нету , то создаётся
        $newPost = POST::firstOrCreate([
            'title' => 'CRUD'
        ], $anotherPost);
        dd($newPost->title);
    }

    public function updateOrCreate()
    {
        $updatePost = [
            'content' => 'update crud',
            'image' => 'https://ru.wikipedia.org/wiki/Laravel#/media/%D0%A4%D0%B0%D0%B9%D0%BB:Laravel.svg',
            'likes' => 666,
            'is_published' => 0,
        ];
        // Если есть запись с уникальным полем обновляет все остальные поля  в этой записи,
        // если нет, то создает её
        $post = POST::updateOrCreate([
            'title' => 'new project on laravel111'
        ], $updatePost);

        dd('updated');
    }
}
