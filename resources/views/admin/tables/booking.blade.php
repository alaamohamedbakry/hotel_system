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
    <div class="container mt-3">
        @can('manage-reservations')
            <h2 class="text-center">Bookings Table</h2>
        @endcan
        <table class="table table-striped table-hover" id="bookingTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Guest Name</th>
                    <th>Check-In Date</th>
                    <th>Check-Out Date</th>
                    <th>Room Number</th>
                    <th>Room Name</th>
                    <th>Price</th>
                    <th>Capacity</th>
                    <th>Hotel Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>details</th>
                    <th>edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
              <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->guest->FirstName . ' ' . $booking->guest->LastName }}</td>
                        <td>{{ $booking->checkindate }}</td>
                        <td>{{ $booking->checkoutdate }}</td>
                        <td>{{ $booking->room->room_number }}</td>
                        <td>{{ $booking->room->roomtype->name }}</td>
                        <td>{{ $booking->room->roomtype->pricepernight }}</td>
                        <td>{{ $booking->room->roomtype->capacity }}</td>
                        <td>{{ $booking->room->hotel->name }}</td>
                        <td>{{ $booking->created_at }}</td>
                        <td>{{ $booking->updated_at }}</td>
                        <td><a href="{{ route('booking.show', $booking->id) }}">View Details</a></td>
                        <td class="action-buttons">
                            <a href="{{ route('booking.edit', $booking->id) }}">
                                <i class="fa-solid fa-user-pen"></i>
                            </a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('booking.destroy', $booking->id) }}">
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
                        <td colspan="12" class="text-center">No data found</td>
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
            $('#bookingTable').DataTable();
        });
    </script>
@endsection
