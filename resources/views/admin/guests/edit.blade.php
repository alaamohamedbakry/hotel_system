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
            <span style="color: blue;">Guest</span>
        </h2>
        <form action="{{ route('guest.update', $guest->id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="FirstName">First Name</label>
                        <input type="text" name="FirstName" id="FirstName" value="{{ old('FirstName', $guest->FirstName) }}" class="form-control">
                    </div>
                </div>
        
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="LastName">Last Name</label>
                        <input type="text" name="LastName" id="LastName" value="{{ old('LastName', $guest->LastName) }}" class="form-control">
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="DateOfBirth">Date of Birth</label>
                        <input type="date" name="DateOfBirth" id="DateOfBirth" value="{{ old('DateOfBirth', $guest->DateOfBirth) }}" class="form-control">
                    </div>
                </div>
        
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Phone">Phone</label>
                        <input type="text" name="Phone" id="Phone" value="{{ old('Phone', $guest->Phone) }}" class="form-control">
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Address">Address</label>
                        <textarea name="Address" id="Address" class="form-control">{{ old('Address', $guest->Address) }}</textarea>
                    </div>
                </div>
        
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $guest->email) }}" class="form-control">
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
        
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
        
        
    </div>
@endsection
