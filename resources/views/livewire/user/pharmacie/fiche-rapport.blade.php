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
    <h3 class="text-center-pdf">Rapport de gestion de stock de medicaments</h3>
    <hr>

    <table class="top-titre-detail-pdf">
        <tr class="bg-primary-pdf">
            <th class="text-light-pdf titre-detail-pdf" style="font-size:22px;">{{$titre}}</th>
        </tr>
    </table><br>

    
    <table class="table-bilan" style="width:100%">
        <thead class="header-title">
            <tr style="width:100%">
                <th style="width:45%">Medicalents</th>
                <th class="text-center-pdf" style="width:20%">Stock</th>
                <th class="text-center-pdf" style="width:35%">Disponibilité en rayon</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($medicaments as $medicament)
                <tr>
                    <td>{{$medicament->nomMedicament}}</td>
                    <td>{{$medicament->stock}}</td>
                    <td>{{$medicament->disponibleRayon}}</td>
                </tr>
            @endforeach

       
        </tbody>
    </table><br>

</body>

</html>