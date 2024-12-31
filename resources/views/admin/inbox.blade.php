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
<table class="table table-striped table-hover" id="ReviewTable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col">Created_at</th>
            <th scope="col">Updated_at</th>
            <th scope="col">Send email</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reviews as $review)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $review->name }}</td>
                <td>{{$review->email }}</td>
                <td>{{ $review->phone }}</td>
                <td>{{ $review->subject }}</td>
                <td>{{ $review->message }}</td>
                <td>{{ $review->created_at }}</td>
                <td>{{ $review->updated_at }}</td>
                <td><a class="btn btn-success" href="{{ route('send_email',$review->id) }}">
                    <i class="fa-solid fa-inbox" style="color:black;"></i> Send Email</a></td>
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
    $('#ReviewTable').DataTable();
});
</script>
@endsection
