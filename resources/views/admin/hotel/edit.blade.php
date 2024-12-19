@extends('admin.dashboard')
@section('cont')
    @if (session()->has('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <body>
        <div class="container mt-4">
            <h2 class="text-center mb-4">
                <span style="color: red;">Edit</span>
                <span style="color: blue;">Hotel</span>
            </h2>

            <form class="row g-3" method="POST" action="{{ route('hotel.update', $hotel->id) }}">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{  $hotel->name }}" placeholder="Enter hotel name" required>
                </div>

                <!-- Address -->
                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{  $hotel->address }}" placeholder="Enter address" required>
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                        value="{{  $hotel->phone }}" placeholder="Enter phone number" required>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{  $hotel->email }}" placeholder="Enter email" required>
                </div>

                <!-- Star -->
                <div class="col-md-4">
                    <label for="star" class="form-label">Star</label>
                    <input type="number" class="form-control" id="star" name="star"
                        value="{{  $hotel->star }}" min="1" max="5" required>
                </div>

                <!-- Check-in -->
                <div class="col-md-4">
                    <label for="checkin" class="form-label">Check-in</label>
                    <input type="date" class="form-control" id="checkin" name="checkin"
                        value="{{  $hotel->checkin }}" required>
                </div>

                <!-- Check-out -->
                <div class="col-md-4">
                    <label for="checkout" class="form-label">Check-out</label>
                    <input type="date" class="form-control" id="checkout" name="checkout"
                        value="{{$hotel->checkout }} " required>
                </div>

                <!-- Submit Button -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Save Edit</button>
                </div>
            </form>
        </div>
    </body>
@endsection
