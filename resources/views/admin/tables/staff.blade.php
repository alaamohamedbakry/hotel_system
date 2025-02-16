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
                <th scope="col">position</th>
                <th scope="col">salary</th>
                <th scope="col">Date_of_birth</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">hire_date</th>
                <th scope="col">Hotel_name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($staff as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->First_name }}</td>
                    <td>{{ $s->Last_name }}</td>
                    <td>{{ $s->position }}</td>
                    <td>{{ $s->salary }}</td>
                    <td>{{ $s->DateOfBirth }}</td>
                    <td>{{ $s->phone }}</td>
                    <td>{{ $s->email }}</td>
                    <td>{{ $s->hire_date }}</td>
                    <td>{{ $s->hotel->name }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('staff.edit', $s->id) }}">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('staff.destroy', $s->id) }}">
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
