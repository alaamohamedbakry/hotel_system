@extends('layouts.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .header {
            background-image:url('photos/about/about-1.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .header h1 {
            font-size: 3rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .section {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }
        .section img {
            width: 200px;
            height: auto;
            border-radius: 8px;
            margin-right: 20px;
        }
        .section h2 {
            margin-top: 0;
            font-size: 2rem;
            color: #333;
        }
        .section p {
            line-height: 1.6;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to Our Hotel</h1>
    </div>

    <div class="container">
        <div class="section">
            <img src="{{asset('photos/about/OIP (1).jpeg')}}" alt="Hotel Exterior">
            <div>
                <h2>About Us</h2>
                <p>
                    Nestled in the heart of the city, our hotel offers the perfect blend of luxury and comfort. 
                    Established in 2000, we pride ourselves on providing world-class hospitality to our guests. 
                    Whether you're here for business or leisure, we ensure an unforgettable experience.
                </p>
            </div>
        </div>

        <div class="section">
            <img src="{{ asset('photos/about/5-Luxury-Hotels-that-Have-the-Most-Sumptuous-Bedroom-Suites-7-768x512.jpg') }}" alt="Luxury Room">
            <div>
                <h2>Our Rooms</h2>
                <p>
                    Our rooms are designed with elegance and equipped with modern amenities to make your stay comfortable. 
                    From cozy single rooms to luxurious suites, we have accommodations that suit every need.
                </p>
            </div>
        </div>

        <div class="section">
            <img src="{{asset('photos/about/OIP (4).jpeg')}}" alt="Fine Dining">
            <div>
                <h2>Dining Experience</h2>
                <p>
                    Indulge in a gastronomic journey with our in-house restaurants offering a variety of cuisines. 
                    Enjoy fine dining in a serene ambiance, crafted by our expert chefs.
                </p>
            </div>
        </div>

        <div class="section">
            <img src="{{ asset('photos/about/OIF.jpeg') }}" alt="Spa and Wellness">
            <div>
                <h2>Relax and Rejuvenate</h2>
                <p>
                    Take a break from the hustle and bustle and unwind at our spa and wellness center. 
                    From massages to yoga sessions, we have everything to help you relax.
                </p>
            </div>
        </div>
    </div>
</body>
</html>

@endsection
