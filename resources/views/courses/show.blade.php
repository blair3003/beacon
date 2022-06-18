<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course | BEACON</title>
</head>
<body>
    <h1>Course #{{ $course->id }}</h1>

    <div><strong>Title:</strong> {{ $course->title }}</div>
    <div><strong>Description:</strong> {{ $course->description }}</div>
    
</body>
</html>