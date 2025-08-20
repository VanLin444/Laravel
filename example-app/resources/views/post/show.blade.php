@extends('layouts.main')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Описание</th>
            <th scope="col">Лайки</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>{{$post->content}}</td>
            <td>{{$post->likes}}</td>
        </tr>
    </tbody>
</table>
<div>
    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success">Изменить</a>
</div>
<div>
    <form action="{{ route('post.delete', $post->id) }}" method="POST">
        @csrf
        @method('delete')
        <input type="submit" value="Удалить" class="btn btn-danger">
    </form>
</div>
<div>
    <a href="{{ route('post.index') }}" class="btn btn-dark">Назад</a>
</div>
@endsection
