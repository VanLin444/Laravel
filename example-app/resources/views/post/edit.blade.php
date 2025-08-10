@extends('layouts.main')
@section('content')
<form action="{{ route('post.update', $post->id) }}" method="POST">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="postName" class="form-label">Название поста :</label>
        <input type="text" class="form-control" id="postName" name="title" value="{{ $post->title}}">
    </div>
    <div class="mb-3">
        <label for="postContent" class="form-label">Текст :</label>
        <textarea class="form-control" id="postContent" name="post_content">{{$post->post_content}}</textarea>
    </div>
    <div class="mb-3">
        <label for="postImage" class="form-label">Изображение :</label>
        <input type="text" class="form-control" id="postImage" name="image" value="{{ $post->image}}">
    </div>
    <button type="submit" class="btn btn-primary">Изменить</button>
</form>
@endsection
