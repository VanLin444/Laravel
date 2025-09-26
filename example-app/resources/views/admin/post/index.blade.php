@extends('layouts.admin')

@section('app-content')
    <div>
        <a href="{{ route('post.create') }}" class="btn btn-primary">Add new post</a>
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
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->likes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="display: flex; justify-content: center;">
            {{ $posts->withQueryString()->links() }}
        </div>
    </div>
@endsection
