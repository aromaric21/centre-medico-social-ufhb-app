<div class="row">

    <div class="card container">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                    <h5><i class="feather icon-users mr-2"></i>Liste des patients : <code style="font-size: 18px">{{count($patients)}}</code>
                        @if (count($patients)>1)
                            patients
                        @else
                            patient
                        @endif
                    </h5>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="justify-content-center d-flex">
                        <input type="text" name="recherche" wire:model.live.debounce="search"
                            class="form-control col-7 col-lg-7 col-sm-8 col-md-8"
                            placeholder="Nom / Prenom / Numero fiche">
                        <span class="fa fa-search col-2 col-lg-2 col-sm-2 col-md-2 mt-3"></span>
                    </div>
                </div>
                @can('docteur')
                <div class="col-12 col-sm-12 col-md-2">
                    <button class="btn btn-outline-primary btn-sm" wire:click.prevent='goToNewPatient()'><i
                            class="feather icon-user-plus"></i> Nouveau patient</button>
                </div>
                @endcan
                

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%"></th>
                            <th class="text-center" style="width: 10%">N° fiche</th>
                            <th style="width: 20%">Nom et prenoms</th>
                            <th class="text-center" style="width: 5%">Age</th>
                            <th class="text-center" style="width: 10%">Contact</th>
                            <th class="text-center" style="width: 12%">Lieu d'habitation</th>
                            <th class="text-center" style="width: 5%">Assurance</th>
                            <th class="text-center" style="width: 10%">Profession</th>
                            <th class="text-center" style="width: 13%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                        <tr>
                            <td class="text-center">
                                @if ($patient->sexe =='Masculin')
                                <img src="{{asset('assets/images/homme2.png')}}" width="40">
                                @endif
                                @if ($patient->sexe =='Féminin')
                                <img src="{{asset('assets/images/femme2.png')}}" width="40">
                                @endif
                            </td>
                            <td class="text-center">{{$patient->numeroFiche}}</td>
                            <td>{{$patient->nomPrenom}}</td>
                            <td class="text-center">{{$patient->lastConsultations($patient->id)->age}}</td>
                            <td class="text-center">{{$patient->lastConsultations($patient->id)->contact}}</td>
                            <td class="text-center">{{$patient->lastConsultations($patient->id)->residence}}</td>
                            <td class="text-center">{{$patient->lastConsultations($patient->id)->assure}}</td>
                            <td class="text-center">{{$patient->lastConsultations($patient->id)->profession}}</td>

                            <td class="text-center">
                                @can('docteur')
                                    <div class="btn-group mr-2">
                                        <button class="btn btn-link" type="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" title="Consultation">
                                            <!-- https://feathericons.dev/?search=user-plus&iconset=feather -->
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                                height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                                <circle cx="8.5" cy="7" r="4" />
                                                <line x1="20" x2="20" y1="8" y2="14" />
                                                <line x1="23" x2="17" y1="11" y2="11" />
                                            </svg>

                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" wire:click='goToExPatient("{{$patient->id}}")'>
                                                Consultation
                                            </button>
                                            <button class="dropdown-item {{empty($patient->listConsultationsByService->all()) ? 'disabled' : ''}}" 
                                                wire:click='goToSuiteConsultation("{{$patient->id}}")'>
                                                Suite Consultation
                                            </button>
                                            <button class="dropdown-item {{empty($patient->listConsultationsByService->all()) ? 'disabled' : ''}}"
                                                wire:click='showModal("{{$patient->id}}","controleModal")'>
                                                Controle
                                            </button>
                                        </div>
                                    </div>
                                    <button class="btn btn-link"
                                        wire:click='showModal("{{$patient->id}}","editePatientModal")' title="Editer">
                                        <!-- https://feathericons.dev/?search=edit&iconset=feather -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                            class="main-grid-item-icon" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>

                                    </button>
                                @endcan
                                <a href="{{route('historique.consultation.index',$patient->id)}}" class="btn btn-link"
                                    title="Historique">
                                    <!-- https://feathericons.dev/?search=file-text&iconset=feather -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                        class="main-grid-item-icon" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                        <line x1="16" x2="8" y1="13" y2="13" />
                                        <line x1="16" x2="8" y1="17" y2="17" />
                                        <polyline points="10 9 9 9 8 9" />
                                    </svg>

                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{$patients->links()}}
        </div>
    </div>

    <!-- Modal controle -->
    <div id="controleModal" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="gridModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="gridModalLabel">controle de
                        <code>{{optional($infoPatient)->nomPrenom}}</code>
                    </h2>
                </div>
                <div class="modal-body">
                    <div class="">
                        <form>

                            <h5 class="bas-souligner text-primary">Etat santé</h5>

                            <div class="row px-1">
                                <div class="col-12 col-md-3 col-sm-12 form-check">
                                    <input class="form-check-input @error('controle.etatSante') text-danger @enderror"
                                        type="radio" name="etatSante" id="guerir" value="Guérir"
                                        wire:model="controle.etatSante">
                                    <label
                                        class="form-check-label text-primary @error('controle.etatSante') text-danger @enderror"
                                        for="guerir">Guérir</label>
                                </div>
                                <div class="col-12 col-md-9 col-sm-12">
                                    <div class="row">
                                        <div class="col-12 col-md-3 col-sm-12">
                                            <span class="text-primary">Evolution</span>
                                        </div>
                                        <div class="col-12 col-md-4 col-sm-12 form-check">
                                            <input
                                                class="form-check-input @error('controle.etatSante') text-danger @enderror"
                                                type="radio" name="etatSante" id="favorable" value="Favorable"
                                                wire:model="controle.etatSante">
                                            <label
                                                class="form-check-label text-primary @error('controle.etatSante') text-danger @enderror"
                                                for="favorable">Favorable</label>
                                        </div>
                                        <div class="col-12 col-md-4 col-sm-12 form-check">
                                            <input
                                                class="form-check-input @error('controle.etatSante') is-invalid @enderror"
                                                type="radio" name="etatSante" id="nonForable" value="Non favorable"
                                                wire:model="controle.etatSante">
                                            <label
                                                class="form-check-label text-primary @error('controle.etatSante') text-danger @enderror"
                                                for="nonForable">Non
                                                forable</label>
                                        </div>
                                    </div>
                                    @error('controle.etatSante')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group mt-4">
                                <h5 class="bas-souligner text-primary" style="font-size: large;">Observation</h5>
                                <textarea wire:model="controle.observation"
                                    class="form-control @error('controle.observation') is-invalid @enderror" cols="30"
                                    rows="3" tabindex="1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="dateControle" class="bas-souligner text-primary"
                                    style="font-size: large;">Date de controle</label>
                                <input type="date"
                                    class="form-control @error('controle.dateControle') is-invalid @enderror"
                                    wire:model="controle.dateControle" tabindex="2" />
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-danger"
                        wire:click='closeModal("controleModal")'>Fermer</button>
                    <button type="button" class="btn  btn-primary"
                        wire:click.prevent='addControle()'>Enregistrer</button>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal edite patient-->
    <div id="editePatientModal" class="modal fade" data-backdrop="static" data-keyboad="false" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myLargeModalLabel">Profil du patien <code>{{optional($infoPatient)->nomPrenom}}</code></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click='closeModal("editePatientModal")'><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-7">
                                    <div class="">
                                        <label class="text-primary" style="font-size: 15px;">Nom et Prenoms</label>
                                        <p style="font-size: 18px;">{{optional($infoPatient)->nomPrenom}}</p>
                                    </div>

                                    <div class="">
                                        <label class="text-primary" style="font-size: 15px;">Numéro fiche</label>
                                        <p class="mr-4" style="font-size: 18px;">{{optional($infoPatient)->numeroFiche}}</p>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-5">
                                    <div class="">
                                        <label class="text-primary" style="font-size: 15px;">Sexe</label>
                                        <p style="font-size: 18px;">{{optional($infoPatient)->sexe}}</p>
                                    </div>
                                    <div class="">
                                        <label class="text-primary" style="font-size: 15px;">Age</label>
                                        <p style="font-size: 18px;">{{optional($lastInfoConsultationPatient)->age}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-7">
                                    <div class="">
                                        <label class="text-primary" style="font-size: 15px;">Profession</label>
                                        <p style="font-size: 18px;">{{optional($lastInfoConsultationPatient)->profession}}</p>
                                    </div>

                                    <div class="">
                                        <label class="text-primary" style="font-size: 15px;">Assurer</label>
                                        <p style="font-size: 18px;">{{optional($lastInfoConsultationPatient)->assure}}</p>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-5">
                                    <div class="">
                                        <label class="text-primary" style="font-size: 15px;">Lieu d'habitation</label>
                                        <p style="font-size: 18px;">{{optional($lastInfoConsultationPatient)->residence}}</p>
                                    </div>
                                    <div class="">
                                        <label class="text-primary" style="font-size: 15px;">Contact</label>
                                        <p style="font-size: 18px;">{{optional($lastInfoConsultationPatient)->contact}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modif -->
                        <div class="col-12 col-sm-12 col-md-5 bordure card">
                            <h4 class="text-center text-primary mt-2">Modifier le profil</h4>
                            <form class="form-group text-primary">

                                <div class="row">
                                    <div class="form-group col-12 col-sm-12 col-md-6 mt-4">
                                        <label for="nomPrenomProfil col-form-label">Nom et Prenoms</label>
                                        <input class="form-control @error('updateProfil.nomPrenom') is-invalid @enderror" id="nomPrenomProfil" type="text"
                                             placeholder="Nom et Prenom" wire:model='updateProfil.nomPrenom' />
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6 mt-1">
                                        <label for="sexeProfil" class="text-primary col-form-label mt-2">Sexe</label>
                                        <select class="form-control @error('updateProfil.sexe') is-invalid @enderror" name="sexeProfil" id="sexeProfil" wire:model='updateProfil.sexe'>
                                            <option value="Masculin">Masculin</option>
                                            <option value="Feminin">Féminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-sm-12 col-md-6">
                                        <label for="age" class="">Age</label>
                                        <input class="form-control @error('updateProfil.age') is-invalid @enderror" id="age" type="number" min="0" max="150"
                                            placeholder="Age" wire:model='updateProfil.age'/>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6">
                                        <label for="numeroFicheProfil" class="">Numéro fiche</label>
                                        <input class="form-control" id="numeroFicheProfil" type="text"
                                            placeholder="Numero fiche" wire:model='updateProfil.numeroFiche'/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-sm-12 col-md-6">
                                        <label for="profession" class="">Profession</label>
                                        <select class="form-control col-12 col-sm-12 col-md-6 @error('updateProfil.profession') is-invalid @enderror"
                                            id="profession" wire:model='updateProfil.profession'>
                                            <option value="" selected=""></option>
                                            <option value="Personnel">Personnel</option>
                                            <option value="Etudiant">Etudiant</option>
                                            <option value="Autre">Autres</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6">
                                        <label for="contact" class="">Assurer</label>
                                        <div class="justify-content-center d-flex">
                                            <div class="form-check col-md-6">
                                                <input class="form-check-input" type="radio" name="assure"
                                                    id="assureroui" value="Oui"
                                                    wire:model='updateProfil.assure'>
                                                <label class="form-check-label" for="assureroui">Oui</label>
                                            </div>
                                            <div class="form-check col-md-6">
                                                <input class="form-check-input" type="radio" name="assure"
                                                    id="assurernon" value="Non" checked="true"
                                                    wire:model='updateProfil.assure'>
                                                <label class="form-check-label" for="assurernon">Non</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-sm-12 col-md-6">
                                        <label for="residence" class="">Lieu d'habitation</label>
                                        <input class="form-control" id="residence" type="text"
                                            placeholder="Lieu d'habitation" wire:model='updateProfil.residence'/>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 col-md-6">
                                        <label for="contact" class="">Contact</label>
                                        <input class="form-control" id="contact" type="text"
                                            placeholder="Contact" wire:model='updateProfil.contact'/>
                                    </div>
                                </div>
                                <br />
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-primary btn-block mr-auto"
                                         style="width: 150px;" wire:click='updatePatient()'>Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>



<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('showModal', (event) => {
           $(`#${event.message}`).modal("show")
           console.log(event.message);
       });
   });

   document.addEventListener('livewire:init', () => {
       Livewire.on('closeModal', (event) => {
           $(`#${event.message}`).modal("hide")
       });
   });
</script>