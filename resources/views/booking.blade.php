@extends('layouts.master')
@section('content')

    <body>


        <!-- Search Section Start -->
        <div id="search" style="background: #f2f2f2;">
            <div class="container">
                <div class="form-row">
                    <div class="control-group col-md-3">
                        <label>Check-In</label>
                        <div class="form-group">
                            <div class="input-group date" id="date-3" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#date-3" />
                                <div class="input-group-append" data-target="#date-3" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group col-md-3">
                        <label>Check-Out</label>
                        <div class="form-group">
                            <div class="input-group date" id="date-4" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#date-4" />
                                <div class="input-group-append" data-target="#date-4" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group col-md-3">
                        <div class="form-row">
                            <div class="control-group col-md-6">
                                <label>Adult</label>
                                <select class="custom-select">
                                    <option selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="control-group col-md-6 kid">
                                <label>Kid</label>
                                <select class="custom-select">
                                    <option selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group col-md-3">
                        <button class="btn btn-block">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Section End -->

        <!-- Booking Section Start -->
        <div id="booking">
            <div class="container">
                <div class="section-header">
                    <h2>Room Booking</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque convallis,
                        enim at venenatis tincidunt.
                    </p>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="booking-form">
                            <div id="success"></div>
                            <form name="sentMessage" id="bookingForm" novalidate="novalidate" method="post"
                                action="{{ route('booking.store') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="control-group col-md-6">
                                        <label>Check-In</label>
                                        <input type="date" name="checkindate" id="checkin-date"
                                            class="form-control checkin-date" required />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group col-md-6">
                                        <label>Check-Out</label>
                                        <input type="date" name="checkoutdate" id="checkout-date" class="form-control"
                                            required />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="room_id">Available Rooms</label>
                                        <select class="form-control room-list" name="room_id" id="room_id">
                                            <option value="">Select room</option>
                                        </select>
                                        @error('room_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="button"><button type="submit" id="bookingButton">Book Now</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking Section End -->

        <!-- Footer Section Start -->
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="social">
                            <a href="">
                                <li class="fa-brands fa-instagram"></li>
                            </a>
                            <a href="">
                                <li class="fa-brands fa-twitter"></li>
                            </a>
                            <a href="">
                                <li class="fa-brands fa-facebook"></li>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Section End -->



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".checkin-date").on('blur', function() {
                    var _checkindate = $(this).val();
                    console.log("Check-in date:", _checkindate); // Debugging
                    $.ajax({
                        url: "/admin/booking/avilable-rooms/" + _checkindate,
                        datatype: 'json',
                        beforeSend: function() {
                            $('.room-list').html('<option>----Loading----</option>');
                        },
                        success: function(res) {
                            var _html = '';
                            $.each(res.data, function(index, row) {
                                _html += '<option value="' + row.id + '">' + row
                                    .room_number + '</option>';
                            });
                            $('.room-list').html(_html);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                        }
                    });
                });
            });
        </script>


    </body>
@endsection
