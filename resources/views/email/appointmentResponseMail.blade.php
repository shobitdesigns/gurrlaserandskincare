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
        <b>Service :</b>&nbsp; {{ $appointment->laser_service }}
        <b>Date :</b>&nbsp; {{ $appointment->date }}
        <b>Time :</b>&nbsp; {{ $appointment->time }}
    @endif


    <p>Thank You</p>
</body>
</html>
