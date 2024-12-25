<head>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* عام: إعدادات Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* شريط التصفح الرئيسي */
        #header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            position: relative;
            z-index: 100;
        }

        /* الشعار */
        #header .logo img {
            height: 40px;
            transition: transform 0.3s ease;
        }

        #header .logo img:hover {
            transform: scale(1.1);
        }

        /* قائمة التنقل */
        nav.main-menu {
            flex-grow: 1;
            margin-left: 50px;
        }

        nav.main-menu ul {
            list-style: none;
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 15px;
            font-size: 16px;
            color: #555;
        }

        nav.main-menu ul li a {
            text-decoration: none;
            transition: color 0.3s ease;
            color: #555;
        }

        nav.main-menu ul li a:hover {
            color: #1f2937;
        }

        /* إعدادات الـ Dropdown */
        #dropdownCustomerButton,
        #dropdownUserButton {
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 10px 10px;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;

        }

        #dropdownCustomerButton:hover,
        #dropdownUserButton:hover {
            background-color: #f1f5f9;
        }

        #dropdownCustomerMenu,
        #dropdownUserMenu {
            display: none;
            position: absolute;
            right: 10px;
            margin-top: 5px;
            width: 150px;
            background-color: white;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 8px 0;
        }

        #dropdownCustomerMenu a,
        #dropdownUserMenu a {
            padding: 8px 12px;
            text-decoration: none;
            color: #555;
            transition: background-color 0.3s ease;
        }

        #dropdownCustomerMenu a:hover,
        #dropdownUserMenu a:hover {
            background-color: #f9fafb;
            color: #333;
        }

        /* تأثير التحويل في عرض الموبايل */
        @media (max-width: 768px) {
            nav.main-menu ul {
                flex-direction: column;
                align-items: flex-start;
                background-color: white;
                border-radius: 5px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 10px;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
            }

            nav.main-menu ul li {
                margin: 5px 0;
            }
        }
        .welcome-button {
        display: flex;
        align-items: center;
        background-color: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        padding: 6px 12px;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        font-size: 14px;
        gap: 20px; /* مسافة بين النصوص */
    }

    .welcome-button:hover {
        background-color: #f1f5f9;
    }

    .user-name {
        font-weight: bold;
        color: #333;
    }
    </style>
</head>
<header id="header">
    <a href="{{ route('home.index') }}" class="logo"><img src="{{ asset('photos/logo.jpg') }}" alt="logo"></a>
    <div class="mobile-menu-btn"><i class="fa fa-bars"></i></div>

    <nav class="main-menu top-menu">
        <ul>
            <li class="active"><a href="{{ route('home.index') }}">Home</a></li>
            <li><a href="{{ route('about_us') }}">About Us</a></li>
            <li><a href="{{ route('room.index') }}">Rooms</a></li>
            <li><a href="{{ route('review') }}">Reviews</a></li>
            <li><a href="{{ route('booking.create') }}">Booking</a></li>
            <li>
                @if (Auth::guard('guest-hotel')->check())
                    <div class="relative inline-block text-left">
                        <button id="dropdownCustomerButton"  class="welcome-button">Welcome, {{ Auth::guard('guest-hotel')->user()->name }}</button>
                        <div id="dropdownCustomerMenu">
                            <a href="{{ route('guest_logout') }}">Log Out</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('guest_login') }}">Login</a>
                @endif
            </li>
        </ul>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const customerButton = document.getElementById('dropdownCustomerButton');
        const customerMenu = document.getElementById('dropdownCustomerMenu');


        if (customerButton) {
            customerButton.onclick = () => customerMenu.style.display = customerMenu.style.display === "block" ? "none" : "block";
        }

        window.onclick = function(e) {
            if (!e.target.matches('#dropdownCustomerButton')) customerMenu.style.display = "none";
            if (!e.target.matches('#dropdownUserButton')) userMenu.style.display = "none";
        };
    });
</script>
