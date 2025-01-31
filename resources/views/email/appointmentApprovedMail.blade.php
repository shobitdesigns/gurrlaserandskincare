<!DOCTYPE html>
<html>
<head>
    <title>Approved Appointment Detail</title>
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
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <th>Location</th>
                <td>{{ $data->location }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{$data->date}}</td>
            </tr>
            <tr>
                <th>Time</th>
                <td>{{$data->time}}</td>
            </tr>
            <tr>
                <th>Service</th>
                <td>{{$data->service}}</td>
            </tr>

        </table>
    </div>

    </body>
    </html>
