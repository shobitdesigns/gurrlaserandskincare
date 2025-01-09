<!DOCTYPE html>
<html>
<head>
    <title>Enquiry Received</title>
</head>
<body>
    <h1>New Enquiry from {{ $enquiry->name }}</h1>
    <p>Email : {{ $enquiry->email }}</p>
    {{-- <p>Looking For : {{ $enquiry->looking_for }}</p>
    <p>Treatment For : {{ $enquiry->treatment_for }}</p> --}}
    <p>Location : {{ $enquiry->location }}</p>
    @if (!empty($enquiry->laser_service))
        <p>Laser Service : {!! $enquiry->laser_service !!}</p>
    @endif
    <p>Date : {{ $enquiry->date }}</p>

    <p>Thank You</p>
</body>
</html>
