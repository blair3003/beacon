<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event | BEACON</title>
</head>
<body>
    <h1>Event #{{ $event->id }}</h1>

    <div><strong>Course:</strong> <a href="/courses/{{  $event->course->id }}">{{ $event->course->title }}</a></div>
    <div><strong>Venue:</strong> <a href="/venues/{{ ($event->venue->id) ?? '' }}">{{ ($event->venue->name) ?? '' }}</a></div>
    <div><strong>Start Date:</strong> {{ $event->start_date }}</div>
    <div><strong>Start Time:</strong> {{ $event->start_time }}</div>
    <div><strong>End Date:</strong> {{ $event->end_date }}</div>
    <div><strong>End Time:</strong> {{ $event->end_time }}</div>
    <div><strong>Notes:</strong> {{ $event->notes }}</div>

    <div>
        <a href="/events/{{ $event->id }}/edit">Edit</a>

        <form method="POST" action="/events/{{ $event->id }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

        <a href="/events">Back</a>        
    </div>

    <x-modal />
    
</body>
</html>
