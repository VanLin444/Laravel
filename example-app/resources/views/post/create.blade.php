@extends('layouts.main')
@section('content')
    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="postName" class="form-label">Название поста :</label>
            <input type="text" class="form-control" id="postTitle" name="title" value="{{ old('title') }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="postContent" class="form-label">Текст :</label>
            <textarea class="form-control" id="postContent" name="content">{{old('content')}}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="postImage" class="form-label">Изображение :</label>
            <input type="text" class="form-control" id="postImage" name="image" value="{{ old('image') }}">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="categories">Категории:</label>
            <select class="form-select mb-3" id="categories" name="category_id">
                @foreach ($categories as $category)
                    <option {{ old('category_id')==$category->id ? ' selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="tags">Теги:</label>
            <select class="form-select" multiple id="tags" name="tags[]">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" >{{ $tag->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
