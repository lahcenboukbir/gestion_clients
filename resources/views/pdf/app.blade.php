<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF REPORTS</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: "Public Sans", sans-serif;
            font-size: 12px;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        caption {
            text-align: left;
            margin: 8px;
        }

        .header {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        @yield('title')
    </div>

    @yield('content')

    <div class="footer">
        <p>Ce rapport a été généré le {{ date('Y-m-d H:i:s') }}.</p>
    </div>
</body>

</html>