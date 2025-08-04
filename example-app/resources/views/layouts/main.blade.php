<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>POSTS</title>
</head>
<body>
    <div class="">
        <nav class="">
            <ul class="">
                <li><a href="{{ route('main.index')}}">Main</a></li>
                <li><a href="{{ route('post.index')}}">Posts</a></li>
                <li><a href="{{ route('contacts.index')}}">Contacts</a></li>
                <li><a href="{{ route('about.index')}}">About</a></li>
            </ul>
        </nav>
    </div>
    @yield('content')
</body>
</html>