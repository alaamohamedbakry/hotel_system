@extends('layouts.master')

@section('content')
<head>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
</head>

<style>
    /* تصميم الصفحة العامة */
    body {
        justify-content: center;
        align-items: center;
    }

    /* تصميم صندوق البحث */
    .search-box {
        display: flex;
        align-items: center;
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 25px;
        padding: 5px 15px;
        width: 300px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
    }

    .search-box .icon {
        color: #888;
        margin-right: 10px;
    }

    .search-box input {
        border: none;
        outline: none;
        flex: 1;
        font-size: 16px;
    }

    .search-box input::placeholder {
        color: #aaa;
    }

    /* تصميم الـ pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination a,
    .pagination span {
        color: #007bff;
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

    .pagination a:hover {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination .active span {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
</style>

<body>
    <!-- صندوق البحث -->
    <form action="{{ route('room.index') }}" method="GET" class="relative flex w-full max-w-xl">
        <div class="search-box">
            <span class="icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="search" id="search"
                   value="{{ request()->get('search') }}"
                   placeholder="Search">
            <button class="px-8 text-white transition border bg-primary border-primary rounded-r-md hover:bg-transparent hover:text-primary">
                Search
            </button>
        </div>
    </form>

    <!-- قسم عرض الغرف -->
    <div id="rooms" class="container">
        <div class="mb-4 text-center section-header">
            <h2>Our Rooms</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque convallis, enim at venenatis tincidunt.
            </p>
        </div>

        @if($rooms->isEmpty())
            <p class="text-center">No rooms found matching your search criteria.</p>
        @else
            @foreach ($rooms as $room)
                <div class="mb-4 row">
                    <div class="col-md-3">
                        <div class="room-img">
                            <div class="box12">
                                @if ($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" class="img-fluid" alt="Room Image">
                                @endif
                                <div class="box-content">
                                    <h3 class="title">{{ $room->roomtype->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="room-des">
                            <h3>Room Name: {{ $room->roomtype->name }}</h3>
                            <p>Description: {{ $room->roomtype->description }}</p>
                            <ul class="room-size">
                                <li><i class="fa fa-arrow-right"></i> Room Number: {{ $room->room_number }}</li>
                                <li><i class="fa fa-arrow-right"></i> Status: {{ $room->status }}</li>
                                <li><i class="fa fa-arrow-right"></i> Hotel Name: {{ $room->hotel->name }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center room-rate">
                            <h3>From</h3>
                            <h1>${{ $room->roomtype->pricepernight }}</h1>
                            <a href="{{ route('booking.create') }}" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $rooms->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</body>
@endsection
