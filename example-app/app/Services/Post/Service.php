<?php
namespace  App\Services\Post;

use App\Models\Post;

class Service
{
    public function store($data)
    {
        $tags = $data['tags'];
        unset($data['tags']);
        $post = POST::create($data);
        $post->tags()->attach($tags);
        // Для JSON удали потом
        return $post;
    }

    public function update($post, $data)
    {
        $tags = $data['tags'];
        unset($data['tags']);
        $post->update($data);
        $post->tags()->sync($tags);
        // Для JSON удали потом
        return $post->fresh();
    }
}
