@extends('admin.dashboard')
@section('cont')
@if (session()->has('msg'))
<div class="alert alert-success">
    {{ session('msg') }}
</div>
@endif
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
    <table class="table table-striped table-hover" id="HotelTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">star</th>
                <th scope="col">Check-in</th>
                <th scope="col">Check-out</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hotels as $hotel)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->address }}</td>
                    <td>{{ $hotel->phone }}</td>
                    <td>{{ $hotel->email }}</td>
                    <td>{{ $hotel->star }}</td>
                    <td>{{ $hotel->checkin }}</td>
                    <td>{{ $hotel->checkout }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('hotel.edit', $hotel->id) }}">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('hotel.destory', $hotel->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none;border:none;color:red;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                @empty
                    <td>No data found</td>
            @endforelse

            </tr>
        </tbody>
    </table>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    $('#HotelTable').DataTable();
});
</script>
@endsection
