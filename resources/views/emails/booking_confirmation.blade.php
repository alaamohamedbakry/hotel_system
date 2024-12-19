<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Thank you for your booking!</h1>
    <p>Dear {{ $booking->guest->name }},</p>
    <p>Your booking has been successfully created. Here are the details:</p>
    <ul>
        <li>Room: {{ $booking->room->name }}</li>
        <li>Check-in Date: {{ $booking->checkindate }}</li>
        <li>Check-out Date: {{ $booking->checkoutdate }}</li>
    </ul>
    <p>We look forward to welcoming you!</p>
</body>
</html>
