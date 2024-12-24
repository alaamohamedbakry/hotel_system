@extends('admin.dashboard')

@section('cont')
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <h3 class="mb-4 text-lg text-gray-700 capitalize font-la header-text">
        <span class="highlighted-text">Booking Details</span>
    </h3>

    <div class="p-4">
        <p style="color: red;"><strong>Name:</strong> {{ $booking->guest->FirstName . ' ' . $booking->guest->LastName }}</p>
        <p style="color: red;"><strong>Email:</strong> {{ $booking->guest->email }}</p>
        <p style="color: red;"><strong>Address:</strong> {{ $booking->guest->Address }}</p>
        <p style="color: red;"><strong>Date Of Birth:</strong> {{ $booking->guest->DateOfBirth }}</p>
        <p style="color: red;"><strong>Phone:</strong> {{ $booking->guest->Phone }}</p>
    </div>

    <div class="table-responsive">
        <table id="orderdetails" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="px-6 py-4">Check-in</th>
                    <th scope="col" class="px-6 py-4">Check-out</th>
                    <th scope="col" class="px-6 py-4">Room Number</th>
                    <th scope="col" class="px-6 py-4">Room Name</th>
                    <th scope="col" class="px-6 py-4">Price</th>
                    <th scope="col" class="px-6 py-4">Capacity</th>
                    <th scope="col" class="px-6 py-4">Hotel Name</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500">
                    <td>{{ $booking->checkindate }}</td>
                    <td>{{ $booking->checkoutdate }}</td>
                    <td>{{ $booking->room->room_number }}</td>
                    <td>{{ $booking->room->roomtype->name }}</td>
                    <td>{{ $booking->room->roomtype->pricepernight }}</td>
                    <td>{{ $booking->room->roomtype->capacity }}</td>
                    <td>{{ $booking->room->hotel->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
