<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Pdf</title>


    <style>
        body{
            width: 100%;
        }
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 4px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 7px;
            padding-bottom: 7px;
            text-align: left;
            background-color: #7ad530;
            color: white;
        }




        #total td {
            border: 0px solid #ced4da;
            padding: 4px;
        }

        #total tr:nth-child(even){background-color: #f2f2f2;}

        #total tr:hover {background-color: #ddd;}

        #total {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #total tr:hover {background-color: #7ad530}

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .title {
            flex: 0 0 50%;
            max-width: 48%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .img{
            flex: 0 0 50%;
            max-width: 48%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .img img{
            float: right;
        }
        .supplier{
            flex: 0 0 50%;
            max-width: 48%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .company{
            flex: 0 0 50%;
            max-width: 48%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        .company-detail{
            float: right;

        }
        .col-12{
            width: 100%;
        }
        .conatent{
            flex: 0 0 50%;
            max-width: 45%;
            position: relative;
            width: 100%;
            padding-right: 45px;
            padding-left: 15px;
        }
        .total{
            padding-top: 10px;
            flex: 0 0 50%;
            max-width: 50%;
            position: relative;
            width: 100%;
            padding-right: 0px;
            padding-left: 15px;
        }
        .bill-section{
            float: right;
            width: 30%;
        }
        #total{
            border: 0.5px solid #ced4da;
        }
    </style>

</head>
<body style="position: relative">
    <h1>Attendance Report</h1>
    <table id="customers">
        <tr>
            <th style="text-align: center; font-size: 13px">Month</th>
            <th style="text-align: center; font-size: 13px">Date</th>
            <th style="text-align: center; font-size: 13px">Day</th>
            <th style="text-align: center; font-size: 13px">ID</th>
            <th style="text-align: center; font-size: 13px">Employee Name</th>
            <th style="text-align: center; font-size: 13px">Department</th>
            <th style="text-align: center; font-size: 13px">First In Time</th>
            <th style="text-align: center; font-size: 13px">Last Out Time</th>
            <th style="text-align: center; font-size: 13px; width:100px;">Hours of Work</th>
        </tr>
        @foreach ($attendances as $attendance)
            <tr>
                <td style="font-size: 11px; text-align: center;">{{ $attendance['month'] }}</td>
                <td style="font-size: 11px; text-align: center;">{{ $attendance['date'] }}</td>
                <td style="font-size: 11px; text-align: center;">{{ $attendance['day'] }}</td>
                <td style="font-size: 11px; text-align: center;">{{ $attendance['employee_id'] }}</td>
                <td style="font-size: 11px; text-align: center;">{{ $attendance['employee_name'] }}</td>
                <td style="font-size: 11px; text-align: center;">{{ $attendance['department'] }}</td>
                <td style="font-size: 11px; text-align: center;">{{ $attendance['first_in_time'] }}</td>
                <td style="font-size: 11px; text-align: right;">{{ $attendance['last_out_time'] }}</td>
                <td style="font-size: 11px; text-align: right;">{{ $attendance['hours_of_work'] }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>
