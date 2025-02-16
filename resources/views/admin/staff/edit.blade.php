@extends('admin.dashboard')

@section('cont')
    @if (session()->has('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <div class="container mt-4">
        <h2 class="mb-4 text-center">
            <span style="color: red;">Edit</span>
            <span style="color: blue;">staff </span>
        </h2>
        <form class="row g-3" method="POST" action="{{route('staff.update',$staff->id)}}">
            @csrf
            @method('PUT') <!-- تأكد من استخدام PUT هنا -->
            <!-- Name -->
            <div class="col-md-6">
                <label for="First_name" class="form-label">First_name</label>
                <input type="text" class="form-control" id="First_name" name="First_name"
                    value="{{ $staff->First_name }}" placeholder="Enter First_name" required>
            </div>
            <div class="col-md-6">
                <label for="Last_name" class="form-label">Last_name</label>
                <input type="text" class="form-control" id="status" name="Last_name" value="{{ $staff->Last_name }}"
                    required>
            </div>
            <div class="col-md-6">
                <label for="position" class="form-label">position</label>
                <input type="text" class="form-control" id="position" name="position" value="{{ $staff->position }}"
                    required>
            </div>
            <div class="col-md-6">
                <label for="salary" class="form-label">salary</label>
                <input type="text" class="form-control" id="salary" name="salary" value="{{ $staff->salary }}"
                    required>
            </div>
            <div class="col-md-6">
                <label for="DateOfBirth" class="form-label">DateOfBirth</label>
                <input type="date" class="form-control" id="status" name="DateOfBirth" value="{{ $staff->DateOfBirth }}"
                    required>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $staff->phone }}"
                    required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $staff->email }}"
                    required>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="text-muted">Leave empty if you don't want to change the password</small>
            </div>
            
            <div class="col-md-6">
                <label for="hire_date" class="form-label">hire_date</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" value="{{ $staff->hire_date }}"
                    required>
            </div>
            <div class="col-md-6">
                <label for="hotel_id">Hotel Name</label>
                <input type="text" class="form-control" id="hotel_id" name="hotel_id" value="{{ $staff->hotel->name }}"
                    readonly>
                    <input type="hidden" name="hotel_id" value="{{ $staff->hotel->id }}">
                @error('hotel_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <!-- Submit Button -->
            <div class="text-center col-12">
                <button type="submit" class="btn btn-primary">Save Edit</button>
            </div>
        </form>
    </div>
@endsection
