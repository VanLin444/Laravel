@extends('layouts.main')
@section('content')
    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="postName" class="form-label">Название поста :</label>
            <input type="text" class="form-control" id="postName" name="title">
        </div>
        <div class="mb-3">
            <label for="postContent" class="form-label">Текст :</label>
            <textarea class="form-control" id="postContent" name="post_content"></textarea>
        </div>
        <div class="mb-3">
            <label for="postImage" class="form-label">Изображение :</label>
            <input type="text" class="form-control" id="postImage" name="image">
        </div>
        <div>
            <label for="categories">Категории:</label>
            <select class="form-select mb-3" id="categories" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="tags">Теги:</label>
            <select class="form-select" multiple id="tags" name="tags[]">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
