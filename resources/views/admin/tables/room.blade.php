@extends('admin.dashboard')
@section('cont')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .room-image {
            width: 60px; /* تحديد عرض الصورة */
            height: 60px; /* تحديد ارتفاع الصورة */
            object-fit: cover; /* لتناسب الصورة داخل الإطار */
            border-radius: 5px; /* لجعل الزوايا دائرية قليلاً (اختياري) */
        }
    </style>
</head>
@if (session()->has('msg'))
<div class="alert alert-success">
    {{ session('msg') }}
</div>
@endif
<table class="table table-striped table-hover" id="RoomTable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Room_number</th>
            <th scope="col">status</th>
            <th scope="col">image</th>
            <th scope="col">Hotel_Name</th>
            <th scope="col">Roomtype</th>
            <th scope="col">Created_at</th>
            <th scope="col">Updated_at</th>
            <th scope="col">Details</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rooms as $singleRoom)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $singleRoom->room_number }}</td>
                <td>{{ $singleRoom->status }}</td>
                <td>
                    @if ($singleRoom->image)
                        <img class="room-image" src="{{ asset('storage/' . $singleRoom->image) }}" alt="">
                    @endif
                </td>
                <td>{{ $singleRoom->hotel->name }}</td>
                <td>{{ $singleRoom->roomtype->name }}</td>
                <td>{{ $singleRoom->created_at }}</td>
                <td>{{ $singleRoom->updated_at }}</td>
                <td><a href="">View Details</a></td>
                <td class="action-buttons">
                    <a href="{{ route('rooms.edit', $singleRoom->id) }}">
                        <i class="fa-solid fa-user-pen"></i>
                    </a>
                </td>
                <td>
                    <form method="post" action="{{ route('rooms.destroy', $singleRoom->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none;border:none;color:red;">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No data found</td>
            </tr>
        @endforelse
    </tbody>
</table>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    $('#RoomTable').DataTable();
});
</script>
@endsection
