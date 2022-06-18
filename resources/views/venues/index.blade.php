<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venues | BEACON</title>
</head>
<body>
    <h1>Venues</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venues as $venue)
            <tr>
                <td>{{ $venue->name }}</td>                              
            </tr>
            @endforeach                            
        </tbody>
    </table>
    
</body>
</html>
