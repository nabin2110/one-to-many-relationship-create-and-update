<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('rooms.update',$data['record']->id) }}" method="post">
        @csrf
        @method('put')
        <label for="title">Enter Room Title</label><br>
        <input type="text" name="title" placeholder="Enter room title" value="{{ $data['record']->title ?? "" }}"><br>
        <label for="description">Enter Room description</label><br>
      <textarea name="description" id="" cols="30" rows="10">{{ $data['record']->description ?? "" }}</textarea><br>
      <a href="javascript:;" id="btn_add_facility">Add</a>
      <div class="facility_container">
        @forelse ($data['record']->roomFacilities as $facility)
        <div class="facility">
            <input type="hidden" name="name_ids[]" value="{{ $facility->id }}">
            <label for="name">Room Facilities</label>
            <input type="text" name="name[]" placeholder="Room Facilities"  value="{{ $facility->name }}"><a href="javascript:;" data-id={{ $facility->id }} class="delete_facility">Delete</a><br>
        </div>
        @empty
            
        @endforelse
        <div class="facility">
            <label for="name">Room Facilities</label>
            <input type="text" name="name[]" placeholder="Room Facilities"><br>
        </div>
      </div>
      <button type="submit">Submit</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function(){
            $('#btn_add_facility').on('click',function(){
                var html_append = '<div class="facility"><label for="name">Room Facilities</label><input type="text" name="name[]" placeholder="Room Facilities"><a href="javascript:;" class="delete_facility">Delete</a><br> </div>';
                $('.facility_container').append(html_append)
            });
           $('.facility_container').on('click','.delete_facility',function(){
                var id = $(this).attr('data-id');
                if(id){
                    $.ajax({
                        url:"{{ route('rooms.facility.delete') }}",
                        data:{'id':id},
                        success:function(success){},
                        error:function(error){console.log(error)}
                    });
                }
                $(this).closest('.facility').remove();
           })
        });
    </script>
</body>
</html>