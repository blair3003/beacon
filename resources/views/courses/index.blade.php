<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses | BEACON</title>
</head>
<body>
    <h1>Courses</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>                             
            </tr>
            @endforeach                            
        </tbody>
    </table>
    
</body>
</html>
