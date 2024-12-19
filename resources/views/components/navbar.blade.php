<header id="header">
        <a href="{{ route('home.index') }}" class="logo"><img src="{{ asset('photos/logo.jpg') }}" alt="logo"></a>
       
        <div class="mobile-menu-btn"><i class="fa fa-bars"></i></div>
        <nav class="main-menu top-menu">
            <ul>
                <li class="active"><a href="{{ route('home.index') }}">Home</a></li>
                <li><a href="{{ route('about_us') }}">About Us</a></li>
                <li><a href="{{ route('room.index') }}">Rooms</a></li>
                <li><a href="amenities.html">Amenities</a></li>
                <li><a href="{{ route('booking.create') }}">Booking</a></li>
                <li><a href="{{ route('guest_login') }}">Login</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </nav>
</header>