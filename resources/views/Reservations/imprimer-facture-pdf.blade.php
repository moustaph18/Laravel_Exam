<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titre}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card-header {
            background-color: #5de80d;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            width: 100px; /* Ajustez la taille selon vos besoins */
        }

        .date {
            text-align: right;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        .table th {
            background-color: #5de80d;;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
    <div class="card-header">
        <img src="/path/to/your/car-logo.png" alt="Car Logo" class="logo">
        <div class="date">{{$date}}</div>
    </div>

    <div class="container">
        <p>Titre:{{$titre}}</p>
        <table class=" mb-3 mt-3 table bg-dark table-bordered ">
            <thead>
                <tr>
                    <th>Prenom(s) et Nom</th>
                    <th>Type de reservation</th>
                    <th>Prix</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reserv)
                <tr>
                    <td>{{$reserv->prenom}} {{$reserv->nom}}</td>
                    <td>{{$reserv->type_reservation}}</td>
                    <td>{{$reserv->prix}}</td>
                    <td>{{$reserv->date_debut}}</td>
                    <td>{{$reserv->date_fin}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="signature">
        <p>Signature</p>
    </div>
    
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titre}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card-header {
            background-color: rgb(229, 233, 236);
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            width: 100px; /* Ajustez la taille selon vos besoins */
        }

        .date {
            text-align: right;
        }

        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signature {
            border-top: 2px solid #333;
            width: 150px;
        }

        .stamp {
            border: 2px solid #333;
            padding: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        .table th {
            background-color: rgb(229, 233, 236);
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
    <div class="card-header">
        <img src="/path/to/your/car-logo.png" alt="Car Logo" class="logo">
        <div class="date">{{$date}}</div>
    </div>

    <div class="container">
        <p>Titre:{{$titre}}</p>
        <table class=" mb-3 mt-3 table bg-dark table-bordered ">
            <thead>
                <tr>
                    <th>Prenom(s) et Nom</th>
                    <th>Type de reservation</th>
                    <th>Prix</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reserv)
                <tr>
                    <td>{{$reserv->prenom}} {{$reserv->nom}}</td>
                    <td>{{$reserv->type_reservation}}</td>
                    <td>{{$reserv->prix}}</td>
                    <td>{{$reserv->date_debut}}</td>
                    <td>{{$reserv->date_fin}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="signature-section">
        <div class="signature">
            Signature
        </div>
        <div class="stamp">
            Tampon
        </div>
    </div>
    
</body>
</html>
