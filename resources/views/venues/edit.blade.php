<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Venue | BEACON</title>
</head>
<body>
    <h1>Edit Venue</h1>
    <form method="POST" action="/venues/{{ $venue->id }}">
        @csrf
        @method('PUT')
        <fieldset>
            <legend>Edit venue details</legend>

            <div>
                <label for="title">Name:</label>
                <input type="text" id="name" name="name" value="{{ $venue->name }}">
                @error('name')
                <p>{{ $message }}</p>
                @enderror                
            </div>
            
        </fieldset>

        <button type="submit">Update</button>    
    </form>
    
</body>
</html>