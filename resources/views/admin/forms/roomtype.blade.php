@extends('admin.dashboard')
@section('cont')
    <div id="booking" class="py-4">
        <div class="container">
            <div class="section-header text-center mb-4">
                <h2>Room Type Form</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('roomtype.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-row">
                                    <!-- Name -->
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name') }}" placeholder="Enter room type name">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Price Per Night -->
                                    <div class="form-group col-md-6">
                                        <label for="pricepernight">Price Per Night</label>
                                        <input type="number" class="form-control" id="pricepernight" name="pricepernight"
                                            value="{{ old('pricepernight') }}" placeholder="Enter price per night">
                                        @error('pricepernight')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Capacity -->
                                    <div class="form-group col-md-6">
                                        <label for="capacity">Capacity</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity"
                                            value="{{ old('capacity') }}" placeholder="Enter capacity">
                                        @error('capacity')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Description -->
                                    <div class="form-group col-md-12">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                            placeholder="Enter room type description">{{ old('description') }}</textarea>
                                        @error('description')
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
