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
            <label for="tags">Тэги:</label>
            <select class="form-select mb-3" aria-label="Пример выбора по умолчанию" id="tags" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
