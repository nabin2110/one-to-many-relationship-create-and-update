<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('rooms.store') }}" method="post">
        @csrf
        <label for="title">Enter Room Title</label><br>
        <input type="text" name="title" placeholder="Enter room title"><br>
        <label for="description">Enter Room description</label><br>
      <textarea name="description" id="" cols="30" rows="10"></textarea><br>
      <a href="javascript:;" id="btn_add_facility">Add</a>
      <div class="facility_container">
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
                $(this).closest('.facility').remove();
           })
        });
    </script>
</body>
</html>