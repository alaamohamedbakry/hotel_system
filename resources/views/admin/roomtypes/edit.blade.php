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
            <span style="color: blue;">Room Type</span>
        </h2>
        <form class="row g-3" method="POST" action="{{ route('roomtype.update', $roomtype->id) }}">
            @csrf
            @method('PUT') <!-- تأكد من استخدام PUT هنا -->
            <!-- Name -->
            <div class="col-md-6">
                <label for="name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ $roomtype->name }}" placeholder="Enter Room Name" required>
            </div>

            <!-- Price Per Night -->
            <div class="col-md-6">
                <label for="pricepernight" class="form-label">Price Per Night</label>
                <input type="number" class="form-control" id="pricepernight" name="pricepernight"
                    value="{{ $roomtype->pricepernight }}" placeholder="Enter Price Per Night" required>
            </div>

            <!-- Capacity -->
            <div class="col-md-6">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" class="form-control" id="capacity" name="capacity"
                    value="{{ $roomtype->capacity }}" placeholder="Enter Capacity" required>
            </div>

            <!-- Description -->
            <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                    placeholder="Enter Room Description" required>{{ $roomtype->description }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary px-5">Save Edit</button>
            </div>
        </form>
    </div>
@endsection
