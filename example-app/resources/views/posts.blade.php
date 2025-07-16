<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSTS</title>
</head>
<body>
    <p>This is BLADE...</p>
    @foreach($posts as $post)
        <div>{{$post->title}}</div>
    @endforeach
</body>
</html>