@extends('admin.dashboard')
@section('cont')
    <div id="booking" class="py-4">
        <div class="container">
            <div class="mb-4 text-center section-header">
                <h2>staff Form</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="shadow card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('staff.store') }}" >
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="First_name">First_name</label>
                                        <input type="text" class="form-control" id="First_name" name="First_name"
                                            value="{{ old('First_name') }}" placeholder="Enter First_name">
                                        @error('First_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="Last_name">Last_name</label>
                                        <input type="text" class="form-control" id="First_name" name="Last_name"
                                            value="{{ old('Last_name') }}" placeholder="Enter Last_name">
                                        @error('Last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="position">position</label>
                                        <input type="text" class="form-control" id="First_name" name="position"
                                            value="{{ old('position') }}" placeholder="Enter position">
                                        @error('position')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="salary">salary</label>
                                        <input type="text" class="form-control" id="First_name" name="salary"
                                            value="{{ old('salary') }}" placeholder="Enter salary">
                                        @error('salary')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="DateOfBirth">DateOfBirth</label>
                                        <input type="date" class="form-control" id="First_name" name="DateOfBirth"
                                            value="{{ old('DateOfBirth') }}" placeholder="Enter DateOfBirth">
                                        @error('DateOfBirth')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone">phone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone') }}" placeholder="Enter phone">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" placeholder="Enter email">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text">password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="{{ old('password') }}" placeholder="Enter password">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype Password" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="hire_date">hire_date</label>
                                        <input type="date" class="form-control" id="hire_date" name="hire_date"
                                            value="{{ old('hire_date') }}" placeholder="Enter hire_date">
                                        @error('hire_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Hotel Name -->
                                    <div class="form-group col-md-6">
                                        <label for="hotel_id">Hotel Name</label>
                                        <select id="hotel_id" name="hotel_id" class="form-control">
                                            <option selected disabled value="">Select Hotel</option>
                                            @foreach ($hotel as $h)
                                                <option value="{{ $h->id }}"
                                                    {{ old('hotel_id') == $h->id ? 'selected' : '' }}>
                                                    {{ $h->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('hotel_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="roles">Roles</label>
                                    <select name="roles[]" id="roles" class="form-control" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-4 text-center form-group">
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
