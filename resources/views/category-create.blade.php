<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <input type="text" name="name" requried>
        <br>
        <select name="parent_id" id="parent_id">
            <option value="">Select Category</option>
            @forelse ($categories_list as  $child)
                <option value="{{ $child->id }}">{{ $child->name }}</option>
                @if (count($child->recursiveChildren))
                @include('subcategories',['subcategories'=>$child->recursiveChildren,'child_name'=>$child->name])
                @endif
            @empty
            @endforelse
        </select>
        <br>
        <button type="submit">Save</button>
    </form>
    <table>
        <tr>
            <th>Name</th>
            <th>ParentId</th>
        </tr>
        @forelse ($categories as $category )
            <tr>
                <th>{{ $category->name }}</th>
                <th>{{ $category->parent_id ?? '---' }}</th>
            </tr>
        @empty
            
        @endforelse
    </table>
</body>
</html>