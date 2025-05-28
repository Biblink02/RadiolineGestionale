<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Radio Rent Service</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        /* Header con Flexbox */
        .header {
            padding: 10px;
            background-color: #fff;
            border-bottom: 1px solid #000;
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-logo {
            flex: 0 0 auto;
        }
        .header-logo img {
            height: 60px;
        }
        .header-company {
            flex: 1;
            text-align: center;
        }
        .header-contact {
            flex: 0 0 auto;
            text-align: right;
        }
        .header-company h2,
        .header-company p,
        .header-contact p {
            margin: 2px 0;
        }
        /* Titolo principale */
        .title-section {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin: 10px 0;
        }
        /* Tabelle per dati del prestito */
        .loan-info-table, .section-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .loan-info-table td, .section-table td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }
        .loan-info-table td {
            width: 33%;
        }
        /* Note */
        .notes {
            margin: 10px 0;
        }
        .notes p {
            margin: 0;
            padding: 5px;
            border: 1px solid #000;
            min-height: 50px;
        }
        /* Informazioni per il gruppo */
        .info-group {
            margin: 10px 0;
            font-size: 12px;
        }
        .info-group-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        /* Tabelle radio affiancate tramite tabella contenitore */
        .tables-container {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .tables-container td {
            vertical-align: top;
            border: none;
            width: 50%;
            padding: 0 5px;
        }
        .inner-table {
            width: 100%;
            border-collapse: collapse;
        }
        .inner-table th,
        .inner-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        /* Impostazioni per la larghezza delle colonne: 10% per N., 20% per ID. e 70% per NAME */
        .inner-table th:nth-child(1),
        .inner-table td:nth-child(1) {
            width: 10%;
        }
        .inner-table th:nth-child(2),
        .inner-table td:nth-child(2) {
            width: 20%;
        }
        .inner-table th:nth-child(3),
        .inner-table td:nth-child(3) {
            width: 70%;
        }
        /* Ogni pagina di radio */
        .page {
        }
        /* Footer */
        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <div class="header-container">
        <div class="header-logo">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        </div>
        <div class="header-company">
            <h2>Medjugorje Service d.o.o</h2>
            <p>Pape Ivana Pavla II 14<br>88266 Medjugorje, BiH</p>
        </div>
        <div class="header-contact">
            <p>tel. 00387 063 741548</p>
            <p>Email: <a href="mailto:mdjservice00@gmail.com">mdjservice00@gmail.com</a></p>
        </div>
    </div>
</div>

<!-- Titolo principale -->
<div class="title-section">
    RADIO RENT SERVICE
</div>

<!-- Dati prestito -->
<table class="loan-info-table">
    <tr>
        <td><strong>DATA:</strong> {{ $loan->loan_date ?? '' }}</td>
        <td><strong>N. PROGRESSIVO:</strong> {{ $loan->id ?? '' }}</td>
        <td><strong>CANALE:</strong> <!-- Inserisci il canale se disponibile --></td>
    </tr>
</table>

<!-- Sezione Agenzia / Capo gruppo / Guida -->
<table class="section-table">
    <tr>
        <td><strong>Agenzia</strong><br>mail / WhatsApp</td>
        <td><strong>Capo gruppo</strong></td>
        <td><strong>Guida</strong></td>
    </tr>
</table>

<!-- Sezione Date Consegna / Ritiro / Alloggio -->
<table class="section-table">
    <tr>
        <td><strong>CONSEGNA</strong></td>
        <td><strong>RITIRO</strong></td>
        <td><strong>ALLOGGIO</strong></td>
    </tr>
</table>

<!-- Note -->
<div class="notes">
    <p><strong>NOTE:</strong></p>
</div>

<!-- Informazioni per il gruppo -->
<div class="info-group">
    <div class="info-group-title">Informazioni per il gruppo:</div>
    <ul style="margin:0; padding-left:15px;">
        <li>Sulle radio e sul trasmettitore, sono scritte le istruzioni per l’uso e la durata delle batterie.</li>
        <li>In caso di danneggiamento o perdita della radio, sarà addebitato un costo di KM 80.</li>
    </ul>
</div>

<!-- Suddivisione delle radio -->
@php
    // Prima pagina: 15 per colonna (30 totali)
    $firstPagePerColumn = 15;
    $firstPageCapacity = $firstPagePerColumn * 2; // 30 radio
    $firstPage = $radios->take($firstPageCapacity);

    // Radio rimanenti
    $remaining = $radios->slice($firstPageCapacity);
    // Pagine successive: 33 per colonna (66 totali)
    $remainingPages = $remaining->chunk(66);

    // Contatore globale per la numerazione
    $globalIndex = 0;
@endphp

    <!-- Prima pagina -->
@if($firstPage->count() > 0)
    @php
        $pageCount = $firstPage->count();
        // Se non piena, distribuisci equamente; altrimenti usa 15 per colonna
        $leftCount = ($pageCount < $firstPageCapacity) ? ceil($pageCount / 2) : $firstPagePerColumn;
    @endphp
    <div class="page">
        <table class="tables-container">
            <tr>
                <!-- Colonna sinistra -->
                <td>
                    <table class="inner-table">
                        <thead>
                        <tr>
                            <th>N.</th>
                            <th>ID.</th>
                            <th>NAME</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($firstPage->slice(0, $leftCount) as $radio)
                            @php $globalIndex++; @endphp
                            <tr>
                                <td>{{ $globalIndex }}</td>
                                <td>{{ $radio->identifier ?? '' }}</td>
                                <td>&nbsp;</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
                <!-- Colonna destra -->
                <td>
                    <table class="inner-table">
                        <thead>
                        <tr>
                            <th>N.</th>
                            <th>ID.</th>
                            <th>NAME</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($firstPage->slice($leftCount) as $radio)
                            @php $globalIndex++; @endphp
                            <tr>
                                <td>{{ $globalIndex }}</td>
                                <td>{{ $radio->identifier ?? '' }}</td>
                                <td>&nbsp;</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endif

<!-- Pagine successive -->
@foreach($remainingPages as $page)
    @php
        $pageCount = $page->count();
        $perColumn = 33;
        $leftCount = ($pageCount < 66) ? ceil($pageCount / 2) : $perColumn;
    @endphp
    <div class="page">
        <table class="tables-container">
            <tr>
                <!-- Colonna sinistra -->
                <td>
                    <table class="inner-table">
                        <thead>
                        <tr>
                            <th>N.</th>
                            <th>ID.</th>
                            <th>NAME</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($page->slice(0, $leftCount) as $radio)
                            @php $globalIndex++; @endphp
                            <tr>
                                <td>{{ $globalIndex }}</td>
                                <td>{{ $radio->identifier ?? '' }}</td>
                                <td>&nbsp;</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
                <!-- Colonna destra -->
                <td>
                    <table class="inner-table">
                        <thead>
                        <tr>
                            <th>N.</th>
                            <th>ID.</th>
                            <th>NAME</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($page->slice($leftCount) as $radio)
                            @php $globalIndex++; @endphp
                            <tr>
                                <td>{{ $globalIndex }}</td>
                                <td>{{ $radio->identifier ?? '' }}</td>
                                <td>&nbsp;</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endforeach

<!-- Footer -->
<div class="footer">
    Servizio Assistenza: Whatsapp | Patrizio: ____________ | Thomas: ____________
</div>

</body>
</html>
