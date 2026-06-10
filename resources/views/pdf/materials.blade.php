<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
    <title>Lagerverwaltungssystem</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .header img {
            width: 80px;
            margin-bottom: 5px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .meta {
            margin-top: 5px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="header">

   <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo-lager.png'))) }}"
     style="width:150px;">

    <div class="title">
        Lagerverwaltungssystem
    </div>

    <div class="meta">
        Anzahl der Einträge: <b>{{ $rowCount }}</b><br>
        Datum: <b>{{ $now }}</b>
    </div>

</div>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Material</th>
            <th>Farbe</th>
            <th>Höhe</th>
            <th>Paket</th>
            <th>Stück</th>
            <th>Zweck</th>
            <th>Datum</th>
            <th>Anmerkungen</th>
        </tr>
    </thead>

    <tbody>
        @foreach($materials as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->material }}</td>
                <td>{{ $item->farbe }}</td>
                <td>{{ $item->höhe }}</td>
                <td>{{ $item->paket }}</td>
                <td>{{ $item->stück }}</td>
                <td>{{ $item->zweck }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->anmerkungen }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>