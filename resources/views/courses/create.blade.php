<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course | BEACON</title>
</head>
<body>
    <h1>Create Course</h1>
    <form method="POST" action="/courses">
        @csrf
        <fieldset>
            <legend>Enter course details</legend>

            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                <p>{{ $message }}</p>
                @enderror                
            </div>

            <div>
                <label for="description">Notes:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                <p>{{ $message }}</p>
                @enderror                
            </div>
            
        </fieldset>

        <button type="submit">Create</button>    
    </form>
    
</body>
</html>