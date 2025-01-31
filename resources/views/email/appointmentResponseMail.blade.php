<!DOCTYPE html>
<html>
<head>
    <title>Appointment Response Mail</title>
</head>
<body>
    @if($appointment->status == 'rejected')
        <p>Unfortunately, your appointment has been rejected. Reason: {{ $appointment->reason }}</p>
    @else
        <p>Your appointment has been approved! We look forward to seeing you.</p><br>
        <p>Your booking detail is:</p><br>
        <b>Service Type:</b>&nbsp; @if($appointment->is_laser_service == 1)  <p>Laser Service</p> @else <p>Service</p> @endif<br>
        <b>Service :</b>&nbsp; <p>{{ $appointment->service }}</p><br>
        <b>Date :</b>&nbsp; <p>{{ $appointment->date }}</p><br>
        <b>Time :</b>&nbsp; <p>{{ $appointment->time }}</p><br>
    @endif


    <p>Thank You</p>
</body>
</html>
