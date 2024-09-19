<div>

    <div class="page-header">
        <input type="hidden" name="service" id="service" value="Médecine générale">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 mt-4">Bilan</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/testcentreMedicoSociaux/"><i
                                    class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Bilan des consultations</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="card container"><br>

            <div class="card-header text-primary">
                <div class="row">
                    <div class="text-primary col-3 col-lg-3 col-md-12 col-sm-12">
                        <h5 class="text-primary">Bilan activités</h5>
                    </div>
                </div>
                <div class="d-flex justify-content-between row">
                    <form class="form-inline">
                        <input type="hidden" name="typeService" id="typeService" value="Médecine générale">
                        &nbsp;
                        <div class="form-group fill">
                            <label class="text-primary" for="mois">Peride du:</label>
                            <input type="date" class="form-control mr-1"   wire:model.live.debounce.5ms='dateDebut'>
                        </div>
                        &nbsp;
                        <div class="form-group ml-2 fill">
                            <label class="text-primary" for="mois">au:</label>
                            <input type="date" class="form-control mr-5"   wire:model.live.debounce.5ms='dateFin'>
                        </div>
                        @can("secretaire")
                        <select wire:model.live.debounce='rechercheSecretaire' class="form-control">
                            <option value="tous">Service</option>
                            @foreach ($roles->get() as $role)
                                @if ( !in_array($role->libelleRole,["Admin","Secrétaire","Pharmacien","Caissière"]))
                                  <option value="{{$role->service}}">{{$role->service}}</option>
                                @endif
                            @endforeach
                            
                        </select>
                        @endcan
                    </form>
                    <div >
                        <button class="btn btn-sm btn-outline-primary ml-3" wire:click="generatePDF">Telecharger le bilan </button>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="mt-3">
                    <div class="text-center">
                        <h5 class="text-primary">
                            <label id="periodeBilan"><strong>{{$periode}}</strong></label>
                        </h5>
                    </div>
                </div>
                <div class="card-body table-border-style">

                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-uppercase has-ripple active" id="patientRecu-tab" data-toggle="tab"
                                href="#patientRecu" role="tab" aria-controls="patientRecu" aria-selected="true">Patients
                                reçus<span class="ripple ripple-animate"
                                    style="height: 141.5px; width: 141.5px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -49.125px; left: 19.25px;"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase has-ripple" id="consultations-tab" data-toggle="tab"
                                href="#consultations" role="tab" aria-controls="consultations"
                                aria-selected="false">Consultations<span class="ripple ripple-animate"
                                    style="height: 144.828px; width: 144.828px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -53.781px; left: 9.094px;"></span></a>
                        </li>
                        @if ($secretaireRecherche !== "tous")
                        
                            <li class="nav-item">
                                <a class="nav-link text-uppercase has-ripple" id="pathologies-tab" data-toggle="tab"
                                    href="#pathologies" role="tab" aria-controls="pathologies"
                                    aria-selected="false">Pathologies<span class="ripple ripple-animate"
                                        style="height: 126.016px; width: 126.016px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -46.383px; left: -9.33612px;"></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase has-ripple" id="antecedent-tab" data-toggle="tab"
                                    href="#antecedent" role="tab" aria-controls="antecedent"
                                    aria-selected="false">Antecedents<span class="ripple ripple-animate"
                                        style="height: 127.547px; width: 127.547px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -43.1485px; left: 12.8827px;"></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase has-ripple" id="examne-tab" data-toggle="tab"
                                    href="#examne" role="tab" aria-controls="examne" aria-selected="false">Examnes<span
                                        class="ripple ripple-animate"
                                        style="height: 95.3906px; width: 95.3906px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -30.0625px; left: -20.5781px;"></span></a>
                            </li>
                            @if (getRoleServiceName()=='Cabinet dentaire' || $secretaireRecherche == "Cabinet dentaire")
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase" id="traitement-tab" data-toggle="tab"
                                        href="#traitement" role="tab" aria-controls="traitement"
                                        aria-selected="false">Traitement</a>
                                </li>
                            @endif
                            @if (getRoleServiceName()=='Infirmerie' || $secretaireRecherche == "Infirmerie")
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase" id="soins-tab" data-toggle="tab"
                                        href="#soins" role="tab" aria-controls="soins"
                                        aria-selected="false">Soins Infirmier
                                        <span
                                        class="ripple ripple-animate"
                                        style="height: 95.3906px; width: 95.3906px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(70, 128, 255); opacity: 0.4; top: -30.0625px; left: -20.5781px;"></span></a></a>
                                </li>
                            @endif

                        @endif

                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- Patient reçu -->
                        <div class="tab-pane fade active show" id="patientRecu" role="tabpanel"
                            aria-labelledby="patientRecu-tab">
                            <div class="mb-0">
                                <div id="bilanPatientRecu">
                                    <h5 class="text-center bas-souligner mb-3">Nombre de patients reçus</h5>
                                    <div class="table-responsive">
                                        <table class="striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2">PATIENTS</th>
                                                    <th class="text-center" colspan="2">0-4 ANS</th>
                                                    <th class="text-center" colspan="2">5-9 ANS</th>
                                                    <th class="text-center" colspan="2">10-14 ANS</th>
                                                    <th class="text-center" colspan="2">15-19 ANS</th>
                                                    <th class="text-center" colspan="2">20-24 ANS</th>
                                                    <th class="text-center" colspan="2">25-49 ANS</th>
                                                    <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                    <th class="text-center" rowspan="2">EFFECTIF</th>
                                                    <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                                                    $effectifTotal=0;
                                                @endphp
                                                @for ($i = 0; $i < count($professions); $i++)
                                                    @php
                                                        $effectif=0;
                                                    @endphp
                                                        @for ($j = 0; $j < count($trancheAges); $j++)
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                                @php
                                                                    $effectif+=$patient->bilanPatient($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                                                                @endphp
                                                                
                                                            @endfor
                                                            
                                                        @endfor
                                                        @php
                                                            $effectifTotal+=$effectif;
                                                        @endphp
                                                @endfor


                                                @for ($i = 0; $i < count($professions); $i++)
                                                    @php
                                                        $effectif=0;
                                                    @endphp
                                                    <tr class="text-center">
                                                        <td>{{$professions[$i]}}</td>
                                                        @for ($j = 0; $j < count($trancheAges); $j++)
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                                <td>{{$patient->bilanPatient($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate)}}</td>
                                                                @php
                                                                    $effectif+=$patient->bilanPatient($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                                                                @endphp
                                                                
                                                            @endfor
                                                            
                                                        @endfor
                                                        <td>{{$effectif}}</td>
                                                        <td>{{ $effectifTotal == 0 ? '0%' : (round(($effectif*100)/$effectifTotal,2)).'%'}}</td>
                               
                                                    </tr>
                                                @endfor


                                                <tr class="text-center">
                                                    <th>TOTAL</th>
                                                    @for ($i = 0; $i < count($trancheAges); $i++)
                                                       
                                                        @for ($j = 0; $j < count($sexes); $j++)
                                                            @php
                                                                $effectif=0;
                                                            @endphp
                                                            @for ($k = 0; $k < count($professions); $k++)
                                                                
                                                                @php
                                                                    $effectif+=$patient->bilanPatient($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);
                                                                    
                                                                @endphp
                                                                 
                                                            @endfor
                                                            <th>{{$effectif}}</th>
                                                            
                                                        @endfor
                                                        
                                                @endfor
                                                    <th>{{$effectifTotal}}</th>
                                                    <th>100%</th>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <br><br>
                                </div>
                            </div>
                        </div>

                        <!-- Consultation -->
                        <div class="tab-pane fade" id="consultations" role="tabpanel"
                            aria-labelledby="consultations-tab">
                            <div class="mb-0">
                                <div id="bilanConsultations">
                                    <h5 class="text-center bas-souligner mb-3">Nombre de consultation</h5>
                                    <div class="table-responsive">
                                        <table class="striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2">PATIENTS</th>
                                                    <th class="text-center" colspan="2">0-4 ANS</th>
                                                    <th class="text-center" colspan="2">5-9 ANS</th>
                                                    <th class="text-center" colspan="2">10-14 ANS</th>
                                                    <th class="text-center" colspan="2">15-19 ANS</th>
                                                    <th class="text-center" colspan="2">20-24 ANS</th>
                                                    <th class="text-center" colspan="2">25-49 ANS</th>
                                                    <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                    <th class="text-center" rowspan="2">EFFECTIF</th>
                                                    <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                                                    $effectifTotalConsultation=0;
                                                @endphp
                                                @for ($i = 0; $i < count($professions); $i++)
                                                    @php
                                                        $effectif=0;
                                                    @endphp
                                                        @for ($j = 0; $j < count($trancheAges); $j++)
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                                @php
                                                                    $effectif+=$consultation->bilanConsultation($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                                                                @endphp
                                                                
                                                            @endfor
                                                            
                                                        @endfor
                                                        @php
                                                            $effectifTotalConsultation+=$effectif;
                                                        @endphp
                                                @endfor


                                                @for ($i = 0; $i < count($professions); $i++)
                                                    @php
                                                        $effectif=0;
                                                    @endphp
                                                    <tr class="text-center">
                                                        <td>{{$professions[$i]}}</td>
                                                        @for ($j = 0; $j < count($trancheAges); $j++)
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                                <td>{{$consultation->bilanConsultation($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate)}}</td>
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
                                                    @for ($i = 0; $i < count($trancheAges); $i++)
                                                       
                                                        @for ($j = 0; $j < count($sexes); $j++)
                                                            @php
                                                                $effectif=0;
                                                            @endphp
                                                            @for ($k = 0; $k < count($professions); $k++)
                                                                
                                                                @php
                                                                    $effectif+=$consultation->bilanConsultation($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);
                                                                    
                                                                @endphp
                                                                 
                                                            @endfor
                                                            <th>{{$effectif}}</th>
                                                            
                                                        @endfor
                                                        
                                                    @endfor
                                                    <th>{{$effectifTotalConsultation}}</th>
                                                    <th>100%</th>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </div>

                                    <hr>
                                    <br><br>
                                    <h5 class="text-center bas-souligner mb-3">Nombre de controle</h5>
                                    <div class="table-responsive">
                                        <table class="striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2">PATIENTS</th>
                                                    <th class="text-center" colspan="2">0-4 ANS</th>
                                                    <th class="text-center" colspan="2">5-9 ANS</th>
                                                    <th class="text-center" colspan="2">10-14 ANS</th>
                                                    <th class="text-center" colspan="2">15-19 ANS</th>
                                                    <th class="text-center" colspan="2">20-24 ANS</th>
                                                    <th class="text-center" colspan="2">25-49 ANS</th>
                                                    <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                    <th class="text-center" rowspan="2">EFFECTIF</th>
                                                    <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                                                    $effectifTotalControle=0;
                                                @endphp
                                                @for ($i = 0; $i < count($professions); $i++)
                                                    @php
                                                        $effectif=0;
                                                    @endphp
                                                        @for ($j = 0; $j < count($trancheAges); $j++)
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                                @php
                                                                    $effectif+=$controle->bilanControle($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate);
                                                                @endphp
                                                                
                                                            @endfor
                                                            
                                                        @endfor
                                                        @php
                                                            $effectifTotalControle+=$effectif;
                                                        @endphp
                                                @endfor


                                                @for ($i = 0; $i < count($professions); $i++)
                                                    @php
                                                        $effectif=0;
                                                    @endphp
                                                    <tr class="text-center">
                                                        <td>{{$professions[$i]}}</td>
                                                        @for ($j = 0; $j < count($trancheAges); $j++)
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                                <td>{{$controle->bilanControle($secretaireRecherche,$sexes[$k],$professions[$i],$trancheAges[$j],$debutDate,$finDate)}}</td>
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
                                                    @for ($i = 0; $i < count($trancheAges); $i++)
                                                       
                                                        @for ($j = 0; $j < count($sexes); $j++)
                                                            @php
                                                                $effectif=0;
                                                            @endphp
                                                            @for ($k = 0; $k < count($professions); $k++)
                                                                
                                                                @php
                                                                    $effectif+=$controle->bilanControle($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);
                                                                    
                                                                @endphp
                                                                 
                                                            @endfor
                                                            <th>{{$effectif}}</th>
                                                            
                                                        @endfor
                                                        
                                                @endfor
                                                    <th>{{$effectifTotalControle}}</th>
                                                    <th>100%</th>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <br><br>




                                    <h5 class="text-center bas-souligner mb-3">Bilan consultation</h5>
                                    <div class="table-responsive">
                                        <table class="striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2">CARACTERISTIQUES</th>
                                                    <th class="text-center" colspan="2">0-4 ANS</th>
                                                    <th class="text-center" colspan="2">5-9 ANS</th>
                                                    <th class="text-center" colspan="2">10-14 ANS</th>
                                                    <th class="text-center" colspan="2">15-19 ANS</th>
                                                    <th class="text-center" colspan="2">20-24 ANS</th>
                                                    <th class="text-center" colspan="2">25-49 ANS</th>
                                                    <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                    <th class="text-center" rowspan="2">EFFECTIF</th>
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
                                                    @for ($i = 0; $i < count($trancheAges); $i++)
                                                       
                                                        @for ($j = 0; $j < count($sexes); $j++)
                                                            @php
                                                                $effectif=0;
                                                            @endphp
                                                            @for ($k = 0; $k < count($professions); $k++)
                                                                
                                                                @php
                                                                    $effectif+=$consultation->bilanConsultation($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);
                                                                    
                                                                @endphp
                                                                 
                                                            @endfor
                                                            <td>{{$effectif}}</td>
                                                            
                                                        @endfor
                                                        
                                                    @endfor
                                                    <td>{{$effectifTotalConsultation}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>Controle</td>
                                                    @for ($i = 0; $i < count($trancheAges); $i++)
                                                       
                                                        @for ($j = 0; $j < count($sexes); $j++)
                                                            @php
                                                                $effectif=0;
                                                            @endphp
                                                            @for ($k = 0; $k < count($professions); $k++)
                                                                
                                                                @php
                                                                    $effectif+=$controle->bilanControle($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);
                                                                    
                                                                @endphp
                                                                
                                                            @endfor
                                                            <td>{{$effectif}}</td>
                                                            
                                                        @endfor
                                                        
                                                    @endfor
                                                    
                                                    <td>{{$effectifTotalControle}}</td>
                                                </tr>

                                                <tr class="text-center">
                                                    <th class="text-center">TOTAL</th>
                                                    @for ($i = 0; $i < count($trancheAges); $i++)
                                                       
                                                        @for ($j = 0; $j < count($sexes); $j++)
                                                            @php
                                                                $effectifControle=0;
                                                                $effectifConsultation=0;
                                                            @endphp
                                                            @for ($k = 0; $k < count($professions); $k++)
                                                                
                                                                @php
                                                                    $effectifConsultation+=$consultation->bilanConsultation($secretaireRecherche,$sexes[$j],$professions[$k],$trancheAges[$i],$debutDate,$finDate);
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
                                        </table>
                                    </div>
                                    <hr>
                                    <br><br>


                                    <div class="justify-content-end d-flex">
                                        <h6 class="mr-5"><span class="text-primary">Nombre de cas de mise en observation</span>
                                            <span style="font-size:20px;">{{$consultation->bilanTraitement($secretaireRecherche,'miseObservation','Oui',$debutDate,$finDate)}}</span>
                                        </h6>
                                        <h6 class="ml-5"><span class="text-primary">Nombre de cas référés </span>
                                            <span style="font-size:20px;">{{$consultation->bilanTraitement($secretaireRecherche,'refere','Oui',$debutDate,$finDate)}}</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($secretaireRecherche !== "tous")
                        <!-- Pathologies -->
                        <div class="tab-pane fade" id="pathologies" role="tabpanel" aria-labelledby="pathologies-tab">
                            <div class="mb-0">
                                <div id="bilanPathologies">
                                    <h5 class="text-center bas-souligner mb-3">Pathologies diagnostiquées</h5>
                                    <div class="table-responsive">
                                        <table class="striped">
                                            <thead>
                                                <tr>
                                                    <th class="" rowspan="2">PATHOLOGIES</th>
                                                    <th class="text-center" colspan="2">0-4 ANS</th>
                                                    <th class="text-center" colspan="2">5-9 ANS</th>
                                                    <th class="text-center" colspan="2">10-14 ANS</th>
                                                    <th class="text-center" colspan="2">15-19 ANS</th>
                                                    <th class="text-center" colspan="2">20-24 ANS</th>
                                                    <th class="text-center" colspan="2">25-49 ANS</th>
                                                    <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                    <th class="text-center" rowspan="2">EFFECTIF</th>
                                                    <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                                                @for ($j = 0; $j < count($trancheAges); $j++)
                                                

                                                    @php
                                                        $effectifPathologieColonne = 0;
                                                    @endphp

                                                    @foreach ($pathologie->listePathologie($secretaireRecherche,$debutDate,$finDate) as $listePathologie)
                                                        
                                                        @for ($k = 0; $k < count($sexes); $k++)
                                                        
                                                            @php
                                                                $effectifPathologieColonne +=$pathologie->bilanPathologie($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listePathologie->typePathologie);
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
                                                            <td>{{$listePathologie->typePathologie}}</td>
                                                            @for ($j = 0; $j < count($trancheAges); $j++)
                                                                @for ($k = 0; $k < count($sexes); $k++)
                                                                <td class="text-center">{{$pathologie->bilanPathologie($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listePathologie->typePathologie)}}</td>

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
                                                    @for ($j = 0; $j < count($trancheAges); $j++)
                                                       
                                                        @for ($k = 0; $k < count($sexes); $k++)
                                                        @php
                                                            $effectifPathologieColonne = 0;
                                                        @endphp
                                                            @foreach ($pathologie->listePathologie($secretaireRecherche,$debutDate,$finDate) as $listePathologie)
                                                                
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
                                        </table>
                                    </div>

                                    <hr>
                                    <br><br>
                                </div>
                            </div>
                        </div>


                        <!-- antecedent -->
                        <div class="tab-pane fade" id="antecedent" role="tabpanel" aria-labelledby="antecedent-tab">
                            <div class="mb-0">
                                <h5 class="text-center bas-souligner mb-3">Nombre antecedents</h5>
                                <div class="table-responsive">
                                    <table class="striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">ANTECEDENTS</th>
                                                <th class="text-center" colspan="2">0-4 ANS</th>
                                                <th class="text-center" colspan="2">5-9 ANS</th>
                                                <th class="text-center" colspan="2">10-14 ANS</th>
                                                <th class="text-center" colspan="2">15-19 ANS</th>
                                                <th class="text-center" colspan="2">20-24 ANS</th>
                                                <th class="text-center" colspan="2">25-49 ANS</th>
                                                <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                <th class="text-center" rowspan="2">EFFECTIF</th>
                                                <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                                            @for ($j = 0; $j < count($trancheAges); $j++)
                                            

                                                @php
                                                    $effectifAntecedentColonne = 0;
                                                @endphp

                                                @foreach ($antecedent->listeAntecedent($secretaireRecherche,$debutDate,$finDate) as $listeAntecedent)
                                                    
                                                    @for ($k = 0; $k < count($sexes); $k++)
                                                    
                                                        @php
                                                            $effectifAntecedentColonne +=$antecedent->bilanAntecedent($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeAntecedent->typeAntecedent);
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
                                                        <td>{{$listeAntecedent->typeAntecedent}}</td>
                                                        @for ($j = 0; $j < count($trancheAges); $j++)
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                            <td class="text-center">{{$antecedent->bilanAntecedent($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$listeAntecedent->typeAntecedent)}}</td>

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
                                                @for ($j = 0; $j < count($trancheAges); $j++)
                                                    
                                                    @for ($k = 0; $k < count($sexes); $k++)
                                                    @php
                                                        $effectifAntecedentColonne = 0;
                                                    @endphp
                                                        @foreach ($antecedent->listeAntecedent($secretaireRecherche,$debutDate,$finDate) as $listeAntecedent)
                                                            
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
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- examnes complementaires-->
                        <div class="tab-pane fade" id="examne" role="tabpanel" aria-labelledby="examne-tab">
                            <div class="mb-0 mt-2">
                                @for ($i = 0; $i < count($examenComplementairesArray); $i++)
                                    
                                    @php
                                        $examen = $examenComplementairesArray[$i];
                                    @endphp

                                    @if ($examenComplementairesArray[$i]=='Odonto' && (getRoleServiceName() =='Cabinet dentaire' || $secretaireRecherche == 'Cabinet dentaire'))
                                        
                                        <h5 class="text-center bas-souligner mb-3">Nombre examens {{$examenComplementairesArray[$i]}}</h5>
                                        <div class="table-responsive">
                                            <table class="striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" rowspan="2">EXAMENS</th>
                                                        <th class="text-center" colspan="2">0-4 ANS</th>
                                                        <th class="text-center" colspan="2">5-9 ANS</th>
                                                        <th class="text-center" colspan="2">10-14 ANS</th>
                                                        <th class="text-center" colspan="2">15-19 ANS</th>
                                                        <th class="text-center" colspan="2">20-24 ANS</th>
                                                        <th class="text-center" colspan="2">25-49 ANS</th>
                                                        <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                        <th class="text-center" rowspan="2">EFFECTIF</th>
                                                        <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                                                    @for ($j = 0; $j < count($trancheAges); $j++)
                                                    

                                                        @php
                                                            $effectifExamenComplementairesColonne = 0;
                                                        @endphp

                                                        @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)
                                                            
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                            
                                                                @php
                                                                    $effectifExamenComplementairesColonne +=$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen);
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
                                                                @for ($j = 0; $j < count($trancheAges); $j++)
                                                                    @for ($k = 0; $k < count($sexes); $k++)
                                                                    <td class="text-center">{{$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen)}}</td>

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
                                                        @for ($j = 0; $j < count($trancheAges); $j++)
                                                            
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                            @php
                                                                $effectifExamenComplementairesColonne = 0;
                                                            @endphp
                                                                @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)
                                                                    
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
                                        </div><br><br>

                                    @elseif(getRoleServiceName() !=='Cabinet dentaire' || $secretaireRecherche !=='Cabinet dentaire') 
                                        <h5 class="text-center bas-souligner mb-3">Nombre examens {{$examenComplementairesArray[$i]}}</h5>
                                        <div class="table-responsive">
                                            <table class="striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" rowspan="2">EXAMENS</th>
                                                        <th class="text-center" colspan="2">0-4 ANS</th>
                                                        <th class="text-center" colspan="2">5-9 ANS</th>
                                                        <th class="text-center" colspan="2">10-14 ANS</th>
                                                        <th class="text-center" colspan="2">15-19 ANS</th>
                                                        <th class="text-center" colspan="2">20-24 ANS</th>
                                                        <th class="text-center" colspan="2">25-49 ANS</th>
                                                        <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                        <th class="text-center" rowspan="2">EFFECTIF</th>
                                                        <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                                                    @for ($j = 0; $j < count($trancheAges); $j++)
                                                    

                                                        @php
                                                            $effectifExamenComplementairesColonne = 0;
                                                        @endphp

                                                        @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)
                                                            
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                            
                                                                @php
                                                                    $effectifExamenComplementairesColonne +=$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen);
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
                                                                @for ($j = 0; $j < count($trancheAges); $j++)
                                                                    @for ($k = 0; $k < count($sexes); $k++)
                                                                    <td class="text-center">{{$examenComplementaires->bilanExamenComplementaires($secretaireRecherche,$sexes[$k],$trancheAges[$j],$debutDate,$finDate,$examen,$listeExamenComplementaire->typeExamen)}}</td>

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
                                                        @for ($j = 0; $j < count($trancheAges); $j++)
                                                            
                                                            @for ($k = 0; $k < count($sexes); $k++)
                                                            @php
                                                                $effectifExamenComplementairesColonne = 0;
                                                            @endphp
                                                                @foreach ($examenComplementaires->listeExamenComplementaire($secretaireRecherche,$debutDate,$finDate,$examen) as $listeExamenComplementaire)
                                                                    
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
                                        </div><br><br>

                                    @endif

                                @endfor


                                <!-- Nombre examens physiques -->
                        @if (getRoleServiceName() == 'Cabinet dentaire' || $secretaireRecherche== "Cabinet dentaire")
                        <h5 class="text-center bas-souligner mb-3">Nombre examens physiques</h5>
                        <div class="table-responsive">
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th rowspan="2">EXAMENS</th>
                                        <th class="text-center" colspan="2">0-4 ANS</th>
                                        <th class="text-center" colspan="2">5-9 ANS</th>
                                        <th class="text-center" colspan="2">10-14 ANS</th>
                                        <th class="text-center" colspan="2">15-19 ANS</th>
                                        <th class="text-center" colspan="2">20-24 ANS</th>
                                        <th class="text-center" colspan="2">25-49 ANS</th>
                                        <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                        <th class="text-center" rowspan="2">EFFECTIF</th>
                                        <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                            </table>
                        </div>
                        @endif
                                
                            </div>
                        </div>


                        <!-- Traitement dentaire -->
                        @if (getRoleServiceName() == 'Cabinet dentaire' || $secretaireRecherche== "Cabinet dentaire")
                        <div class="tab-pane fade" id="traitement" role="tabpanel" aria-labelledby="traitement-tab">
                            <div class="mb-0">
                                <h5 class="text-center bas-souligner mb-3">Nombre traitements</h5>
                                <div class="table-responsive">
                                    <table class="striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">TRAITEMENTS</th>
                                                <th class="text-center" colspan="2">0-4 ANS</th>
                                                <th class="text-center" colspan="2">5-9 ANS</th>
                                                <th class="text-center" colspan="2">10-14 ANS</th>
                                                <th class="text-center" colspan="2">15-19 ANS</th>
                                                <th class="text-center" colspan="2">20-24 ANS</th>
                                                <th class="text-center" colspan="2">25-49 ANS</th>
                                                <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                <th class="text-center" rowspan="2">EFFECTIF</th>
                                                <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                                                        <td>{{$listeTraitement->typeTraitement}}</td>
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
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Soins infirmier -->
                        @if (getRoleServiceName()=='Infirmerie' || $secretaireRecherche== "Infirmerie")
                            <div class="tab-pane fade" id="soins" role="tabpanel" aria-labelledby="soins-tab">
                                <div class="mb-0">
                                    <h5 class="text-center bas-souligner mb-3">Soins realies</h5>
                                    <div class="table-responsive">
                                        <table class="striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2">SOINS</th>
                                                    <th class="text-center" colspan="2">0-4 ANS</th>
                                                    <th class="text-center" colspan="2">5-9 ANS</th>
                                                    <th class="text-center" colspan="2">10-14 ANS</th>
                                                    <th class="text-center" colspan="2">15-19 ANS</th>
                                                    <th class="text-center" colspan="2">20-24 ANS</th>
                                                    <th class="text-center" colspan="2">25-49 ANS</th>
                                                    <th class="text-center" colspan="2">50 ANS ET PLUS</th>
                                                    <th class="text-center" rowspan="2">EFFECTIF</th>
                                                    <th class="text-center" rowspan="2">POURCENTAGE</th>
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
                                    </div><br><br>
                                </div>
                            </div>
                        @endif    
                        
                        @endif

                    </div>

                </div>
            </div>


        </div>
    </div>


</div>



<script>
    
    document.addEventListener('livewire:init', () => {
        Livewire.on('generatePdf', (event) => {
            if (event.pdf != ''){
                let pdfWindow = window.open("");
                pdfWindow.document.write("<iframe width='100%' height='100%' src='data:application/pdf;base64,"+event.pdf+"'></iframe>");
            }
            
        });
    });

</script>