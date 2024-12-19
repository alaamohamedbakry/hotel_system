<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ground.css') }}">
</head>
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<body>
    <div class="body"></div>
    <div class="grad"></div>
    <div class="header">
        <div>Royal<span>Hotel</span></div>
    </div>
    <br>
    <form method="post" action="{{ route('guest_login_submit') }}">
        @csrf
        <div class="login">
            <input type="text" placeholder="username" name="email"><br>
            <input type="password" placeholder="password" name="password"><br>
            <input type="submit" value="Login">
            <div class="login-link">
                <p style="color: white">Are you don not have an account?<a class="px-4 py-2 text-white bg-gray-500 rounded button" href="{{ route('guest.register') }}" >Register</a>
                </p>
            </div>
    </form>
</div>
</body>

</html>
