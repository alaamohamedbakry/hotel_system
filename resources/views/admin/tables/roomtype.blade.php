@extends('admin.dashboard')

@section('cont')
@if (session()->has('msg'))
<div class="alert alert-success">
    {{ session('msg') }}
</div>
@endif

<div class="table-responsive">
    <table id="RoomTypeTable" class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">NAME</th>
                <th scope="col">Description</th>
                <th scope="col">PricePerNight</th>
                <th scope="col">Capacity</th>
                <th scope="col">Created_at</th>
                <th scope="col">Updated_at</th>
                <th scope="col">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roomtypes as $roomtype)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $roomtype->name }}</td>
                    <td>{{ $roomtype->description }}</td>
                    <td>{{ $roomtype->pricepernight }}</td>
                    <td>{{ $roomtype->capacity }}</td>
                    <td>{{ $roomtype->created_at }}</td>
                    <td>{{ $roomtype->updated_at }}</td>

                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('roomtype.edit', $roomtype->id) }}" class="mx-1 btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="post" action="{{ route('roomtype.destroy', $roomtype->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mx-1 btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No data found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    $('#RoomTypeTable').DataTable();
});
</script>
@endsection
