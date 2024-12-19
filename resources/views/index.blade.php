@extends('layouts.master')
@section('content')
<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

    <body>
        <!-- msg -->
        @if (session()->has('msg'))
        <div class="modal" id="bookingModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Booking Sent</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                         {{ session('msg') }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modal = new bootstrap.Modal(document.getElementById('bookingModal'));
                modal.show();
            });
        </script>
        @endif
        <!-- Header Slider Start -->
        <div id="headerSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('photos/slider/header-slider-1.jpg') }}" alt="Royal Hotel">
                    <div class="carousel-caption">
                        <h1 class="animated fadeInRight">Nullam mattis</h1>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('photos/slider/header-slider-2.jpg') }}" alt="Royal Hotel">
                    <div class="carousel-caption">
                        <h1 class="animated fadeInLeft">Lorem ipsum</h1>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('photos/slider/header-slider-3.jpg') }}" alt="Royal Hotel">
                    <div class="carousel-caption">
                        <h1 class="animated fadeInRight">Phasellus ultrices</h1>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev" href="#headerSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#headerSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- Header Slider End -->



        <!-- Welcome Section Start -->
        <div id="welcome">
            <div class="container">
                <h3>Welcome to Royal Hotel</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida sollicitudin turpis id posuere.
                    Fusce nec rhoncus nibh. Fusce arcu libero, euismod eget commodo at, venenatis a nisi. Sed faucibus metus
                    sed leo vulputate blandit.</p>
                <a href="{{ route('booking.create') }}">Book Now</a>
            </div>
        </div>
        <!-- Welcome Section End -->

        <!-- Amenities Section Start -->
        <div id="amenities" class="home-amenities">
            <div class="container">
                <div class="amenities-section">
                    <div class="section-header">
                        <h2>Amenities & Services</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque
                            convallis,
                            enim at venenatis tincidunt.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 icons">
                            <i class="fas fa-snowflake fa-2x"></i>
                            <h3>Air Conditioner</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-md-3 col-sm-6 icons">
                            <i class="fas fa-bath fa-2x"></i>
                            <h3>Bathtub</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-md-3 col-sm-6 icons">
                            <i class="fas fa-shower fa-2x"></i>
                            <h3>Shower</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-md-3 col-sm-6 icons">
                            <i class="fas fa-tv fa-2x"></i>
                            <h3>Television</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-md-3 col-sm-6 icons">
                            <i class="fas fa-wifi fa-2x"></i>
                            <h3>WiFi</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-md-3 col-sm-6 icons">
                            <i class="fas fa-phone fa-2x"></i>
                            <h3>Telephone</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-md-3 col-sm-6 icons">
                            <i class="fas fa-martini-glass fa-2x"></i>
                            <h3>Mini Bar</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                        </div>
                        <div class="col-md-3 col-sm-6 icons">
                            <i class="fas fa-kitchen-set fa-2x"></i>
                            <h3>Kitchen</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Amenities Section Start -->

        <!-- Room Section Start -->
        <div id="rooms">
            <div class="container">
                <div class="section-header">
                    <h2>Our Rooms</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque
                        convallis,
                        enim at venenatis tincidunt.
                    </p>
                </div>
                @foreach ($rooms as $room)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="room-img">
                                        <div class="box12">
                                            @if ($room->image)
                                                <img src="{{ asset('storage/' . $room->image) }}">
                                            @endif
                                            <div class="box-content">
                                                <h3 class="title">{{ $room->roomtype->name }}</h3>
                                                <ul class="icon">
                                                    <li><a href="#" data-toggle="modal" data-target="#modal-id"><i
                                                                class="fa fa-link"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="room-des">
                                        <h3><a href="#" data-toggle="modal" data-target="#modal-id">
                                                Room_Name: {{ $room->roomtype->name }}</a>
                                        </h3>
                                        <p>desc:{{ $room->roomtype->description }}</p>
                                        <ul class="room-size">
                                            <li><i class="fa fa-arrow-right"></i>room-number:{{ $room->room_number }}</li>
                                            <li><i class="fa fa-arrow-right"></i>{{ $room->status }}</li>
                                        </ul>
                                        <ul class="room-icon">
                                            <li class="icon-1"></li>
                                            <li class="icon-2"></li>
                                            <li class="icon-3"></li>
                                            <li class="icon-4"></li>
                                            <li class="icon-5"></li>
                                            <li class="icon-6"></li>
                                            <li class="icon-7"></li>
                                            <li class="icon-8"></li>
                                            <li class="icon-9"></li>
                                            <li class="icon-10"></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="room-rate">
                                        <h3>From</h3>
                                        <h1>{{ $room->roomtype->pricepernight }}</h1>
                                        <a href="#">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- Room Section End -->

        <!-- Modal for Room Section Start -->
        <div id="modal-id" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="port-slider">
                                    <div><img src="{{ asset('photos/room-slider/room-1.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-2.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-3.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-4.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-5.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-6.jpg') }}"></div>
                                </div>
                                <div class="port-slider-nav">
                                    <div><img src="{{ asset('photos/room-slider/room-1.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-2.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-3.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-4.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-5.jpg') }}"></div>
                                    <div><img src="{{ asset('photos/room-slider/room-6.jpg') }}"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <h2>Lorem ipsum dolor</h2>
                                <p>
                                    Lorem ipsum dolor viverra purus imperdiet rhoncus imperdiet. Suspendisse vulputate
                                    condimentum ligula sollicitudin hendrerit. Phasellus luctus, elit et ultrices
                                    interdum,
                                    neque mi pellentesque massorci. Nam in cursus ex, nec mattis lectus. Curabitur quis
                                    elementum nunc. Mauris iaculis, justo eu aliquam sagittis, arcu eros cursus libero,
                                    sit
                                    amet eleifend dolor odio at lacus.
                                </p>
                                <div class="modal-link">
                                    <a href="#">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for Room Section End -->

        <!-- Subscribe Section Start -->
        <div id="subscribe">
            <div class="container">
                <div class="section-header">
                    <h2>Subscribe for Special Offer</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque
                        convallis,
                        enim at venenatis tincidunt.
                    </p>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="subscribe-form">
                            <form>
                                <input type="email" required="required" placeholder="Enter your email here" />
                                <button>submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Subscribe Section End -->

        <!-- Review Section Start -->

        <!-- Review Section End -->
        <!-- Call Section Start -->
        <div id="call-us">
            <div class="container">
                <div class="section-header">
                    <h2>Click Below to Call Us</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque
                        convallis,
                        enim at venenatis tincidunt.
                    </p>
                </div>
                <div class="row">
                    <div class="col-12">
                        @foreach ($hotels as $hotel)
                            @if ($hotel->id == 2)
                                <a href="tel:+{{ $hotel->phone }}">{{ $hotel->phone }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <!-- Call Section End -->


        <!-- Footer Section End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>



        <!-- Booking Javascript File -->
        <script src="{{ asset('js/booking.js') }}"></script>
        <script src="{{ asset('js/jqBootstrapValidation.min.js') }}"></script>

        <!-- Main Javascript File -->
        <script src="{{ asset('js/main.js') }}"></script>
    </body>

    </html>




@endsection
