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
    <h3 class="text-center-pdf">Fiche medicale</h3>


    <table class="header-top">
        <tr>
            <th class="espace-nom-patient-pdf"><span style="font-size:16px;">Patient:</span> {{$consultation->patient->nomPrenom}}</th>
            <th class="espace-nom-docteur-pdf"><span style="font-size:16px;">Docteur:</span> {{$consultation->user->nom}} {{$consultation->user->prenom}}</th>
            <th class="espace-nom-service-pdf"><span style="font-size:16px;">Service:</span> {{$consultation->service}}</th>
        </tr>
    </table>
    <hr>

    <table class="top-titre-detail-pdf">
        <tr class="bg-primary-pdf">
            <th class="text-light-pdf titre-detail-pdf" style="font-size:22px;">Informations Consultation</th>
        </tr>
    </table>
    <br>

    <table>
        <tr>
            <td class="text-primary-pdf text-center-pdf" style="width:19%;"></td>
            <td class="text-primary-pdf text-center-pdf" style="width:18%; font-size:17px;">date consultation</td>
            <td class="" style="width:13%; font-size:17px;">{{dateTime($consultation->dateConsultation)}}</td>
            <td class="text-primary-pdf text-center-pdf" style="width:15%; font-size:17px;">numero fiche</td>
            <td class="" style="width:10%; font-size:17px;">{{$consultation->patient->numeroFiche}}</td>
        </tr>
    </table><br><br>

    
    <table>
        <thead>
            <tr class="bg-primary-pdf">
                <th class="text-light-pdf titre-detail-pdf" colspan='6' style="margin-bottom:15px;">Identification patient</th>
            </tr>
        </thead>
        <tbody class="card-pdf">
            <tr><td><br></td></tr>
            <tr class="text-center-pdf text-primary-pdf" style="font-size:16px;">
                <td style="height:20px;">
                    Age
                </td>
                <td>
                    Profession
                </td>
                <td>
                    Sexe
                </td>
                <td>
                    Contacts
                </td>
                <td>
                    Résidence
                </td>
                <td>
                    Assurance
                </td>
            </tr>
            <tr class="text-center-pdf" style="font-size:14px;">
                <td>
                    {{$consultation->age}}
                </td>
                <td>
                    {{$consultation->profession}}
                </td>
                <td>
                    {{$consultation->patient->sexe}}
                </td>
                <td>
                    {{$consultation->contact}}
                </td>
                <td>
                    {{$consultation->residence}}
                </td>
                <td>
                    {{$consultation->assure}}
                </td>
            </tr>
        </tbody>
    </table><br><br>

    

    <table>
        <thead>
            <tr class="bg-primary-pdf">
                <th class="text-light-pdf titre-detail-pdf">Motif consultation et Antécédents</th>
            </tr>
        </thead>
        <tbody class="card-pdf">
            <tr><td><br></td></tr>
            <tr>
                <td class="text-primary-pdf" style="font-size:16px;">
                    Motif de consultation
                </td>
            </tr>
            <tr style="margin-bottom:25px;">
                <td style="width:100%; font-size:14px; height:30px;">
                    {{$consultation->motifConsultation}}
                </td>
            </tr>
            <tr><td><br></td></tr>
            @foreach ($consultation->antecedents as $antecedents)
                <tr>
                    <td class="text-primary-pdf" style="font-size:16px;">
                        Antécédents {{$antecedents->typeAntecedent}}
                    </td>
                </tr>
                <tr>
                    <td style="font-size:14px; height:30px;">
                        {{$antecedents->antecedent}}
                    </td>
                </tr>
                <tr><td><br></td></tr>
            @endforeach
           
        </tbody>
    </table><br><br>

    @if (empty($consultation->soins->all()))
        <table style="width:100%;">
            <thead>
                <tr class="bg-primary-pdf">
                    <th class="text-light-pdf titre-detail-pdf" colspan='4'>Histoire de la maladie et Examens physiques</th>
                </tr>
            </thead>
            <tbody class="card-pdf">
                <tr><td><br></td></tr>
                <tr>
                    <td class="text-primary-pdf" colspan='4' style="font-size:17px; height:20px;">
                        Constance physiques
                    </td>
                </tr>
                <tr>
                    <td style="font-size:15px; width:20%;">
                        Poids: {{$consultation->poids}}
                    </td>
                    <td style="font-size:15px; width:20%;">
                        Temperature: {{$consultation->temperature}}
                    </td>
                    <td style="font-size:15px; width:20%;">
                        Tension arterielle: {{$consultation->tensionArterielle}}
                    </td>
                    <td style="font-size:15px; width:20%;">
                        Pouls: {{$consultation->pouls}}
                    </td>
                </tr>
            </tbody>
        </table><br><br>
    @endif
    <!-- Médecine générale  Pédiatrie Infirmerie -->

    @if($consultation->service == 'Médecine générale' || $consultation->service == 'Pédiatrie' || $consultation->service == 'Infirmerie')


        @if (empty($consultation->soins->all()))

            <table style="width:100%;">
                    
                <tr>
                    <td class="text-primary-pdf" style="font-size:16px; height:30px;">
                        Histoire de la maladie
                    </td>
                    <td class="text-primary-pdf" style="font-size:16px;">
                        Hypothese diagnostic
                    </td>
                    <td class="text-primary-pdf" style="font-size:16px;">
                        Examens physiques
                    </td>
                </tr>
                <tr style="width:100%;">
                    <td style="font-size:14px; width:33%; height:30px;">
                        {{$consultation->histoireMaladie}}
                    </td>
                    <td style="font-size:14px; width:33%;">
                        {{$consultation->hypotheseDiagnostic}}
                    </td>
                    <td style="font-size:14px; width:33%;">
                        @forelse ($consultation->examenPhysiques as $examenPhysique)
                            {{$examenPhysique->libelleExamenPhysique}}
                        @empty
                            Aucun
                        @endforelse
                    </td>
                </tr>
            </table><br><br>



            <table style="width:100%;">
                <thead>
                    <tr class="bg-primary-pdf">
                        <th class="text-light-pdf titre-detail-pdf" colspan="2">Examens complementaires</th>
                    </tr>
                </thead>
                <tr><td><br></td></tr>
                <tbody class="card-pdf">
                    @php
                        $examenComplementaire = "";
                    @endphp
                    @forelse ($consultation->examenComplementaires as $examens)
                        @php
                            $currentExamenComplementaire = $examens->examen;
                        @endphp
                        @if ($currentExamenComplementaire != $examenComplementaire)
                            <tr>
                                <td class="text-primary-pdf" style="font-size:16px; height:20px;" colspan="2"><b><u>{{$examens->examen}}</u></b></td>
                            </tr>

                            @foreach ($consultation->examenComplementaires as $typeExamen)
                                @if ($currentExamenComplementaire == $typeExamen->examen)
                                    <tr>
                                        <td class="text-primary-pdf" style="font-size:16px; height:20px; width:20%;">{{$typeExamen->typeExamen}}: </td>
                                        <td style="font-size:16px; height:20px; width:80%;">{{$typeExamen->libelleExamenComplementaire}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            
                            @php
                                $examenComplementaire = $currentExamenComplementaire;
                            @endphp
                        @endif
                        <tr><td></td></tr>
                    @empty
                        Aucun
                    @endforelse
                </tbody>
            </table><br><br>


            <table>
                <thead>
                    <tr class="bg-primary-pdf">
                        <th class="text-light-pdf titre-detail-pdf" colspan='6'>Diagnostics et Prescriptions</th>
                    </tr>
                </thead>
                <tbody class="card-pdf">

                    <tr>
                        <td class="text-primary-pdf" colspan='6' style="font-size:16px; height:30px;"><u><b>Diagnostics</b></u></td>
                    </tr>

                    
                    <tr>
                        @php
                            $i =0;
                        @endphp
                        @foreach ($consultation->pathologies as $pathologies)
                            @if ($i<6)
                                <td style="font-size:14px; width:16%;">
                                    {{$pathologies->pathologie }}
                                </td>
                            @endif
                        @php
                            $i +=1;
                        @endphp
                        @endforeach
                    </tr>

                </tbody>
            </table><br><br>
            

        @else
        <table class="top-titre-detail-pdf">
            <tr class="bg-primary-pdf">
                <th class="text-light-pdf titre-detail-pdf" style="font-size:22px; width:100%">
                    Soins infirmier
                </th>
            </tr>
        </table><br>
        <table>
            <thead>
                <tr>
                    <th class="text-primary-pdf" style="font-size:16px; height:30px;" colspan="4"><u><b>Soins realises</b></u></th>
                  
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($consultation->soins->all() as $soins)
                        <td style="font-size:14px; height:20px; width:25%">{{$soins->soins}}</td>
                    @endforeach
                    
                </tr>
            </tbody>
        </table>
        @endif


        
        <table>
            <thead>
                <tr>
                    <th class="text-primary-pdf" style="font-size:16px; height:30px;" colspan="3"><u><b>Traitement</b></u></th>
                </tr>
            </thead>
            <tbody class="card-pdf">
                <tr>
                    <td style="font-size:15px; width:25%; height:20px;">
                        <span class="text-primary-pdf">Mise en Observation:</span> {{$consultation->miseObservation}}
                    </td>
                    <td style="font-size:15px; width:15%; height:20px;">
                        <span class="text-primary-pdf">Référé:</span> {{$consultation->refere}}:
                    </td>
                    <td style="font-size:15px; width:60%; height:20px;">
                        <span class="text-primary-pdf">Prescription:</span> {{$consultation->traitement}}
                    </td>
                </tr>
                
            </tbody>
        </table><br><br>

    @endif


     <!-- Cabinet dentaire -->
    @if($consultation->service == 'Cabinet dentaire')


        <table style="width:100%;">
            <thead>
                <tr class="bg-primary-pdf">
                    <th class="text-light-pdf titre-detail-pdf" colspan='2'>Examens complementaires et constantes physiques</th>
                </tr>
            </thead>
            <tbody class="card-pdf">
                <tr><td><br></td></tr>
                <tr>
                    <td class="text-primary-pdf" style="font-size:16px; height:30px;">
                        Histoire de la maladie
                    </td>
                    <td class="text-primary-pdf" style="font-size:16px;">
                        Hypothese diagnostic
                    </td>
                </tr>
                <tr style="width:100%;">
                    <td style="font-size:14px; width:50%; height:30px;">
                        {{$consultation->histoireMaladie}}
                    </td>
                    <td style="font-size:14px; width:50%;">
                        {{$consultation->hypotheseDiagnostic}}
                    </td>
                </tr>
                <tr><td><br></td></tr>

                <tr>
                    <td class="text-primary-pdf" style="font-size:16px; height:20px;" colspan='2'>
                        Examens complementaires
                    </td>
                </tr>
                <tr>
                    @foreach ($consultation->examenComplementaires as $examens)
                        <td style="font-size:14px;width:50%;">
                            {{$examens->typeExamen}}: {{$examens->libelleExamenComplementaire}}
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table><br><br>



        <table style="width:100%;">
            <thead>
                <tr class="bg-primary-pdf">
                    <th class="text-light-pdf titre-detail-pdf" colspan='4'>Examens physiques</th>
                </tr>
            </thead>
                <tr><td><br></td></tr>
                <tr>
                    <td class="text-primary-pdf" style="font-size:16px;" colspan='4'>
                        Examens physiques
                    </td>
                </tr>

                @foreach ($consultation->examenPhysiques as $examens)
                    @if ($examens->typeExamenPhysique !== "Examen endobuccal")
                        <tr>
                            <td style="font-size:14px;width:30%; height:30px;" colspan='4'>
                                <span class="text-primary-pdf">{{$examens->typeExamenPhysique}}:</span> {{$examens->libelleExamenPhysique}}  
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td class="text-primary-pdf" style="font-size:15px;" colspan='4'>
                                Examen endobuccal
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:14px;width:10%; height:30px;">
                                CAO:
                            </td>
                            @foreach (explode('/', $examens->libelleExamenPhysique) as $examen)
                                <td style="font-size:14px;width:30%;">
                                    {{$examen}}
                                </td>
                            @endforeach
                            
                        </tr>
                    @endif
                @endforeach
                
        </table><br><br>


        <table>
            <thead>
                <tr class="bg-primary-pdf">
                    <th class="text-light-pdf titre-detail-pdf" colspan='2'>Diagnostic</th>
                </tr>
            </thead>
            <tbody class="card-pdf">
                @foreach ($consultation->pathologies as $pathologies)
                <tr>
                    <td style="font-size:15px; width:20%; height:30px;" class="text-primary-pdf">
                        {{$pathologies->typePathologie}}:
                    </td>
                    <td style="font-size:14px; width:80%;">
                        {{$pathologies->pathologie}}
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table><br><br>
        
        <table>
            <thead>
                <tr class="bg-primary-pdf">
                    <th class="text-light-pdf titre-detail-pdf" colspan='2'>Traitement</th>
                </tr>
            </thead>
            <tbody class="card-pdf">
                @foreach ($consultation->traitementDentaires as $traitements)
                <tr>
                    <td style="font-size:15px; width:20%; height:30px;" class="text-primary-pdf">
                        {{$traitements->typeTraitement}}:
                    </td>
                    <td style="font-size:14px; width:80%;">
                        {{$traitements->libelle}}
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table><br><br>
   

    @endif


     
    <!-- controle -->
    @if (empty($consultation->soins->all()))
    <table>
        <tr class="bg-primary-pdf">
            <th class="text-light-pdf titre-detail-pdf" style="width:100%;">Controles liés à cette consultation</th>
        </tr>
    </table><br><br>

   
        <table class="table-controle">
            <thead>
                <tr class="text-center-pdf">
                    <th class="" style="width:33%;">Date de controle</th>
                    <th class="" style="width:33%;">Etat santé</th>
                    <th class="" style="width:33%;">Observation</th>
                </tr>
            </thead>
            <tbody class="card-pdf">
                @forelse ($consultation->controles as $controle)
                    <tr class="text-center-pdf">
                        <td style="width:33%;">
                            {{dateTime($controle->dateControle) }}
                        </td>
                        <td style="width:33%;">
                            {{$controle->etatSante }}
                        </td>
                        <td style="width:33%;">
                            {{$controle->observation }}
                        </td>
                    </tr>
                @empty
                    Aucun
                @endforelse
                

            </tbody>
        </table><br>
    @endif
</body>
</html>