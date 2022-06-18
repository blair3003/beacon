<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events | BEACON</title>
</head>
<body>
    <h1>Events</h1>
    <table style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>Course</th>
                <th>Venue</th>
                <th>Start Date</th>
                <th>Start Time</th>
                <th>End Date</th>
                <th>End Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->course->title }}</td>
                <td>{{ $event->venue->name }}</td>
                <td>{{ $event->start_date }}</td>                                
                <td>{{ $event->start_time }}</td>                                
                <td>{{ $event->end_date }}</td>                                
                <td>{{ $event->end_time }}</td>                                
            </tr>
            @endforeach                            
        </tbody>
    </table>
    
</body>
</html>
