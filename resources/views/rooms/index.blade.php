<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('rooms.create') }}">Create Room</a>

    <table border="1">
        <thead>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Room Facilities</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $record->title }}</td>
                    <td>
                    @forelse ($record->roomFacilities as $facility )
                        <span style="border:1px solid black;padding:5px;">{{ $facility->name }}</span>
                    @empty
                        
                    @endforelse
                </td>
                    <td>
                        <a href="{{ route('rooms.edit',$record->id) }}">Edit</a>
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
    {{ $records->links() }}
</body>
</html>