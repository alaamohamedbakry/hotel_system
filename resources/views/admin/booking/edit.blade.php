@extends('admin.dashboard')
@section('cont')
    @if (session()->has('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <body>
        <div class="container mt-4">
            <h2 class="text-center mb-4">
                <span style="color: red;">Edit</span>
                <span style="color: blue;">Booking</span>
            </h2>

            <form class="row g-3" method="POST" action="{{ route('booking.update', $booking->id) }}">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label for="guest_id" class="form-label">Guest NAME</label>
                    <input type="text" class="form-control" id="guest_id" name="guest_id"
                           value="{{ $booking->guest->FirstName . ' ' . $booking->guest->LastName }}" readonly>
                    <input type="hidden" name="guest_id" value="{{ $booking->guest->id }}"> <!-- تخزين الـ guest_id بشكل مخفي -->
                </div>
                <div class="col-md-6">
                    <label for="room_id">Available Rooms</label>
                    <select class="form-control room-list" name="room_id" id="room_id">
                        <option value="">Select room</option>
                    </select>
                    @error('room_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                 <!-- Check-in -->
                 <div class="col-md-4">
                    <label for="checkindate" class="form-label">Check-in</label>
                    <input type="date" name="checkindate" id="checkin-date"
                    class="form-control checkin-date" value="{{ $booking->checkindate }}" required />
                </div>

                <!-- Check-out -->
                <div class="col-md-4">
                    <label for="checkoutdate" class="form-label">Check-out</label>
                    <input type="date" name="checkoutdate" id="checkout-date"
                    class="form-control" value="{{ $booking->checkoutdate }}" required />
                </div>

                <!-- Submit Button -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Save Edit</button>
                </div>
            </form>
        </div>
    </body>










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
                            _html += '<option value="' + row.id + '">' + row.room_number + '</option>';
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

@endsection
