<!DOCTYPE html>
<html>

<head>
    <title>Document PDF</title>
    <!-- vendor css -->
    <link rel="stylesheet" type="text/css" href="{{public_path('assets/css/style.css')}}">
    <style>
        /* Ajouter des styles CSS ici */
    </style>
</head>

<body class="card-pdf">
    <h2 class="text-center-pdf text-primary-pdf">CENTRE MEDICO-SOCIAL UFHB</h2>
    <h3 class="text-center-pdf">Bilan des activités de {{$secretaireRecherche == "tous" ? "tous les services" : $secretaireRecherche}}</h3>
    <h3 class="text-center-pdf">{{$periode}}</h3>


    <hr>

    <table class="top-titre-detail-pdf">
        <tr class="bg-primary-pdf">
            <th class="text-light-pdf titre-detail-pdf" style="font-size:22px;">Nombre de patients reçus</th>
        </tr>
    </table><br>
    <table class="table-bilan">
        <thead class="header-title">
            <tr class="text-center-pdf">
                <th rowspan="2" style="width:10%">Patients</th>
                <th class="text-center-pdf" colspan="2">0-4 ans</th>
                <th class="text-center-pdf" colspan="2">5-9 ans</th>
                <th class="text-center-pdf" colspan="2">10-14 ans</th>
                <th class="text-center-pdf" colspan="2">15-19 ans</th>
                <th class="text-center-pdf" colspan="2">20-24 ans</th>
                <th class="text-center-pdf" colspan="2">25-49 qns</th>
                <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                <th class="text-center-pdf" rowspan="2">Effectifs</th>
                <th class="text-center-pdf" rowspan="2">%</th>
            </tr>
            <tr>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>

            </tr>
        </thead>
        <tbody>


            @php
            $effectifTotal=0;
            @endphp
            @for ($i = 0; $i < count($professions); $i++) @php $effectif=0; @endphp @for ($j=0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) @php $effectif+=$patient->bilanPatient($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                @endphp

                @endfor

                @endfor
                @php
                $effectifTotal+=$effectif;
                @endphp
                @endfor


                @for ($i = 0; $i < count($professions); $i++) @php $effectif=0; @endphp <tr>
                    <td class="text-center-pdf">{{$professions[$i]}}</td>
                    @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) <td class="text-center-pdf">{{$patient->bilanPatient($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate)}}</td>
                        @php
                        $effectif+=$patient->bilanPatient($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                        @endphp

                        @endfor

                        @endfor
                        <td class="text-center-pdf">{{$effectif}}</td>
                        <td class="text-center-pdf">{{ $effectifTotal == 0 ? '0%' : (round(($effectif*100)/$effectifTotal,2)).'%'}}</td>

                        </tr>
                        @endfor


                        <tr class="text-center-pdf">
                            <th>TOTAL</th>
                            @for ($i = 0; $i < count($trancheAges); $i++) @for ($j=0; $j < count($sexes); $j++) @php $effectif=0; @endphp @for ($k=0; $k < count($professions); $k++) @php $effectif+=$patient->bilanPatient($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);

                                @endphp

                                @endfor
                                <th class="text-center-pdf">{{$effectif}}</th>

                                @endfor

                                @endfor
                                <th class="text-center-pdf">{{$effectifTotal}}</th>
                                <th class="text-center-pdf">100%</th>
                        </tr>

        </tbody>
    </table><br><br>


    <table class="top-titre-detail-pdf">
        <tr class="bg-primary-pdf">
            <th class="text-light-pdf titre-detail-pdf" style="font-size:22px;">Nombre de consultation</th>
        </tr>
    </table><br>
    <table class="table-bilan">
        <thead class="header-title">
            <tr class="text-center-pdf">
                <th rowspan="2" style="width:10%">Patients</th>
                <th class="text-center-pdf" colspan="2">0-4 ans</th>
                <th class="text-center-pdf" colspan="2">5-9 ans</th>
                <th class="text-center-pdf" colspan="2">10-14 ans</th>
                <th class="text-center-pdf" colspan="2">15-19 ans</th>
                <th class="text-center-pdf" colspan="2">20-24 ans</th>
                <th class="text-center-pdf" colspan="2">25-49 qns</th>
                <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                <th class="text-center-pdf" rowspan="2">Effectifs</th>
                <th class="text-center-pdf" rowspan="2">%</th>
            </tr>
            <tr>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>

            </tr>
        </thead>
        <tbody>


            @php
            $effectifTotalConsultation=0;
            @endphp
            @for ($i = 0; $i < count($professions); $i++) @php $effectif=0; @endphp @for ($j=0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) @php $effectif+=$consultation->bilanConsultation($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                @endphp

                @endfor

                @endfor
                @php
                $effectifTotalConsultation+=$effectif;
                @endphp
                @endfor


                @for ($i = 0; $i < count($professions); $i++) @php $effectif=0; @endphp <tr class="text-center">
                    <td>{{$professions[$i]}}</td>
                    @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) <td>{{$consultation->bilanConsultation($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate)}}</td>
                        @php
                        $effectif+=$consultation->bilanConsultation($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                        @endphp

                        @endfor

                        @endfor
                        <td>{{$effectif}}</td>
                        <td>{{ $effectifTotalConsultation == 0 ? '0%' : (round(($effectif*100)/$effectifTotalConsultation,2)).'%'}}</td>

                        </tr>
                        @endfor


                        <tr class="text-center">
                            <th>TOTAL</th>
                            @for ($i = 0; $i < count($trancheAges); $i++) @for ($j=0; $j < count($sexes); $j++) @php $effectif=0; @endphp @for ($k=0; $k < count($professions); $k++) @php $effectif+=$consultation->bilanConsultation($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);

                                @endphp

                                @endfor
                                <th>{{$effectif}}</th>

                                @endfor

                                @endfor
                                <th>{{$effectifTotalConsultation}}</th>
                                <th>100%</th>
                        </tr>

        </tbody>
    </table><br><br>


    <table class="top-titre-detail-pdf">
        <tr class="bg-primary-pdf">
            <th class="text-light-pdf titre-detail-pdf" style="font-size:22px;">Nombre de controle</th>
        </tr>
    </table><br>
    <table class="table-bilan">
        <thead class="header-title">
            <tr class="text-center-pdf">
                <th rowspan="2" style="width:10%">Patients</th>
                <th class="text-center-pdf" colspan="2">0-4 ans</th>
                <th class="text-center-pdf" colspan="2">5-9 ans</th>
                <th class="text-center-pdf" colspan="2">10-14 ans</th>
                <th class="text-center-pdf" colspan="2">15-19 ans</th>
                <th class="text-center-pdf" colspan="2">20-24 ans</th>
                <th class="text-center-pdf" colspan="2">25-49 qns</th>
                <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                <th class="text-center-pdf" rowspan="2">Effectifs</th>
                <th class="text-center-pdf" rowspan="2">%</th>
            </tr>
            <tr>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>
                <th class="text-center-pdf">Masculin</th>
                <th class="text-center-pdf">Feminin</th>

            </tr>
        </thead>
        <tbody>


            @php
            $effectifTotalControle=0;
            @endphp
            @for ($i = 0; $i < count($professions); $i++) @php $effectif=0; @endphp @for ($j=0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) @php $effectif+=$controle->bilanControle($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                @endphp

                @endfor

                @endfor
                @php
                $effectifTotalControle+=$effectif;
                @endphp
                @endfor


                @for ($i = 0; $i < count($professions); $i++) @php $effectif=0; @endphp <tr class="text-center">
                    <td>{{$professions[$i]}}</td>
                    @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) <td>{{$controle->bilanControle($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate)}}</td>
                        @php
                        $effectif+=$controle->bilanControle($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                        @endphp

                        @endfor

                        @endfor
                        <td>{{$effectif}}</td>
                        <td>{{ $effectifTotalControle == 0 ? '0%' : (round(($effectif*100)/$effectifTotalControle,2)).'%'}}</td>

                        </tr>
                        @endfor


                        <tr class="text-center">
                            <th>TOTAL</th>
                            @for ($i = 0; $i < count($trancheAges); $i++) @for ($j=0; $j < count($sexes); $j++) @php $effectif=0; @endphp @for ($k=0; $k < count($professions); $k++) @php $effectif+=$controle->bilanControle($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);

                                @endphp

                                @endfor
                                <th>{{$effectif}}</th>

                                @endfor

                                @endfor
                                <th>{{$effectifTotalControle}}</th>
                                <th>100%</th>
                        </tr>

        </tbody>
    </table> <br><br><br><br><br><br>


    <table class="top-titre-detail-pdf" style="width:100%">
        <tr class="bg-primary-pdf">
            <th class="text-light-pdf titre-detail-pdf" style="font-size:22px; width:100%">Bilan consultation</th>
        </tr>
    </table><br>
    <table class="table-bilan" style="width:100%">
        <thead class="header-title">
            <tr class="text-center-pdf">
                <th class="text-center" style="width:14%" rowspan="2">Caracteristiques</th>
                <th class="text-center-pdf" colspan="2">0-4 ans</th>
                <th class="text-center-pdf" colspan="2">5-9 ans</th>
                <th class="text-center-pdf" colspan="2">10-14 ans</th>
                <th class="text-center-pdf" colspan="2">15-19 ans</th>
                <th class="text-center-pdf" colspan="2">20-24 ans</th>
                <th class="text-center-pdf" colspan="2">25-49 qns</th>
                <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                <th class="text-center-pdf" rowspan="2">Effectifs</th>
            </tr>
            <tr>
                <th class="text-center">Masculin</th>
                <th class="text-center">Feminin</th>
                <th class="text-center">Masculin</th>
                <th class="text-center">Feminin</th>
                <th class="text-center">Masculin</th>
                <th class="text-center">Feminin</th>
                <th class="text-center">Masculin</th>
                <th class="text-center">Feminin</th>
                <th class="text-center">Masculin</th>
                <th class="text-center">Feminin</th>
                <th class="text-center">Masculin</th>
                <th class="text-center">Feminin</th>
                <th class="text-center">Masculin</th>
                <th class="text-center">Feminin</th>
            </tr>
        </thead>
        <tbody>
            @php
            $effectifConsultationControle=0;
            @endphp

            <tr class="text-center">
                <td>Consutation</td>
                @for ($i = 0; $i < count($trancheAges); $i++) @for ($j=0; $j < count($sexes); $j++) @php $effectif=0; @endphp @for ($k=0; $k < count($professions); $k++) @php $effectif+=$consultation->bilanConsultation($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);

                    @endphp

                    @endfor
                    <td>{{$effectif}}</td>

                    @endfor

                    @endfor
                    <td>{{$effectifTotalConsultation}}</td>
            </tr>
            <tr class="text-center">
                <td>Controle</td>
                @for ($i = 0; $i < count($trancheAges); $i++) @for ($j=0; $j < count($sexes); $j++) @php $effectif=0; @endphp @for ($k=0; $k < count($professions); $k++) @php $effectif+=$controle->bilanControle($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);

                    @endphp

                    @endfor
                    <td>{{$effectif}}</td>

                    @endfor

                    @endfor

                    <td>{{$effectifTotalControle}}</td>
            </tr>

            <tr class="text-center">
                <th class="text-center">TOTAL</th>
                @for ($i = 0; $i < count($trancheAges); $i++) @for ($j=0; $j < count($sexes); $j++) @php $effectifControle=0; $effectifConsultation=0; @endphp @for ($k=0; $k < count($professions); $k++) @php $effectifConsultation+=$consultation->bilanConsultation($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);
                    $effectifControle+=$controle->bilanControle($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);

                    @endphp

                    @endfor
                    <th>{{$effectifConsultation+$effectifControle}}</th>
                    @php
                    $effectifConsultationControle+=$effectifConsultation+$effectifControle;
                    @endphp
                    @endfor

                    @endfor
                    <th class="text-center">{{$effectifConsultationControle}}</th>
            </tr>
        </tbody>
    </table><br> <br>
    
    <table class="">
        <tr style="width:100%">
            <th class="" style="font-size:16px; width:50%">Nombre de cas de mise en observation {{$consultation->bilanTraitement($secretaireRecherche,'miseObservation','Oui',$debutDate,$finDate)}}</th>
            <th class="" style="font-size:16px; width:50%">Nombre de cas référés {{$consultation->bilanTraitement($secretaireRecherche,'refere','Oui',$debutDate,$finDate)}}</th>
        </tr>
    </table><br><br>

    @if ($secretaireRecherche !== "tous")

        <table class="top-titre-detail-pdf">
            <tr class="bg-primary-pdf">
                <th class="text-light-pdf titre-detail-pdf" style="font-size:22px; width:100%">Pathologies diagnostiquées</th>
            </tr>
        </table><br>
        <table class="table-bilan" style="width:100%">
            <thead class="header-title">
                <tr class="text-center-pdf">
                    <th rowspan="2">Pathologies</th>
                    <th class="text-center-pdf" colspan="2">0-4 ans</th>
                    <th class="text-center-pdf" colspan="2">5-9 ans</th>
                    <th class="text-center-pdf" colspan="2">10-14 ans</th>
                    <th class="text-center-pdf" colspan="2">15-19 ans</th>
                    <th class="text-center-pdf" colspan="2">20-24 ans</th>
                    <th class="text-center-pdf" colspan="2">25-49 qns</th>
                    <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                    <th class="text-center-pdf" rowspan="2">Effectifs</th>
                    <th class="text-center" rowspan="2">%</th>
                </tr>
                <tr>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>

                </tr>
            </thead>
            <tbody>

                @php
                $effectifPathologieTotal = 0;
                @endphp

                <!-- determiner  Pathologies total-->
                @for ($j = 0; $j < count($trancheAges); $j++) @php $effectifPathologieColonne=0; @endphp @foreach ($pathologie->listePathologie($secretaireRecherche,$debutDate,$finDate) as $listePathologie)

                    @for ($k = 0; $k < count($sexes); $k++) @php $effectifPathologieColonne +=$pathologie->bilanPathologie($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listePathologie->typePathologie);
                        @endphp

                        @endfor
                        @endforeach
                        @php
                        $effectifPathologieTotal += $effectifPathologieColonne;
                        @endphp
                        @endfor


                        <!-- liste les  Pathologies le bilan-->
                        @foreach ($pathologie->listePathologie($secretaireRecherche,$debutDate,$finDate) as $listePathologie)

                        @php
                        $effectifPathologie = 0;
                        @endphp
                        <tr>
                            <td style="width:10%">{{$listePathologie->typePathologie}}</td>
                            @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) <td class="text-center">{{$pathologie->bilanPathologie($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listePathologie->typePathologie)}}</td>

                                @php
                                $effectifPathologie +=$pathologie->bilanPathologie($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listePathologie->typePathologie);
                                @endphp

                                @endfor

                                @endfor
                                <td class="text-center">{{$effectifPathologie}}</td>
                                <td class="text-center">{{ $effectifPathologieTotal == 0 ? '0%' : (round(($effectifPathologie*100)/$effectifPathologieTotal,2)).'%'}}</td>

                        </tr>

                        @endforeach


                        <!-- liste totaldes Pathologies -->
                        <tr class="text-dark">
                            <th>TOTAL</th>
                            @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) @php $effectifPathologieColonne=0; @endphp @foreach ($pathologie->listePathologie($secretaireRecherche,$debutDate,$finDate) as $listePathologie)

                                @php
                                $effectifPathologieColonne +=$pathologie->bilanPathologie($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listePathologie->typePathologie);
                                @endphp


                                @endforeach
                                <th class="text-center">{{$effectifPathologieColonne}}</th>
                                @endfor
                                @endfor
                                <th class="text-center">{{$effectifPathologieTotal}}</th>
                                <th class="text-center">100%</th>
                        </tr>
            </tbody>
        </table><br><br>


        <table class="top-titre-detail-pdf">
            <tr class="bg-primary-pdf">
                <th class="text-light-pdf titre-detail-pdf" style="font-size:22px; width:100%">Nombre antécédents</th>
            </tr>
        </table><br>
        <table class="table-bilan" style="width:100%">
            <thead class="header-title">
                <tr class="text-center-pdf">
                    <th rowspan="2">Antécédents</th>
                    <th class="text-center-pdf" colspan="2">0-4 ans</th>
                    <th class="text-center-pdf" colspan="2">5-9 ans</th>
                    <th class="text-center-pdf" colspan="2">10-14 ans</th>
                    <th class="text-center-pdf" colspan="2">15-19 ans</th>
                    <th class="text-center-pdf" colspan="2">20-24 ans</th>
                    <th class="text-center-pdf" colspan="2">25-49 qns</th>
                    <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                    <th class="text-center-pdf" rowspan="2">Effectifs</th>
                    <th class="text-center" rowspan="2">%</th>
                </tr>
                <tr>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>
                    <th class="text-center">Masculin</th>
                    <th class="text-center">Feminin</th>

                </tr>
            </thead>
            <tbody>

                @php
                $effectifAntecedentTotal = 0;
                @endphp

                <!-- determiner  Antecedent total-->
                @for ($j = 0; $j < count($trancheAges); $j++) @php $effectifAntecedentColonne=0; @endphp @foreach ($antecedent->listeAntecedent($secretaireRecherche,$debutDate,$finDate) as $listeAntecedent)

                    @for ($k = 0; $k < count($sexes); $k++) @php $effectifAntecedentColonne +=$antecedent->bilanAntecedent($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeAntecedent->typeAntecedent);
                        @endphp

                        @endfor
                        @endforeach
                        @php
                        $effectifAntecedentTotal += $effectifAntecedentColonne;
                        @endphp
                        @endfor


                        <!-- liste les  Pathologies le bilan-->
                        @foreach ($antecedent->listeAntecedent($secretaireRecherche,$debutDate,$finDate) as $listeAntecedent)

                        @php
                        $effectifAntecedent = 0;
                        @endphp
                        <tr>
                            <td style="width:11%">{{$listeAntecedent->typeAntecedent}}</td>
                            @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) <td class="text-center">{{$antecedent->bilanAntecedent($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeAntecedent->typeAntecedent)}}</td>

                                @php
                                $effectifAntecedent +=$antecedent->bilanAntecedent($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeAntecedent->typeAntecedent);
                                @endphp

                                @endfor

                                @endfor
                                <td class="text-center">{{$effectifAntecedent}}</td>
                                <td class="text-center">{{ $effectifAntecedentTotal == 0 ? '0%' : (round(($effectifAntecedent*100)/$effectifAntecedentTotal,2)).'%'}}</td>

                        </tr>

                        @endforeach


                        <!-- liste totaldes Pathologies -->
                        <tr class="text-dark">
                            <th>TOTAL</th>
                            @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) @php $effectifAntecedentColonne=0; @endphp @foreach ($antecedent->listeAntecedent($secretaireRecherche,$debutDate,$finDate) as $listeAntecedent)

                                @php
                                $effectifAntecedentColonne +=$antecedent->bilanAntecedent($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeAntecedent->typeAntecedent);
                                @endphp


                                @endforeach
                                <th class="text-center">{{$effectifAntecedentColonne}}</th>
                                @endfor
                                @endfor
                                <th class="text-center">{{$effectifAntecedentTotal}}</th>
                                <th class="text-center">100%</th>
                        </tr>
            </tbody>
        </table><br><br>

        @for ($i = 0; $i < count($examenComplementairesArray); $i++) 
            @php 
                $examen=$examenComplementairesArray[$i]; 
            @endphp 
            @if ($examenComplementairesArray[$i]=='Odonto' && $secretaireRecherche=='Cabinet dentaire' ) <table class="top-titre-detail-pdf">
            <tr class="bg-primary-pdf">
                <th class="text-light-pdf titre-detail-pdf" style="font-size:22px; width:100%">
                    Nombre examens {{$examenComplementairesArray[$i]}}
                </th>
            </tr>
            </table><br>
            <table class="table-bilan">
                <thead class="header-title">
                    <tr class="text-center-pdf">
                        <th class="text-center" style="width:10%" rowspan="2">Examens</th>
                        <th class="text-center-pdf" colspan="2">0-4 ans</th>
                        <th class="text-center-pdf" colspan="2">5-9 ans</th>
                        <th class="text-center-pdf" colspan="2">10-14 ans</th>
                        <th class="text-center-pdf" colspan="2">15-19 ans</th>
                        <th class="text-center-pdf" colspan="2">20-24 ans</th>
                        <th class="text-center-pdf" colspan="2">25-49 qns</th>
                        <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                        <th class="text-center-pdf" rowspan="2">Effectifs</th>
                        <th class="text-center" rowspan="2">%</th>
                    </tr>
                    <tr>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>

                    </tr>
                </thead>
                <tbody>


                    @php
                    $effectifExamenComplementairesTotal = 0;
                    @endphp

                    <!-- determiner  Antecedent total-->
                    @for ($j = 0; $j < count($trancheAges); $j++) @php $effectifExamenComplementairesColonne=0; @endphp @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)

                        @for ($k = 0; $k < count($sexes); $k++) @php $effectifExamenComplementairesColonne +=$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen);
                            @endphp

                            @endfor
                            @endforeach
                            @php
                            $effectifExamenComplementairesTotal += $effectifExamenComplementairesColonne;
                            @endphp
                            @endfor


                            <!-- liste les  Pathologies le bilan-->
                            @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)

                            @php
                            $effectifExamenComplementaires = 0;
                            @endphp
                            <tr>
                                <td>{{$listeExamenComplementaire->typeExamen}}</td>
                                @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) <td class="text-center">{{$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen)}}</td>

                                    @php
                                    $effectifExamenComplementaires +=$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen);
                                    @endphp

                                    @endfor

                                    @endfor
                                    <td class="text-center">{{$effectifExamenComplementaires}}</td>
                                    <td class="text-center">{{ $effectifExamenComplementairesTotal == 0 ? '0%' : (round(($effectifExamenComplementaires*100)/$effectifExamenComplementairesTotal,2)).'%'}}</td>

                            </tr>

                            @endforeach


                            <!-- liste totaldes Pathologies -->
                            <tr class="text-dark">
                                <th>TOTAL</th>
                                @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) @php $effectifExamenComplementairesColonne=0; @endphp @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)

                                    @php
                                    $effectifExamenComplementairesColonne +=$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen);
                                    @endphp


                                    @endforeach
                                    <th class="text-center">{{$effectifExamenComplementairesColonne}}</th>
                                    @endfor
                                    @endfor
                                    <th class="text-center">{{$effectifExamenComplementairesTotal}}</th>
                                    <th class="text-center">100%</th>
                            </tr>
                </tbody>
            </table>
            <br><br>

            @elseif( $secretaireRecherche !=='Cabinet dentaire' )
            <table class="top-titre-detail-pdf">
                <tr class="bg-primary-pdf">
                    <th class="text-light-pdf titre-detail-pdf" style="font-size:22px; width:100%">
                        Nombre examens {{$examenComplementairesArray[$i]}}
                    </th>
                </tr>
            </table><br>
            <table class="table-bilan">
                <thead class="header-title">
                    <tr class="text-center-pdf">
                        <th class="text-center" style="width:10%" rowspan="2">Examens</th>
                        <th class="text-center-pdf" colspan="2">0-4 ans</th>
                        <th class="text-center-pdf" colspan="2">5-9 ans</th>
                        <th class="text-center-pdf" colspan="2">10-14 ans</th>
                        <th class="text-center-pdf" colspan="2">15-19 ans</th>
                        <th class="text-center-pdf" colspan="2">20-24 ans</th>
                        <th class="text-center-pdf" colspan="2">25-49 qns</th>
                        <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                        <th class="text-center-pdf" rowspan="2">Effectifs</th>
                        <th class="text-center" rowspan="2">%</th>
                    </tr>
                    <tr>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>

                    </tr>
                </thead>
                <tbody>


                    @php
                    $effectifExamenComplementairesTotal = 0;
                    @endphp

                    <!-- determiner  Antecedent total-->
                    @for ($j = 0; $j < count($trancheAges); $j++) @php $effectifExamenComplementairesColonne=0; @endphp @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)

                        @for ($k = 0; $k < count($sexes); $k++) @php $effectifExamenComplementairesColonne +=$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen);
                            @endphp

                            @endfor
                            @endforeach
                            @php
                            $effectifExamenComplementairesTotal += $effectifExamenComplementairesColonne;
                            @endphp
                            @endfor


                            <!-- liste les  Pathologies le bilan-->
                            @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)

                            @php
                            $effectifExamenComplementaires = 0;
                            @endphp
                            <tr>
                                <td>{{$listeExamenComplementaire->typeExamen}}</td>
                                @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) <td class="text-center">{{$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen)}}</td>

                                    @php
                                    $effectifExamenComplementaires +=$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen);
                                    @endphp

                                    @endfor

                                    @endfor
                                    <td class="text-center">{{$effectifExamenComplementaires}}</td>
                                    <td class="text-center">{{ $effectifExamenComplementairesTotal == 0 ? '0%' : (round(($effectifExamenComplementaires*100)/$effectifExamenComplementairesTotal,2)).'%'}}</td>

                            </tr>

                            @endforeach


                            <!-- liste totaldes Pathologies -->
                            <tr class="text-dark">
                                <th>TOTAL</th>
                                @for ($j = 0; $j < count($trancheAges); $j++) @for ($k=0; $k < count($sexes); $k++) @php $effectifExamenComplementairesColonne=0; @endphp @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)

                                    @php
                                    $effectifExamenComplementairesColonne +=$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen);
                                    @endphp


                                    @endforeach
                                    <th class="text-center">{{$effectifExamenComplementairesColonne}}</th>
                                    @endfor
                                    @endfor
                                    <th class="text-center">{{$effectifExamenComplementairesTotal}}</th>
                                    <th class="text-center">100%</th>
                            </tr>
                </tbody>
            </table><br><br>

            @endif

        @endfor

        <!-- Nombre examens physiques -->
        @if ($secretaireRecherche == 'Cabinet dentaire')
            <table class="top-titre-detail-pdf">
                <tr class="bg-primary-pdf">
                    <th class="text-light-pdf titre-detail-pdf" style="font-size:22px; width:100%">
                        Nombre examens physiques
                    </th>
                </tr>
            </table><br>
            <table class="table-bilan">
                <thead class="header-title">
                    <tr class="text-center-pdf">
                        <th rowspan="2">Examens</th>
                        <th class="text-center-pdf" colspan="2">0-4 ans</th>
                        <th class="text-center-pdf" colspan="2">5-9 ans</th>
                        <th class="text-center-pdf" colspan="2">10-14 ans</th>
                        <th class="text-center-pdf" colspan="2">15-19 ans</th>
                        <th class="text-center-pdf" colspan="2">20-24 ans</th>
                        <th class="text-center-pdf" colspan="2">25-49 qns</th>
                        <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                        <th class="text-center-pdf" rowspan="2">Effectifs</th>
                        <th class="text-center" rowspan="2">%</th>
                    </tr>
                    <tr>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>

                    </tr>
                </thead>
                <tbody>

                    @php
                        $effectifExamenPhysiqueTotal = 0;
                    @endphp

                    <!-- determiner  examens physiques total-->
                    @for ($j = 0; $j < count($trancheAges); $j++)
                    

                        @php
                            $effectifExamenPhysiqueColonne = 0;
                        @endphp

                        @foreach ($examenPhysique->listeExamenPhysique($secretaireRecherche,$debutDate,$finDate) as $listeExamenPhysique)
                            
                            @for ($k = 0; $k < count($sexes); $k++)
                            
                                @php
                                    $effectifExamenPhysiqueColonne +=$examenPhysique->bilanExamenPhysique($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeExamenPhysique->typeExamenPhysique);
                                @endphp

                            @endfor
                        @endforeach
                        @php
                            $effectifExamenPhysiqueTotal += $effectifExamenPhysiqueColonne;
                        @endphp
                    @endfor
            

                    <!-- liste les  Pathologies le bilan-->
                    @foreach ($examenPhysique->listeExamenPhysique($secretaireRecherche,$debutDate,$finDate) as $listeExamenPhysique)

                            @php
                                $effectifExamenPhysique = 0;
                            @endphp
                            <tr>
                                <td>{{$listeExamenPhysique->typeExamenPhysique}}</td>
                                @for ($j = 0; $j < count($trancheAges); $j++)
                                    @for ($k = 0; $k < count($sexes); $k++)
                                    <td class="text-center">{{$examenPhysique->bilanExamenPhysique($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeExamenPhysique->typeExamenPhysique)}}</td>

                                    @php
                                        $effectifExamenPhysique +=$examenPhysique->bilanExamenPhysique($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeExamenPhysique->typeExamenPhysique);
                                    @endphp

                                    @endfor
                                        
                                @endfor
                                <td class="text-center">{{$effectifExamenPhysique}}</td>
                                <td class="text-center">{{ $effectifExamenPhysiqueTotal == 0 ? '0%' : (round(($effectifExamenPhysique*100)/$effectifExamenPhysiqueTotal,2)).'%'}}</td>

                            </tr>
                        
                    @endforeach


                                <!-- liste totaldes Pathologies -->
                    <tr class="text-dark">
                        <th>TOTAL</th>
                        @for ($j = 0; $j < count($trancheAges); $j++)
                            
                            @for ($k = 0; $k < count($sexes); $k++)
                            @php
                                $effectifExamenPhysiqueColonne = 0;
                            @endphp
                                @foreach ($examenPhysique->listeExamenPhysique($secretaireRecherche,$debutDate,$finDate) as $listeExamenPhysique)
                                    
                                        @php
                                            $effectifExamenPhysiqueColonne +=$examenPhysique->bilanExamenPhysique($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeExamenPhysique->typeExamenPhysique);
                                        @endphp

                                    
                                @endforeach
                                <th class="text-center">{{$effectifExamenPhysiqueColonne}}</th>
                            @endfor
                        @endfor
                        <th class="text-center">{{$effectifExamenPhysiqueTotal}}</th>
                        <th class="text-center">100%</th>
                    </tr>
                </tbody>
            </table><br><br>


            <table class="top-titre-detail-pdf">
                <tr class="bg-primary-pdf">
                    <th class="text-light-pdf titre-detail-pdf" style="font-size:22px; width:100%">
                        Nombre traitements
                    </th>
                </tr>
            </table><br>

            <table class="table-bilan">
                <thead class="header-title">
                    <tr class="text-center-pdf">
                        <th rowspan="2">Traitements</th>
                        <th class="text-center-pdf" colspan="2">0-4 ans</th>
                        <th class="text-center-pdf" colspan="2">5-9 ans</th>
                        <th class="text-center-pdf" colspan="2">10-14 ans</th>
                        <th class="text-center-pdf" colspan="2">15-19 ans</th>
                        <th class="text-center-pdf" colspan="2">20-24 ans</th>
                        <th class="text-center-pdf" colspan="2">25-49 qns</th>
                        <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                        <th class="text-center-pdf" rowspan="2">Effectifs</th>
                        <th class="text-center" rowspan="2">%</th>
                    </tr>
                    <tr>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>

                    </tr>
                </thead>
                <tbody>

                    @php
                        $effectifTraitementTotal = 0;
                    @endphp

                    <!-- determiner  Traitement total-->
                    @for ($j = 0; $j < count($trancheAges); $j++)
                    

                        @php
                            $effectifTraitementColonne = 0;
                        @endphp

                        @foreach ($traitement->listeTraitement($secretaireRecherche,$debutDate,$finDate) as $listeTraitement)
                            
                            @for ($k = 0; $k < count($sexes); $k++)
                            
                                @php
                                    $effectifTraitementColonne +=$traitement->bilanTraitement($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeTraitement->typeTraitement);
                                @endphp

                            @endfor
                        @endforeach
                        @php
                            $effectifTraitementTotal += $effectifTraitementColonne;
                        @endphp
                    @endfor
            

                    <!-- liste les  Pathologies le bilan-->
                    @foreach ($traitement->listeTraitement($secretaireRecherche,$debutDate,$finDate) as $listeTraitement)

                            @php
                                $effectifTraitement = 0;
                            @endphp
                            <tr>
                                <td style="width:10%">{{$listeTraitement->typeTraitement}}</td>
                                @for ($j = 0; $j < count($trancheAges); $j++)
                                    @for ($k = 0; $k < count($sexes); $k++)
                                    <td class="text-center">{{$traitement->bilanTraitement($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeTraitement->typeTraitement)}}</td>

                                    @php
                                        $effectifTraitement +=$traitement->bilanTraitement($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeTraitement->typeTraitement);
                                    @endphp

                                    @endfor
                                        
                                @endfor
                                <td class="text-center">{{$effectifTraitement}}</td>
                                <td class="text-center">{{ $effectifTraitementTotal == 0 ? '0%' : (round(($effectifTraitement*100)/$effectifTraitementTotal,2)).'%'}}</td>

                            </tr>
                        
                    @endforeach


                                <!-- liste totaldes Pathologies -->
                    <tr class="text-dark">
                        <th>TOTAL</th>
                        @for ($j = 0; $j < count($trancheAges); $j++)
                            
                            @for ($k = 0; $k < count($sexes); $k++)
                            @php
                                $effectifTraitementColonne = 0;
                            @endphp
                                @foreach ($traitement->listeTraitement($secretaireRecherche,$debutDate,$finDate) as $listeTraitement)
                                    
                                        @php
                                            $effectifTraitementColonne +=$traitement->bilanTraitement($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeTraitement->typeTraitement);
                                        @endphp

                                    
                                @endforeach
                                <th class="text-center">{{$effectifTraitementColonne}}</th>
                            @endfor
                        @endfor
                        <th class="text-center">{{$effectifTraitementTotal}}</th>
                        <th class="text-center">100%</th>
                    </tr>
                </tbody>
            </table>
            
        @endif



        <!-- Soins infirmier -->
        @if ($secretaireRecherche =='Infirmerie')
            <table class="top-titre-detail-pdf">
                <tr class="bg-primary-pdf">
                    <th class="text-light-pdf titre-detail-pdf" style="font-size:22px; width:100%">
                        Soins realies
                    </th>
                </tr>
            </table><br>
            <table class="table-bilan">
                <thead class="header-title">
                    <tr class="text-center-pdf">
                        <th class="text-center" style="width:10%" rowspan="2">Soins</th>
                        <th class="text-center-pdf" colspan="2">0-4 ans</th>
                        <th class="text-center-pdf" colspan="2">5-9 ans</th>
                        <th class="text-center-pdf" colspan="2">10-14 ans</th>
                        <th class="text-center-pdf" colspan="2">15-19 ans</th>
                        <th class="text-center-pdf" colspan="2">20-24 ans</th>
                        <th class="text-center-pdf" colspan="2">25-49 qns</th>
                        <th class="text-center-pdf" colspan="2">50 ans et plus</th>
                        <th class="text-center-pdf" rowspan="2">Effectifs</th>
                        <th class="text-center" rowspan="2">%</th>
                    </tr>
                    <tr>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>
                        <th class="text-center">Masculin</th>
                        <th class="text-center">Feminin</th>

                    </tr>
                </thead>
                <tbody>

                    @php
                        $effectifSoinsTotal = 0;
                    @endphp

                    <!-- determiner  Soins total-->
                    @for ($j = 0; $j < count($trancheAges); $j++)
                    

                        @php
                            $effectifSoinsColonne = 0;
                        @endphp

                        @foreach ($soins->listeSoins($secretaireRecherche,$debutDate,$finDate) as $listeSoins)
                            
                            @for ($k = 0; $k < count($sexes); $k++)
                            
                                @php
                                    $effectifSoinsColonne +=$soins->bilanSoins($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeSoins->soins);
                                @endphp

                            @endfor
                        @endforeach
                        @php
                            $effectifSoinsTotal += $effectifSoinsColonne;
                        @endphp
                    @endfor
            

                    <!-- liste les  Soins le bilan-->
                    @foreach ($soins->listeSoins($secretaireRecherche,$debutDate,$finDate) as $listeSoins)

                            @php
                                $effectifSoins = 0;
                            @endphp
                            <tr>
                                <td>{{$listeSoins->soins}}</td>
                                @for ($j = 0; $j < count($trancheAges); $j++)
                                    @for ($k = 0; $k < count($sexes); $k++)
                                    <td class="text-center">{{$soins->bilanSoins($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeSoins->soins)}}</td>

                                    @php
                                        $effectifSoins +=$soins->bilanSoins($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeSoins->soins);
                                    @endphp

                                    @endfor
                                        
                                @endfor
                                <td class="text-center">{{$effectifSoins}}</td>
                                <td class="text-center">{{ $effectifSoinsTotal == 0 ? '0%' : (round(($effectifSoins*100)/$effectifSoinsTotal,2)).'%'}}</td>

                            </tr>
                        
                    @endforeach


                                <!-- liste totaldes Pathologies -->
                    <tr class="text-dark">
                        <th>TOTAL</th>
                        @for ($j = 0; $j < count($trancheAges); $j++)
                            
                            @for ($k = 0; $k < count($sexes); $k++)
                            @php
                                $effectifSoinsColonne = 0;
                            @endphp
                                @foreach ($soins->listeSoins($secretaireRecherche,$debutDate,$finDate) as $listeSoins)
                                    
                                        @php
                                            $effectifSoinsColonne +=$soins->bilanSoins($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeSoins->soins);
                                        @endphp

                                    
                                @endforeach
                                <th class="text-center">{{$effectifSoinsColonne}}</th>
                            @endfor
                        @endfor
                        <th class="text-center">{{$effectifSoinsTotal}}</th>
                        <th class="text-center">100%</th>
                    </tr>
                </tbody>
            </table>
        @endif 
    @endif

</body>

</html>