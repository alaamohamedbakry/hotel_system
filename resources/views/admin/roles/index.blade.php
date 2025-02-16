@extends('admin.dashboard')
@section('cont')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped table-hover" id="RoomTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td class="action-buttons">

                            <a href="{{ route('roles.edit', $role->id) }}">
                                <i class="fa-solid fa-user-pen"></i>
                            </a>

                    </td>
                    <td>

                            <form method="post" action="{{ route('roles.destroy', $role->id) }}">
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
                    <td colspan="10">No roles found</td>
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
