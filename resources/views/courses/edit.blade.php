<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course | BEACON</title>
</head>
<body>
    <h1>Edit Course</h1>
    <form method="POST" action="/courses/{{ $course->id }}">
        @csrf
        @method('PUT')
        <fieldset>
            <legend>Edit course details</legend>

            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ $course->title }}">
                @error('title')
                <p>{{ $message }}</p>
                @enderror                
            </div>

            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description">{{ $course->description }}</textarea>
                @error('description')
                <p>{{ $message }}</p>
                @enderror                
            </div>
            
        </fieldset>

        <button type="submit">Update</button>    
    </form>
    
</body>
</html>