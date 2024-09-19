<!DOCTYPE html>
<html>

<head>
    <title>Rapport de gestion de stock</title>
    <!-- vendor css -->
    <link rel="stylesheet" type="text/css" href="{{public_path('assets/css/style.css')}}">
    <style>
        /* Ajouter des styles CSS ici */
    </style>
</head>

<body class="card-pdf">
    <h2 class="text-center-pdf text-primary-pdf">CENTRE MEDICO-SOCIAL UFHB</h2>
    <h3 class="text-center-pdf">Bilan caisse</h3>
    <h3 class="text-center-pdf">{{$periode}}</h3>
    <hr>

    <table class="top-titre-detail-pdf">
        <tr class="bg-primary-pdf">
            <th class="text-light-pdf titre-detail-pdf" style="font-size:22px;">Bilan des activités de la caisse</th>
        </tr>
    </table><br>

    
    <table style="width:100%">

        <tr style="width:100%">
            <td style="width:15%"></td>
            <td style="height:30; font-size:larger;">Pharmacie</td>
            <td>............................................. </td>
            <td style="height:30; font-size:larger;"> {{$pharmacie}}</td>
        </tr>
        <tr>
            <td></td>
            <td style="height:30; font-size:larger;">Infirmerie</td>
            <td>.............................................</td>
            <td style="height:30; font-size:larger;"> {{$infirmerie}}</td>
        </tr>
        <tr>
            <td></td>
            <td style="height:30; font-size:larger;">Cabinet dentaire</td>
            <td>............................................. </td>
            <td style="height:30; font-size:larger;"> {{$cabinetDentaire}}</td>
        </tr>
        <tr>
            <td></td>
            <td style="height:30; font-size:larger;">Ophtalmologie</td>
            <td>............................................. </td>
            <td style="height:30; font-size:larger;"> {{$ophtalmologie}}</td>
        </tr>
        <tr>
            <td></td>
            <td style="height:30; font-size:larger;">Laboratoire</td>
            <td>............................................. </td>
            <td style="height:30; font-size:larger;"> {{$laboratoire}}</td>
        </tr>
        <tr>
            <td></td>
            <th style="height:30; font-size:larger;">Bilan général</th>
            <th>............................................. </th>
            <th style="height:30; font-size:larger;"> {{$laboratoire+$ophtalmologie+$cabinetDentaire+$infirmerie+$pharmacie}}</th>
        </tr>

       
    </table><br>

</body>

</html>