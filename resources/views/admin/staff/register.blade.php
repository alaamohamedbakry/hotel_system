<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Registration</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="text-center card-header">
                <h1><b>Staff</b> Registration</h1>
                <p class="text-muted">Complete the form to register as staff</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('staff.register') }}">
                    @csrf
                    <!-- Row for First and Last Name -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="First_name">First Name</label>
                            <input type="text" name="First_name" class="form-control" placeholder="First Name" value="{{ old('First_name') }}" required>
                            @error('First_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="Last_name">Last Name</label>
                            <input type="text" name="Last_name" class="form-control" placeholder="Last Name" value="{{ old('Last_name') }}" required>
                            @error('Last_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Position and Salary -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="position">Position</label>
                            <input type="text" name="position" class="form-control" placeholder="Position" value="{{ old('position') }}" required>
                            @error('position')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="salary">Salary</label>
                            <input type="text" name="salary" class="form-control" placeholder="Salary" value="{{ old('salary') }}" required>
                            @error('salary')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Date of Birth and Phone -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="DateOfBirth">Date of Birth</label>
                            <input type="date" name="DateOfBirth" class="form-control" value="{{ old('DateOfBirth') }}" required>
                            @error('DateOfBirth')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Email and Password -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Confirmation -->
                    <div class="mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype Password" required>
                    </div>

                    <!-- Hire Date and Hotel -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="hire_date">Hire Date</label>
                            <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date') }}" required>
                            @error('hire_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="hotel_id">Hotel</label>
                            <select class="form-control" id="hotel_id" name="hotel_id" required>
                                <option value="">Select a Hotel</option>
                                @foreach($hotel as $h)
                                    <option value="{{ $h->id }}">{{ $h->name }}</option>
                                @endforeach
                            </select>
                            @error('hotel_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Register Button -->
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <a href="#" class="text-muted">Already registered? Log in</a>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
