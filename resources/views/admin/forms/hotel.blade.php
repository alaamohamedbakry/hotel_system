@extends('admin.dashboard')
@section('cont')
    <style>
        /* ستايل تصنيف النجوم */
        .star-rating {
            display: flex;
            direction: row-reverse;
            font-size: 30px;
            justify-content: center;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            color: #ccc;
            cursor: pointer;
            margin: 0 5px;
        }

        .star-rating input[type="radio"]:checked~label {
            color: #f39c12;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #f39c12;
        }

        /* تنسيق النموذج */
        .booking-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .booking-form .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .booking-form .control-group {
            width: 48%;
        }

        .booking-form .control-group input,
        .booking-form .control-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 10px;
            transition: border 0.3s;
        }

        .booking-form .control-group input:focus,
        .booking-form .control-group select:focus {
            border-color: #f39c12;
        }

        .booking-form .control-group label {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        .control-group .help-block {
            font-size: 12px;
            color: red;
        }

        .booking-form .button {
            text-align: center;
            margin-top: 20px;
        }

        .booking-form .button button {
            padding: 14px 30px;
            background-color: #f39c12;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .booking-form .button button:hover {
            background-color: #e67e22;
        }

        /* إضافة padding للمحتوى داخل الdiv */
        .container {
            padding: 20px;
        }

        .section-header h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .booking-form .control-group {
                width: 100%;
            }

            .booking-form .form-row {
                flex-direction: column;
            }
        }
    </style>

    <div id="booking">
        <div class="container">
            <div class="section-header">
                <h2>Hotel Form</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="booking-form">
                        <div id="success"></div>
                        <form name="sentMessage" novalidate="novalidate" method="POST" action="{{ route('hotel.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="control-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ old('name') }}" name="name" class="form-control">
                                    @error('name')
                                        <label for="name" class="help-block">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="control-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" value="{{ old('address') }}" name="address" class="form-control">
                                    @error('address')
                                        <label for="address" class="help-block">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="control-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="number" value="{{ old('phone') }}" name="phone" class="form-control">
                                    @error('phone')
                                        <label for="phone" class="help-block">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="control-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <label for="email" class="help-block">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="control-group col-md-6">
                                    <label for="checkin">Check-in</label>
                                    <input type="date" class="form-control" name="checkin" value="{{ old('checkin') }}">
                                    @error('checkin')
                                        <label for="checkin" class="help-block">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="control-group col-md-6">
                                    <label for="checkout">Check-out</label>
                                    <input type="date" class="form-control" name="checkout" value="{{ old('checkout') }}">
                                    @error('checkout')
                                        <label for="checkout" class="help-block">{{ $message }}</label>
                                    @enderror
                                </div>
                                
                                <div class="control-group col-md-12">
                                    <label for="star">Star Rating</label>
                                    <div class="star-rating">
                                        <input type="radio" id="star5" name="star" value="5" />
                                        <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>

                                        <input type="radio" id="star4" name="star" value="4" />
                                        <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>

                                        <input type="radio" id="star3" name="star" value="3" />
                                        <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>

                                        <input type="radio" id="star2" name="star" value="2" />
                                        <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>

                                        <input type="radio" id="star1" name="star" value="1" />
                                        <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="button">
                                <button type="submit" id="bookingButton">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
