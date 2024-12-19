@extends('admin.dashboard')
@section('cont')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="booking" class="py-4">
        <div class="container">
            <div class="mb-4 text-center section-header">
                <h2>Booking Form</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="shadow card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('booking_admin.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="guest_id">Guests</label>
                                    <select class="form-control" name="guest_id" id="guest_id">
                                        <option value="">Select guest</option>
                                        @foreach ($guests as $guest)
                                            <option value="{{ $guest->id }}">
                                                {{ $guest->FirstName . ' ' . $guest->LastName }}</option>
                                        @endforeach
                                    </select>
                                    @error('guest_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
                                <div class="form-row">
                                    <div class="form-row">
                                        <div class="control-group col-md-6">
                                            <label>Check-In</label>
                                            <input type="date" name="checkindate" id="checkin-date"
                                                class="form-control checkin-date" required />
                                            @error('checkindate')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="control-group col-md-6">
                                            <label>Check-Out</label>
                                            <input type="date" name="checkoutdate" id="checkout-date"
                                                class="form-control" required />
                                            @error('checkoutdate')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 text-center form-group">
                                    <button type="submit" class="btn btn-primary w-50">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
