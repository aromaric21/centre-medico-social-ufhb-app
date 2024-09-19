<div>

    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <span id="alerteMessageInfo"></span>
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 mt-4">Historique</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route("consultation.index")}}">Liste des patients</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#" wire:click='listeConsultation()'>Liste des
                                consultation</a></li>
                        <li class="breadcrumb-item"><a href="#">Detail</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="card container">
            <button id="medecinePDF" class="btn-imprime-bilan btn btn-sm btn-outline-primary btn-block ml-auto mt-2"
                style="width: 150px;" wire:click="generatePDF">
                <i class="ion ion-printer"></i>Telecharger la fiche medicale
            </button>

            <div class="medecinePDF fichePatient">
                <h4 class="text-center text-primary">CENTRE MEDICO-SOCIAL UFHB</h4>
                <div class="card-header d-flex justify-content-between">
                    <h4 class="">Patient <code>{{optional($patient)->nomPrenom}}</code></h4>
                    <h4>Docteur
                        <code>{{optional($consultation->user)->prenom}} {{optional($consultation->user)->nom}}</code>
                    </h4>
                </div>
                <div class="card-body">
                    <h4 class="bg-primary text-center text-light">Informations Consultation</h4>
                    <div class="container ">
                        <div class="d-flex justify-content-center mb-4 mt-3">
                            <div class="d-flex justify-content-center">
                                <h5 class="text-primary">Date de consultation</h5>
                                <h6 class="ml-2">{{dateTime(optional($consultation)->dateConsultation)}}</h6>

                            </div>
                            <div class="d-flex justify-content-center ml-5">
                                <h5 class="text-primary">Numero fiche</h5>
                                <h6 class="ml-2">{{optional($patient)->numeroFiche}}</h6>

                            </div>
                        </div>
                        <div class="row">
                            <!-- Donnee administrative -->
                            <div class="col-12 col-md-6 col-sm-12 mb-0">
                                <div class="card container card-delete">
                                    <h5 class="bg-primary text-center text-light mt-2">Identification patient</h5>
                                    <div class="ml-3">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <h5 class="text-primary">Age</h5>
                                                <p class="age">{{optional($consultation)->age}}</p>
                                            </div>
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <h5 class="text-primary">Sexe</h5>
                                                <p class="sexe">{{optional($patient)->sexe}}</p>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-12 col-md-6 col-sm-12">
                                                <h5 class="text-primary">Profession</h5>
                                                <p class="profession">{{optional($consultation)->profession}}</p>
                                            </div>
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <h5 class="text-primary">Contacts</h5>
                                                <p class="contact">{{optional($consultation)->contact}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <h5 class="text-primary">Résidence habituelle</h5>
                                                <p class="residenceHabituelle">{{optional($consultation)->residence}}
                                                </p>
                                            </div>
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <h5 class="text-primary">Assurance</h5>
                                                <p class="assure">{{optional($consultation)->assure}}</p>
                                            </div>
                                        </div>
                                        <hr class="bg-primary">
                                    </div>
                                </div>
                            </div>
                            <!-- Informtions cosultation -->
                            <div class="col-12 col-md-6 col-sm-12">
                                <div class="card container">
                                    <h5 class="bg-primary text-center text-light mt-2">Informtions cosultation</h5>
                                    <div class="ml-3">
                                        <div class="row mt-1">
                                            <div class="col-12 col-md-12 col-sm-12">
                                                <h5 class="text-primary">Motif de consultation</h5>
                                                <p>{{optional($consultation)->motifConsultation}}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h5 class="col-12 col-md-12 col-sm-12 bas-souligner text-primary">
                                                Antécédents</h5>
                                        </div>

                                        <div class="row">
                                            @forelse($consultation->antecedents->all() as $listeAntecedent)
                                                @if ($listeAntecedent->typeAntecedent=="Medicaux")
                                                <div class="col-12 col-md-6 col-sm-12">
                                                    <h6 class="text-primary">Médicaux</h6>
                                                    <p class="antecedentMedicaux">{{$listeAntecedent->antecedent}}</p>
                                                </div>
                                                @endif

                                                @if ($listeAntecedent->typeAntecedent=="Chirurgicaux")
                                                <div class="col-12 col-md-6 col-sm-12">
                                                    <h6 class="text-primary">Chirurgicaux</h6>
                                                    <p class="antecedentChirurgicaux">{{$listeAntecedent->antecedent}}</p>
                                                </div>
                                                @endif

                                                @if ($listeAntecedent->typeAntecedent=="Gyneco-Obsterique")
                                                <div class="col-12 col-md-6 col-sm-12">
                                                    <h6 class="text-primary">Gynéco-obstérique</h6>
                                                    <p class="gynecoObsterique">{{$listeAntecedent->antecedent}}</p>
                                                </div>
                                                @endif
                                            @empty
                                                <div class="col-12 col-md-6 col-sm-12">
                                                    <p>Aucun</p>
                                                </div>

                                            @endforelse
                                        </div>
                                        <hr class="bg-primary mt-3">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Histoire de la maladie et hypothes diagnostic -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card container card-delete">

                                    @if (empty($consultation->soins->all()))

                                        <h5 class="bg-primary text-center text-light mt-2">Examens et Diagnostic</h5>

                                        <!-- constance physiques -->
                                        <h5 class="text-primary">Constance physiques</h5>
                                        <div class="row mt-1 px-2">
                                            <div class="col-12 col-md-3 col-sm-12 mt-2">
                                                <div class="">
                                                    <span class="text-primary">Poids:</span>
                                                    <span class="px-2">{{optional($consultation)->poids}}</span>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3 col-sm-12 mt-2">
                                                <div class="">
                                                    <span class="text-primary">Temperature:</span>
                                                    <span class="px-2">{{optional($consultation)->temperature}}</span>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3 col-sm-12 mt-2">
                                                <div class="">
                                                    <span class="text-primary">Tension arterielle:</span>
                                                    <span class="px-2">{{optional($consultation)->tensionArterielle}}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 col-sm-12 mt-2">
                                                <div class="">
                                                    <span class="text-primary">Pouls:</span>
                                                    <span class="px-2">{{optional($consultation)->pouls}}</span>
                                                </div>
                                            </div>
                                        </div><br><br>

                                        <!-- Histoire de la maladie -->
                                        <div class="row mt-2 px-2">
                                            <div class="col-12 col-md-4 col-sm-12">
                                                <div class="">
                                                    <h5 class="text-primary">Histoire de la maladie</h5>
                                                    <p class="motif">{{optional($consultation)->histoireMaladie}}</p>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4 col-sm-12">
                                                <div class="">
                                                    <h5 class="text-primary">Hypothese diagnostic</h5>
                                                    <p class="motif">{{optional($consultation)->hypotheseDiagnostic}}</p>
                                                </div>
                                            </div>

                                            @if ($consultation->service !=='Cabinet dentaire')
                                                <div class="col-12 col-md-4 col-sm-12">
                                                    <div class="">
                                                        <h5 class="text-primary">Examens physiques</h5>
                                                        <p>
                                                            {{optional($consultation->examenPhysiques->first())->libelleExamenPhysique}}
                                                        </p>

                                                    </div>

                                                    @if (optional($consultation->examenPhysiques->first())->imageUrl !== null)
                                                        <h6 class="text-primary col-12">Image/Pdf examen</h6>
                                                        <div class="col-12">

                                                            @if (strpos(optional($consultation->examenPhysiques->first())->imageUrl, "pdf") == false)
                                                                
                                                                <img class="ml-3 row justify-content-star" src="{{asset("storage/".optional($consultation->examenPhysiques->first())->imageUrl)}}" alt="imge examen" style="width:100px; height:100px; border:1px solide blue; border-radius:1px;">
                                                                
                                                            @else
                                                                
                                                                <iframe class="ml-3 row justify-content-star" src="{{ asset('storage/' . optional($consultation->examenPhysiques->first())->imageUrl) }}" width="100px" height="100px"></iframe>
                                                                
                                                            @endif
                                                            <button class="ml-3 btn btn-link row justify-content-star" wire:click='showModal("{{optional($consultation->examenPhysiques->first())->imageUrl}}","imageModal")'>Afficher</button>
                                                            <p class="col-12 mt-2">{{optional($consultation->examenPhysiques->first())->libelleExamenPhysique}}</p>
                                                        </div>
                                                    @endif
                                                    


                                                </div>
                                            @endif


                                            <!-- Examen Complementaires dentaire-->
                                            @if ($consultation->service =='Cabinet dentaire')
                                            <div class="col-12 col-md-4 col-sm-12">
                                                <h5 class="text-primary">Examens complementaires</h5>
                                                @if(!empty($consultation->examenComplementaires->where('examen','Odonto')->all()))
                                                
                                                    <div class="row">
                                                        <div class="col-12 col-md-12 col-sm-12 mt-2">
                                                            <div class="row">
                                                                @foreach($consultation->examenComplementaires->where('examen','Odonto')->all() as $listeExamen)

                                                                @if ($listeExamen->imageUrl !== null)
                                                                    <h6 class="text-primary col-12">Image/Pdf examen</h6>
                                                                    <div class="col-12">

                                                                        @if (strpos($listeExamen->imageUrl, "pdf") == false)
                                                                            
                                                                            <img class="ml-3 row justify-content-star" src="{{asset("storage/".$listeExamen->imageUrl)}}" alt="imge examen" style="width:100px; height:100px; border:1px solide blue; border-radius:1px;">
                                                                            
                                                                        @else
                                                                            
                                                                            <iframe class="ml-3 row justify-content-star" src="{{ asset('storage/' . $listeExamen->imageUrl) }}" width="100px" height="100px"></iframe>
                                                                            
                                                                        @endif
                                                                        <button class="ml-3 btn btn-link row justify-content-star" wire:click='showModal("{{$listeExamen->imageUrl}}","imageModal")'>Afficher</button>
                                                                        <p class="col-12 mt-2">{{$listeExamen->libelleExamenComplementaire}}</p>
                                                                    </div>
                                                                @else
                                                                    
                                                                    <div class="col-12 col-md-12 col-sm-12 mt-2">
                                                                        <li class="text-primary">
                                                                            {{$listeExamen->typeExamen}}
                                                                        </li>
                                                                        <p class="">
                                                                            {{ $listeExamen->libelleExamenComplementaire }}
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                @endif
                                            </div>
                                            @endif

                                        </div><br>

                                        <!-- Examen physique dentaire -->
                                        @if ($consultation->service=='Cabinet dentaire')

                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="text-primary mb-3">Examens physiques</h5>
                                                    <div class="row">
                                                        @forelse ($consultation->examenPhysiques->all() as $listeExamenPhysiques)
                                                            
                                                                @if ($listeExamenPhysiques->imageUrl !== null)
                                                                    <h6 class="text-primary col-12">Image/Pdf examen</h6>
                                                                    <div class="col-12">

                                                                        @if (strpos($listeExamenPhysiques->imageUrl, "pdf") == false)
                                                                            
                                                                            <img class="ml-3 row justify-content-star" src="{{asset("storage/".$listeExamenPhysiques->imageUrl)}}" alt="imge examen" style="width:100px; height:100px; border:1px solide blue; border-radius:1px;">
                                                                            
                                                                        @else
                                                                            
                                                                            <iframe class="ml-3 row justify-content-star" src="{{ asset('storage/' . $listeExamenPhysiques->imageUrl) }}" width="100px" height="100px"></iframe>
                                                                            
                                                                        @endif
                                                                        <button class="ml-3 btn btn-link row justify-content-star" wire:click='showModal("{{$listeExamenPhysiques->imageUrl}}","imageModal")'>Afficher</button>
                                                                        <p class="col-12 mt-2">{{$listeExamenPhysiques->libelleExamenPhysique}}</p>
                                                                    </div>
                                                                @else
                                                                    
                                                                    @if ($listeExamenPhysiques->typeExamenPhysique=='Examen endobuccal')
                                                                        <h6 class="text-primary col-12">Examen endobuccal</h6>
                                                                        
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <p class="text-primary col-1">CAO</p>
                                                                                @foreach (explode("/",$listeExamenPhysiques->libelleExamenPhysique) as $libelle)
                                                                                    <p class="col-3">{{$libelle}}</p>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                    <div class="col-4">
                                                                        <h6 class="text-primary col-12">{{$listeExamenPhysiques->typeExamenPhysique}}</h6>
                                                                        <p class="col-12">{{$listeExamenPhysiques->libelleExamenPhysique}}</p>
                                                                    </div>
                                                                    @endif
                                                                @endif

                                                        @empty
                                                        <p class="text-primary col-12">Aucun</p>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>

                                        @endif

                                        <!-- Pathologies et examen complementaire -->
                                        @if ($consultation->service !=='Cabinet dentaire')
                                            <!-- Pathologies -->
                                            <div class="row mt-2 px-2">
                                                <div class="col-12 col-md-6 col-sm-12 mt-2">
                                                    <div class="">
                                                        <h5 class="text-primary">Pathologies diagnostiquées</h5>


                                                        @forelse($consultation->pathologies->all() as $listePathologie)
                                                        <ul>
                                                            <li>{{$listePathologie->pathologie}}</li>
                                                        </ul>
                                                        @empty
                                                        <p class="p-2">Aucun</p><br><br>
                                                        @endforelse

                                                    </div>
                                                </div>

                                                <!--  Examens complementaire -->
                                                <div class="col-12 col-md-6 col-sm-12 mt-2">
                                                    <div class="">
                                                        <h5 class="text-primary">Examens complementaire</h5>


                                                        @if(!empty($consultation->examenComplementaires->where('examen','Biologique')->all()))
                                                        <div class="row">
                                                            <div class="col-12 col-md-12 col-sm-12 mt-2">
                                                                <h6 class="text-primary"><u>Examens Biologique</u></h6>
                                                                <div class="row">

                                                                    @foreach($consultation->examenComplementaires->where('examen','Biologique')->all() as $listeExamen)

                                                                    <div class="col-12 col-md-6 col-lg-4 col-sm-12 mt-2">
                                                                        <li class="text-primary">
                                                                            {{$listeExamen->typeExamen}}
                                                                        </li>
                                                                        <p class="px-3">
                                                                            {{$listeExamen->libelleExamenComplementaire}}
                                                                        </p>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif


                                                        @if(!empty($consultation->examenComplementaires->where('examen','Radio')->all()))
                                                        <div class="row">
                                                            <div class="col-12 col-md-12 col-sm-12 mt-2">
                                                                <h6 class="text-primary"><u>Examens Radio</u></h6>
                                                                <div class="row">

                                                                    @foreach($consultation->examenComplementaires->where('examen','Radio')->all() as $listeExamen)
                                                                    <div class="col-12 col-md-6 col-lg-4 col-sm-12 mt-2">
                                                                        <li class="text-primary">
                                                                            {{$listeExamen->typeExamen}}
                                                                        </li>
                                                                        <p class="px-3">
                                                                            {{$listeExamen->libelleExamenComplementaire}}
                                                                        </p>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif


                                                        @if(!empty($consultation->examenComplementaires->where('examen','Ophtalmologie')->all()))
                                                        <div class="row">
                                                            <div class="col-12 col-md-12 col-sm-12 mt-2">
                                                                <h6 class="text-primary"><u>Examens Ophtalmologie</u></h6>
                                                                <div class="row">

                                                                    @foreach($consultation->examenComplementaires->where('examen','Ophtalmologie')->all() as $listeExamen)
                                                                    <div class="col-12 col-md-6 col-lg-4 col-sm-12 mt-2">
                                                                        <li class="text-primary">
                                                                            {{$listeExamen->typeExamen}}
                                                                        </li>
                                                                        <p class="px-3">
                                                                            {{ $listeExamen->libelleExamenComplementaire}}
                                                                        </p>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif


                                                        @if(!empty($consultation->examenComplementaires->where('examen','Odonto')->all()))
                                                        <div class="row">
                                                            <div class="col-12 col-md-12 col-sm-12 mt-2">
                                                                <h6 class="text-primary"><u>Examens Odonto</u></h6>
                                                                <div class="row">
                                                                    @foreach($consultation->examenComplementaires->where('examen','Odonto')->all() as $listeExamen)
                                                                    <div class="col-12 col-md-6 col-lg-4 col-sm-12 mt-2">
                                                                        <li class="text-primary">
                                                                            {{$listeExamen->typeExamen}}
                                                                        </li>
                                                                        <p class="px-3">
                                                                            {{ $listeExamen->libelleExamenComplementaire }}
                                                                        </p>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif

                             
                                                        @if (optional($consultation->examenComplementaires->first())->imageUrl !== null)
                                                        <div class="row">
                                                            <div class="col-12 col-md-12 col-sm-12 mt-2">
                                                                <h6 class="text-primary col-12">Image/Pdf examen</h6>
                                                                <div class="col-12">
        
                                                                    @if (strpos(optional($consultation->examenComplementaires->first())->imageUrl, "pdf") == false)
                                                                        
                                                                        <img class="ml-3 row justify-content-star" src="{{asset("storage/".optional($consultation->examenComplementaires->first())->imageUrl)}}" alt="imge examen" style="width:100px; height:100px; border:1px solide blue; border-radius:1px;">
                                                                        
                                                                    @else
                                                                        
                                                                        <iframe class="ml-3 row justify-content-star" src="{{ asset('storage/' . optional($consultation->examenComplementaires->first())->imageUrl) }}" width="100px" height="100px"></iframe>
                                                                        
                                                                    @endif
                                                                    <button class="ml-3 btn btn-link row justify-content-star" wire:click='showModal("{{optional($consultation->examenComplementaires->first())->imageUrl}}","imageModal")'>Afficher</button>
                                                                    <p class="col-12 mt-2">{{optional($consultation->examenComplementaires->first())->libelleExamenComplementaire}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @else


                                            <!-- Soins infirmier -->
                                        <h5 class="bg-primary text-center text-light mt-2">Soins infirmier</h5>
                                        <h5 class="text-primary">Soins realises</h5>
                                        <div class="row mt-1 px-2">
                                            @foreach($consultation->soins->all() as $soins)
                                            <div class="col-12 col-md-3 col-sm-12 mt-2">
                                                <div class="">
                                                    <span class="text-primary">{{$soins->soins}}</span>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div><br>

                                        <!-- Soins infirmier -->
                                    @endif


                                    @if ($consultation->service !=='Cabinet dentaire')
                                        <div class="row mt-2 px-2">

                                            <div class="col-12 col-md-6 col-sm-12 mt-2">
                                                <h5 class="bas-souligner text-primary">Traitement</h5>
                                                <div class="row px-3">
                                                    <div class="col-12 col-md-6 col-sm-6">
                                                        <h6 class="text-primary">Mise en observation</h6>
                                                        <p class="hospitaliser">{{optional($consultation)->miseObservation}}
                                                        </p>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-sm-6">
                                                        <h6 class="text-primary">Référer</h6>
                                                        <p class="referer">{{optional($consultation)->refere}}</p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-12 col-md-6 col-sm-12 mt-2">
                                                <dvi class="col-12">
                                                    <h5 class="text-primary">Prescription</h5>
                                                    <p class="prescription">{{optional($consultation)->traitement}}
                                                    </p>
                                                </dvi>

                                            </div><br><br>
                                        </div>
                                        <hr class="bg-primary">
                                    @endif

                                </div>

                                <!-- Cabinet dentaire -->
                                @if ($consultation->service =='Cabinet dentaire')

                                    <div class="row container">
                                        <div class="card container card-delete">
                                            <div class="row">
                                            
                                                <!-- Diagnostic -->
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="bg-primary text-center text-light mt-2">Diagnostic</h5>
                                                            <div class="row ml-3">
                                                                @forelse($consultation->pathologies->all() as $listePathologie)
                                                                
                                                                <div class="col-12">
                                                                    <h6 class="text-primary mt-2">{{$listePathologie->typePathologie}}</h6>
                                                                    <p>{{$listePathologie->pathologie}}</p>
                                                                </div>
                                                                
                                                                @empty
                                                                <p class="p-2">Aucun</p><br><br>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- traitement Cabinet dentaire-->
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h5 class="bg-primary text-center text-light mt-2">Traitement</h5>
                                                            <div class="row ml-3">
                                                                @foreach($consultation->traitementDentaires->all() as $listetraitementDentaires)
                                                                
                                                                    @if ($listetraitementDentaires->typeTraitement=='Détartrage' || $listetraitementDentaires->typeTraitement=='Surfaçage radiculaire')
                                                                        <p class="col-12">{{$listetraitementDentaires->libelle}}</p>
                                                                    @else
                                                                        <div class="col-12">
                                                                            <h6 class="text-primary mt-2">{{$listetraitementDentaires->typeTraitement}}</h6>
                                                                            <p>{{$listetraitementDentaires->libelle}}</p>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="col-12">
                                                                    <h6 class="text-primary mt-2">Prescription médicamenteuse</h6>
                                                                    <p>{{optional($consultation)->traitement}}</p>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="bg-primary">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>





                    @if (empty($consultation->soins->all()))
                    <h4 class="bg-primary text-center text-light mt-2">Controles liés a la consultation</h4>
                    <div class="p-4">


                        @if (!empty(optional($consultation)->controles->all()))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date de controle</th>
                                    <th>Etat santé</th>
                                    <th>Observation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(optional($consultation)->controles->all() as $controle)
                                <tr>
                                    <td>{{dateTime($controle->dateControle)}}</td>
                                    <td>{{$controle->etatSante}}</td>
                                    <td>{{$controle->observation}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>Aucun</p>
                        @endif
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>


    <div id="imageModal" class="modal fade" data-backdrop="static" data-keyboad="false" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click='closeModal("imageModal")'><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    @if (strpos($fille, "pdf") == false)
                                                                                
                        <img class="justify-content-center" src="{{asset("storage/".$fille)}}" alt="imge examen" width="100%" height="500px">
                        
                    @else
                        
                        <iframe class="justify-content-center" src="{{ asset('storage/' . $fille) }}" width="100%" height="500px"></iframe>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
 </div>

</div>


