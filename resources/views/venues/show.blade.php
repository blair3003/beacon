<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue | BEACON</title>
</head>
<body>
    <h1>Venue #{{ $venue->id }}</h1>

    <div><strong>Name:</strong> {{ $venue->name }}</div>

    <div>
        <a href="/venues/{{  $venue->id }}/edit">Edit</a>

        <form method="POST" action="/venues/{{ $venue->id }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

        <a href="/venues">Back</a>        
    </div>

    <x-modal />
    
</body>
</html>
