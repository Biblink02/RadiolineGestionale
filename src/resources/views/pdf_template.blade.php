<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Radio Rent Service</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 5px;
            padding: 0;
        }
        /* Header con Flexbox */
        .header {
            padding: 5px;
            background-color: #fff;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
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
            height: 50px;
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
            margin: 1px 0;
        }
        /* Titolo principale */
        .title-section {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 5px 0;
        }
        /* Tabelle per dati del prestito */
        .loan-info-table, .section-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
        }
        .loan-info-table td, .section-table td {
            border: 1px solid #000;
            padding: 3px;
            vertical-align: top;
            font-size: 10px;
        }
        /* Abbreviation explanation */
        .abbreviation-note {
            font-size: 8px;
            color: #666;
            margin: 3px 0;
        }
        /* Informazioni per il gruppo */
        .info-group {
            margin: 5px 0;
            font-size: 10px;
        }
        .info-group-title {
            font-weight: bold;
            margin-bottom: 3px;
        }
        /* Tabelle radio affiancate tramite tabella contenitore */
        .tables-container {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
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
            padding: 4px;
            text-align: left;
            font-size: 10px;
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
            <p>mob. WhatsApp 00387 063 144 027</p>
            <p>00387 063 247 485</p>
            <p>Email: <a href="mailto:mdjservice00@gmail.com">mdjservice00@gmail.com</a></p>
        </div>
    </div>
</div>

<!-- Titolo principale -->
<div class="title-section">
    RADIO RENT SERVICE
</div>

<!-- Prima riga -->
<table class="section-table">
    <tr>
        <td style="width: 20%;"><strong>DATE: </strong></td>
        <td style="width: 25%;"><strong>BOOKING NUMBER: </strong> {{ $loan->id ?? '' }}</td>
        <td style="width: 55%;"><strong>A/G/L/H*: </strong></td>
    </tr>
</table>

<!-- Seconda riga -->
<table class="section-table">
    <tr>
        <td style="width: 30%;"><strong>CUSTOMER CODE: </strong><!--TODO--></td>
        <td style="width: 50%;"><strong>MAIL: </strong></td>
        <td style="width: 20%;"><strong>CHANNEL: </strong></td>
    </tr>
</table>

<!-- Terza riga -->
<table class="section-table">
    <tr>
        <td style="width: 40%;"><strong>MOBILE PHONE: </strong></td>
        <td style="width: 20%;"><strong>RADIO QUANTITY: </strong>{{ count($radios ?? []) }}</td>
        <td style="width: 40%;"><strong>ACCOMMODATION: </strong></td>
    </tr>
</table>

<!-- Quarta riga -->
<table class="section-table">
    <tr>
        <td style="width: 35%;"><strong>DELIVERY DATE: </strong></td>
        <td style="width: 35%;"><strong>RADIO RETURN: </strong><!--TODO forse--></td>
        <td style="width: 30%;"><strong>RENTAL DAYS: </strong><!--TODO forse--></td>
    </tr>
</table>

<!-- Quinta riga -->
<table class="section-table">
    <tr>
        <td style="width: 30%;"><strong>POWER BANK: </strong></td>
        <td style="width: 30%;"><strong>SPARE BATTERIES: </strong></td>
        <td style="width: 40%;"><strong>REFERENCE: </strong></td>
    </tr>
</table>

<!-- Abbreviation explanation -->
<div class="abbreviation-note">
    * Agency / Guide / Leader / Hotel
</div>

<!-- Informazioni per il gruppo -->
<div class="info-group">
    <p style="margin:0; padding-left:5px; line-height: 1.3;">
        <strong>Attention:</strong> The radios include instructions for use in four languages. The earphone remains with the pilgrim. In case of damage or loss of the radio, a fee of KM 100 will be charged. In case of loss of spare batteries, a fee of KM 4 per battery will be charged.
    </p>
</div>

<!-- Suddivisione delle radio -->
@php
    // Prima pagina: 25 per colonna (50 totali)
    $firstPageCapacity = 46; // 50 radio
    $firstPage = $radios->take($firstPageCapacity);

    // Radio rimanenti
    $otherPagesCapacity = 80;
    $remaining = $radios->slice($firstPageCapacity);
    // Pagine successive: 42 per colonna (84 totali)
    $remainingPages = $remaining->chunk($otherPagesCapacity);

    // Contatore globale per la numerazione
    $globalIndex = 0;
@endphp

    <!-- Prima pagina -->
@if($firstPage->count() > 0)
    @php
        $pageCount = $firstPage->count();
        $perColumn = $firstPageCapacity/2;
        // Se non piena, distribuisci equamente; altrimenti usa $perColumn per colonna
        $leftCount = ($pageCount < $firstPageCapacity) ? ceil($pageCount / 2) : $perColumn;
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
        $perColumn = $otherPagesCapacity/2;
        $leftCount = ($pageCount < $otherPagesCapacity) ? ceil($pageCount / 2) : $perColumn;
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
    Customer Service: WhatsApp | Patrizio: ____________ | Thomas: ____________
</div>

</body>
</html>
