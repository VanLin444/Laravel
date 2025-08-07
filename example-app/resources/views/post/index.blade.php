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
        @foreach($posts as $post)
        <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>{{$post->post_content}}</td>
            <td>{{$post->likes}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection