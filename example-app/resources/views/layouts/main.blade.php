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
            <ul class="mb-3 nav nav-tabs">
                <li class="nav-item"><a href="{{ route('main.index')}}" class="nav-link">Main</a></li>
                <li class="nav-item"><a href="{{ route('post.index')}}" class="nav-link">Posts</a></li>
                <li class="nav-item"><a href="{{ route('contacts.index')}}" class="nav-link">Contacts</a></li>
                <li class="nav-item"><a href="{{ route('about.index')}}" class="nav-link">About</a></li>
            </ul>
        </nav>
    </div>
    @yield('content')
</body>
</html>