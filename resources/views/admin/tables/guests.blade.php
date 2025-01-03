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
                <th scope="col">First_Name</th>
                <th scope="col">Last_Name</th>
                <th scope="col">Address</th>
                <th scope="col">Date_of_birth</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($guests as $guest)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$guest->FirstName }}</td>
                    <td>{{ $guest->LastName }}</td>
                    <td>{{ $guest->Address }}</td>
                    <td>{{ $guest->DateOfBirth }}</td>
                    <td>{{ $guest->Phone }}</td>
                    <td>{{ $guest->email }}</td>
                    <td class="action-buttons">
                        <a href="">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="">
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
