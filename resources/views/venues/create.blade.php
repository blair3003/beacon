<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Venue | BEACON</title>
</head>
<body>
    <h1>Create Venue</h1>
    <form method="POST" action="/venues">
        @csrf
        <fieldset>
            <legend>Enter venue details</legend>

            <div>
                <label for="title">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                <p>{{ $message }}</p>
                @enderror                
            </div>
            
        </fieldset>

        <button type="submit">Create</button>    
    </form>
    
</body>
</html>