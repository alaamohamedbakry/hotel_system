@extends('admin.dashboard')
@section('cont')
    <div id="booking" class="py-4">
        <div class="container">
            <div class="section-header text-center mb-4">
                <h2>Room Form</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('rooms.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <!-- Room Number -->
                                    <div class="form-group col-md-6">
                                        <label for="room_number">Room Number</label>
                                        <input type="number" class="form-control" id="room_number" name="room_number"
                                            value="{{ old('room_number') }}" placeholder="Enter room number">
                                        @error('room_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group col-md-6">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" id="status" name="status"
                                            value="{{ old('status') }}" placeholder="Enter status">
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Image -->
                                    <div class="form-group col-md-12">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Hotel Name -->
                                    <div class="form-group col-md-6">
                                        <label for="hotel_id">Hotel Name</label>
                                        <select id="hotel_id" name="hotel_id" class="form-control">
                                            <option selected disabled value="">Select Hotel</option>
                                            @foreach ($hotels as $hotel)
                                                <option value="{{ $hotel->id }}"
                                                    {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                                    {{ $hotel->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('hotel_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Room Type -->
                                    <div class="form-group col-md-6">
                                        <label for="roomtypes_id">Room Type</label>
                                        <select id="roomtypes_id" name="roomtypes_id" class="form-control">
                                            <option selected disabled value="">Select Room Type</option>
                                            @foreach ($roomtype as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ old('roomtypes_id') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('roomtypes_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="btn btn-primary w-50">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
