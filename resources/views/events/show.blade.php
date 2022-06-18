<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event | BEACON</title>
</head>
<body>
    <h1>Event #{{ $event->id }}</h1>

    <div><strong>Course:</strong> {{ $event->course->title }}</div>
    <div><strong>Venue:</strong> {{ $event->venue->name }}</div>
    <div><strong>Start Date:</strong> {{ $event->start_date }}</div>
    <div><strong>Start Time:</strong> {{ $event->start_time }}</div>
    <div><strong>End Date:</strong> {{ $event->end_date }}</div>
    <div><strong>End Time:</strong> {{ $event->end_time }}</div>
    <div><strong>Notes:</strong> {{ $event->notes }}</div>
    
</body>
</html>
