<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prestito</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header img {
            width: 150px;
            height: auto;
        }
        .intestazione {
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>

<header>
    <!-- Inserisci qui l'immagine del logo -->
    <img src="{{ public_path('images/logo.png') }}" alt="Logo">
    <div class="intestazione">
        <h2>Medjugorje Service d.o.o</h2>
        <p>Pape Ivana Pavla II 14, 88266 Medjugorje, BiH</p>
        <a href="tel:00387063741548">Tel: 00387 063 741548</a>
        <a href="mailto:mdjservice00@gmail.com">Email: mdjservice00@gmail.com</a>
    </div>
    <hr>
    <h3>RADIO RENT SERVICE</h3>
</header>

<div>
    <p><strong>Data:</strong> {{ $loan->loan_date }}</p>
    <p><strong>N. Progressivo:</strong> {{ $loan->id }}</p>
    <p><strong>Status:</strong> {{ $loan->status }}</p>
    <!-- Altri dati del loan se necessari -->
</div>

<table>
    <thead>
    <tr>
        <th>N.</th>
        <th>ID</th>
        <th>Nome</th>
    </tr>
    </thead>
    <tbody>
    @foreach($radios as $index => $radio)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $radio->id ?? '' }}</td>
            <td>{{ $radio->identifier ?? '' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
