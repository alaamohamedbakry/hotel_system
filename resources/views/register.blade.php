<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register / Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@200;400&family=Open+Sans:wght@600&display=swap" rel="stylesheet">
    <style>
        /* إعدادات عامة */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Exo', sans-serif;
            background: linear-gradient(to bottom, #5379fa, #a18d6c);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .form-container {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            padding: 30px 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

        .form-row {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #ccc;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="email"],
        input[type="tel"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="email"],
        input[type="tel"] {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus {
            outline: none;
            border-color: #5379fa;
            background: rgba(255, 255, 255, 0.2);
        }

        input[type="submit"] {
            background: #5379fa;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #4263c3;
        }

        .foot-lnk {
            text-align: center;
            margin-top: 10px;
        }

        .foot-lnk label {
            color: #a18d6c;
            cursor: pointer;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header div {
            font-size: 30px;
            font-weight: 400;
            color: #fff;
        }

        .header div span {
            color: #5379fa;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="header">
            <div>Royal<span>Hotel</span></div>
        </div>
        <h2> <div>Royal<span>Hotel</span></div></h2>
        <form method="post" action="{{ route('guest.register') }}">
            @csrf
            <div class="form-row">
                <label for="FirstName">First Name</label>
                <input id="FirstName" type="text" placeholder="First Name" name="FirstName" required>
            </div>
            <div class="form-row">
                <label for="LastName">Last Name</label>
                <input id="LastName" type="text" placeholder="Last Name" name="LastName" required>
            </div>
            <div class="form-row">
                <label for="DateOfBirth">Date of Birth</label>
                <input id="DateOfBirth" type="date" name="DateOfBirth" required>
            </div>
            <div class="form-row">
                <label for="Address">Address</label>
                <input id="Address" type="text" placeholder="Address" name="Address" required>
            </div>
            <div class="form-row">
                <label for="Phone">Phone</label>
                <input id="Phone" type="tel" placeholder="Phone" name="Phone" required>
            </div>
            <div class="form-row">
                <label for="email">Email</label>
                <input id="email" type="email" placeholder="Email" name="email" required>
            </div>
            <div class="form-row">
                <label for="password">Password</label>
                <input id="password" type="password" placeholder="Password" name="password" required>
            </div>
            <div class="form-row">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" placeholder="Confirm Password" name="password_confirmation" required>
            </div>
            <div class="form-row">
                <input type="submit" value="Sign Up">
            </div>
            <div class="login-link">
                <p style="color: white">Already have an account?<a class="px-4 py-2 text-white bg-gray-500 rounded button" href="{{ route('guest_login') }}" >Login</a>
                </p>
            </div>
        </form>
    </div>
</body>

</html>