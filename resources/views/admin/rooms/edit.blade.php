@extends('admin.dashboard')

@section('cont')
    @if (session()->has('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <div class="container mt-4">
        <h2 class="text-center mb-4">
            <span style="color: red;">Edit</span>
            <span style="color: blue;">Room </span>
        </h2>
        <form class="row g-3" method="POST" action="{{ route('rooms.update', $room->id) }}">
            @csrf
            @method('PUT') <!-- تأكد من استخدام PUT هنا -->
            <!-- Name -->
            <div class="col-md-6">
                <label for="room_number" class="form-label">Room Number</label>
                <input type="text" class="form-control" id="room_number" name="room_number"
                    value="{{ $room->room_number }}" placeholder="Enter Room Number" required>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $room->status }}"
                    required>
            </div>
            <div class="col-md-6">
                <label for="hotel_id">Hotel Name</label>
                <input type="text" class="form-control" id="hotel_id" name="hotel_id" value="{{ $room->hotel->name }}"
                    readonly>
                    <input type="hidden" name="hotel_id" value="{{ $room->hotel->id }}">
                @error('hotel_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="roomtypes_id">Roomtype Name</label>
                <input type="text" class="form-control" id="roomtypes_id" name="roomtypes_id"
                    value="{{ $room->roomtype->name }}" readonly>
                    <input type="hidden" name="roomtypes_id" value="{{ $room->roomtype->id }}">

                @error('roomtypes_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6">
                @if ($room->image)
                <img class="rounded" src="{{ asset('storage/' . $room->image) }}" alt=""
                style="width: 100px; height: 100px; object-fit: cover;">
                @endif
            </div>
            <!-- Submit Button -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Save Edit</button>
            </div>
        </form>
    </div>
@endsection
