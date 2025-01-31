<!DOCTYPE html>
<html>
<head>
    <title>New Appointment Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            width: 30%;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        .container table {
            border-radius: 5px;
            overflow: hidden;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Appointment Detail</h2>
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $appointment->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $appointment->email }}</td>
            </tr>
            <tr>
                <th>Location</th>
                <td>{{ $appointment->location }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{$appointment->date}}</td>
            </tr>
            <tr>
                <th>Time</th>
                <td>{{$appointment->time}}</td>
            </tr>
            <tr>
                <th>Service</th>
                <td>{{$appointment->service}}</td>
            </tr>
            <tr>
                <th>Service Type</th>
                <td>
                    @if ($appointment->is_laser_service == 1)
                        Laser Service
                    @else
                        Service
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    {{$appointment->status}}
                </td>
            </tr>

        </table>
    </div>

    </body>
    </html>
