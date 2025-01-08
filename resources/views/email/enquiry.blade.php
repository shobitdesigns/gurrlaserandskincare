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
    <p>Date : {{ $enquiry->date }}</p>

    <p>Thank You</p>
</body>
</html>
