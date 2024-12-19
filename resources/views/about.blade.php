@extends('layouts.master')
@section('content')
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>
    <!-- About Section Start -->
    <div id="about">
        <div class="container">
            <div class="section-header">
                <h2>About Royal Hotel</h2>
                <p>We have a lot of hotels in different places</p>
            </div>    
        </div>
        <h2 class="text-center">Hotel Places</h2>
        <table class="table table-striped table-hover" id="HotelTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Star</th>
                    <th>Check-In Date</th>
                    <th>Check-Out Date</th>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">No data found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- About Section End -->
    <div id="call-us">
        <div class="container">
            <div class="section-header">
                <h2>Click Below to Call Us</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque convallis, enim at venenatis tincidunt.</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="tel:+12345678900">+1 234 567 8900</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call Section End -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#HotelTable').DataTable();
        });
    </script>
</body>
@endsection
