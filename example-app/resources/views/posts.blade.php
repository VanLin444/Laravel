@extends('layouts.main')
@section('content')
    <p>This is BLADE...</p>
    @foreach($posts as $post)
        <div>{{$post->title}}</div>
        <div>{{$post->post_content}}</div>
        <div>{{$post->likes}}</div>
        <br>
    @endforeach
@endsection