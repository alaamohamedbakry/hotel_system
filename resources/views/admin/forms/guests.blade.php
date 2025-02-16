@extends('admin.dashboard')

@section('cont')
    @if (session()->has('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <form action="{{ route('guest.store') }}" method="POST">
        @csrf
    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="FirstName">First Name</label>
                    <input type="text" name="FirstName" id="FirstName" value="{{ old('FirstName') }}" class="form-control">
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="form-group">
                    <label for="LastName">Last Name</label>
                    <input type="text" name="LastName" id="LastName" value="{{ old('LastName') }}" class="form-control">
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="DateOfBirth">Date of Birth</label>
                    <input type="date" name="DateOfBirth" id="DateOfBirth" value="{{ old('DateOfBirth') }}" class="form-control">
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Phone">Phone</label>
                    <input type="text" name="Phone" id="Phone" value="{{ old('Phone') }}" class="form-control">
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Address">Address</label>
                    <textarea name="Address" id="Address" class="form-control">{{ old('Address') }}</textarea>
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
            </div>
        </div>


        <button type="submit" class="shadow btn btn-success btn-lg w-90">Create New Guest</button>
    </form>    
@endsection