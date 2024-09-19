<div class="row">
    <div class="card container">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-9">
                    <h5 class="">Consultation de <code style="font-size: 18px">{{$newPatient['nomPrenom']}}</code></h5>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <button class="btn btn-outline-primary btn-sm" wire:click.prevent='goToListePatient()'><i class="feather icon-users"></i> Liste patient</button>
                </div>
            </div>
        </div>
        <div class="card-body table-border-style">
            <form>
                <div class=" row mt-2 px-2">
                    <div class="col-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group row">
                            <label class="text-primary col-form-label">Date de Consultation</label>
                            <input id="dateConsultation" name="dateConsultation" type="date"
                                class="form-control col-5 ml-2 @error('newPatientConsultation.dateConsultation') is-invalid @enderror" wire:model='newPatientConsultation.dateConsultation'>
                                @error('newPatientConsultation.dateConsultation')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group row fill">
                            <label for="numeroFiche" class="text-primary col-form-label">Numéro de fiche</label>
                            <input id="numeroFiche" type="text" class="form-control col-6 ml-2" name="numeroFiche"
                                placeholder="Numéro de fiche" wire:model='newPatient.numeroFiche'>
                        </div>
                    </div>
                </div>
                <hr>

                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="donneeAdministratives-tab" data-toggle="tab"
                            href="#donneeAdministratives" role="tab" aria-controls="donneeAdministratives"
                            aria-selected="true">Identificationn patient</a>
                    </li>
                    <li class="nav-item menu-a-supprimer">
                        <a class="nav-link text-uppercase" id="antecedent-tab" data-toggle="tab" href="#antecedent"
                            role="tab" aria-controls="antecedent" aria-selected="false">Information consultation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="pathlogieTraitement-tab" data-toggle="tab"
                            href="#pathlogieTraitement" role="tab" aria-controls="pathlogieTraitement"
                            aria-selected="false">Examens et hypothese diagnostique</a>
                    </li>

                    @if (getRoleServiceName()=='Cabinet dentaire')
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="traitement-tab" data-toggle="tab" href="#traitement" role="tab" aria-controls="traitement" aria-selected="false">Diagnostic et Traitement </a>
                        </li>
                    @endif
                    
                    @if (getRoleServiceName()=='Infirmerie')
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="soins-tab" data-toggle="tab"
                                href="#soins" role="tab" aria-controls="soins"
                                aria-selected="false">Soins Infirmier</a>
                        </li>
                    @endif
                    

                </ul>

                <div class="tab-content" id="myTabContent">
                    <!-- Identification -->
                    <div class="tab-pane fade show active" id="donneeAdministratives" role="tabpanel"
                        aria-labelledby="donneeAdministratives-tab">
                        <div class="card px-2">
                            <h5 class="bg-primary text-center text-light mt-2">Identification</h5>
                            <div class="mb-0 text-primary">
                                <div class="form-group row">
                                    <div class="col-12 col-sm-12 col-md-9">
                                        <div class="row">
                                            <label for="nom" class="col-12 col-sm-12 col-md-3 col-form-label">Nom et Prenoms</label>
                                            <div class="col-12 col-sm-12 col-md-9">
                                                <input type="text" class="form-control @error('newPatient.nomPrenom') is-invalid @enderror" name="nom" id="nom"
                                                    placeholder="Nom et Prenoms" wire:model='newPatient.nomPrenom'>
                                                    @error('newPatient.nomPrenom')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-3">
                                        <div class="row form-group">
                                            <div class="col-12 col-sm-12 col-md-4 mt-1">
                                                <label class="col-form-label">Assurer</label>
                                            </div>
                                            <div class="form-check col-12 col-sm-12 col-md-4 mt-3">
                                                <input class="form-check-input" type="radio" name="assure" id="assureroui"
                                                    value="Oui" wire:model='newPatientConsultation.assure'>
                                                <label class="form-check-label" for="assureroui">Oui</label>
                                            </div>
                                            <div class="form-check col-12 col-sm-12 col-md-4 mt-3">
                                                <input class="form-check-input" type="radio" name="assure" id="assurernon"
                                                    value="Non" checked="true" wire:model='newPatientConsultation.assure'>
                                                <label class="form-check-label" for="assurernon">Non</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-sm-12 col-md-3">
                                        <div class="row form-group">
                                            <div class="col-12 col-sm-12 col-md-3 mt-1">
                                                <label class="col-form-label">Sexe </label>
                                            </div>
                                            <div class="form-check col-12 col-sm-12 col-md-4 mt-3">
                                                <input class="form-check-input @error('newPatient.sexe') is-invalid @enderror" type="radio" name="sexe" id="feminin"
                                                    value="Féminin" wire:model='newPatient.sexe'>
                                                <label class="form-check-label" for="feminin">Feminin</label>
                                            </div>
                                            <div class="form-check col-12 col-sm-12 col-md-4 mt-3">
                                                <input class="form-check-input @error('newPatient.sexe') is-invalid @enderror" type="radio" name="sexe" id="masculin"
                                                    value="Masculin" wire:model='newPatient.sexe'>
                                                <label class="form-check-label" for="masculin">Masculin</label>
                                            </div>
                                            
                                            @error('newPatient.sexe')
                                            <span class="text-danger text-center row">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group row fill">
                                            <label for="age"
                                                class="text-primary col-form-label col-12 col-sm-12 col-md-2">Age </label>
                                            <input id="age" type="number" min="1" max="150"
                                                class="form-control col-12 col-sm-12 col-md-4 @error('newPatientConsultation.age') is-invalid @enderror" name="age"
                                                placeholder="Age" wire:model='newPatientConsultation.age'>
                                            <label class="text-primary col-form-label col-12 col-sm-12 col-md-4">Ans</label>
                                                @error('newPatientConsultation.age')
                                                    <span class="text-danger row text-center">{{$message}}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-5">
                                        <div class="form-group row fill">
                                            <label for="age"
                                                class="text-primary col-form-label col-12 col-sm-12 col-md-5">Lieu
                                                d'habitation </label>
                                            <input name="residenceHabituelle" id="residenceHabituelle" type="text"
                                                class="form-control col-12 col-sm-12 col-md-7 "
                                                placeholder="Lieu d'habitation" wire:model='newPatientConsultation.residence'>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-12 col-sm-12 col-md-8">
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-12 col-md-2 col-form-label">Contacts</label>
                                            <div class="col-12 col-sm-12 col-md-5">
                                                <div class="row">
                                                    <label for="tel" class="col-12 col-sm-12 col-md-3 col-form-label">Tél
                                                        :</label>
                                                    <div class="col-12 col-sm-12 col-md-8">
                                                        <input type="text" class="form-control" name="tel" id="tel"
                                                            placeholder="Tél" wire:model='newPatientConsultation.tel'>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-5">
                                                <div class="row">
                                                    <label for="cel" class="col-12 col-sm-12 col-md-3 col-form-label">Cel
                                                        :</label>
                                                    <div class="col-12 col-sm-12 col-md-8">
                                                        <input type="text" class="form-control" name="cel" id="cel"
                                                            placeholder="Cel" wire:model='newPatientConsultation.cel'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group row fill">
                                            <label for="profession"
                                                class="text-primary col-form-label col-12 col-sm-12 col-md-5">Profession
                                                :</label>
                                            <select class="form-control col-12 col-sm-12 col-md-6" name="profession"
                                                id="profession" wire:model='newPatientConsultation.profession' @error('newPatientConsultation.profession') is-invalid @enderror>
                                                <option value=" " selected=""></option>
                                                <option value="Personnel">Personnel</option>
                                                <option value="Etudiant">Etudiant</option>
                                                <option value="Autre">Autres</option>
                                            </select>
                                            @error('newPatientConsultation.profession')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- Informations consultation -->
                    <div class="tab-pane fade" id="antecedent" role="tabpanel" aria-labelledby="antecedent-tab">

                        <div class="card px-2">
                            <h5 class="bg-primary text-center text-light mt-2">Motif de consultation et Antécédents</h5>
                            <div class=" row mt-2 px-2">
                                <div class="col-12 col-md-6 col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label class="text-primary">Motif de consultation</label>
                                        <textarea class="form-control" name="motifConsultation" id="motif" cols="30"
                                            rows="1" wire:model='newPatientConsultation.motifConsultation'></textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-sm-12 mt-2">
                                    <div class="form-group">
                                        <label class="text-primary">Histoire de la maladie</label>
                                        <textarea class="form-control" name="histoireMaladie" id="histoireMaladie" cols="30"
                                            rows="1" wire:model='newPatientConsultation.histoireMaladie'></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0 mt-3">
                                <div class="row">
                                    <h5 class="col-sm-12 col-12 col-sm-12 col-md-12 bas-souligner text-primary">Antécédents
                                    </h5>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-sm-12 col-md-6">
                                        <label for="antecedentMedicaux" class="text-primary">Médicaux :</label>
                                        <textarea class="form-control" id="antecedentMedicaux" name="antecedentMedicaux"
                                            rows="2" wire:model='newPatientAntecedent.antecedentMedicaux'></textarea>
                                    </div>

                                    <div class="form-group col-12 col-sm-12 col-md-6">
                                        <label for="antecedentChirurgicaux" class="text-primary">Chirurgicaux :</label>
                                        <textarea class="form-control" id="antecedentChirurgicaux"
                                            name="antecedentChirurgicaux" rows="2" wire:model='newPatientAntecedent.antecedentChirurgicaux'></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="antecedentGynecoObsterique"
                                        class="col-sm-2 col-form-label text-primary">Gynéco-obstérique : </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="antecedentGynecoObsterique"
                                            id="antecedentGynecoObsterique" placeholder="Gynéco-obstérique" wire:model='newPatientAntecedent.antecedentGynecoObsterique'>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!--  Constantes physiques-->
                         <div class="card px-2">
                            <h5 class="bg-primary text-center text-light mt-2">Constantes physiques</h5>
                            <div class="row mt-4">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="row ml-3">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group row fill">
                                                <label for="poids" class="text-primary col-form-label">Poids :</label>
                                                <input id="poids" type="text"
                                                    class="form-control col-12 col-sm-12 col-md-6 " name="poids"
                                                    placeholder="Poids" wire:model='newPatientConsultation.poids'>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group row fill">
                                                <label for="temperature" class="text-primary col-form-label">Température
                                                    :</label>
                                                <input id="temperature" type="text"
                                                    class="form-control col-12 col-sm-12 col-md-6 ml-2 "
                                                    name="temperature" placeholder="Température" wire:model='newPatientConsultation.temperature'>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ml-3">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group row fill">
                                                <label for="tensionArterielle"
                                                    class="text-primary col-form-label">Tension Arterielle :</label>
                                                <input id="tensionArterielle" type="text"
                                                    class="form-control col-12 col-sm-12 col-md-6 ml-2 "
                                                    name="tensionArterielle" placeholder="Tension Arterielle" wire:model='newPatientConsultation.tensionArterielle'>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group row fill">
                                                <label for="pouls" class="text-primary col-form-label">Pouls :</label>
                                                <input id="pouls" type="text"
                                                    class="form-control col-12 col-sm-12 col-md-6 ml-2 " name="pouls"
                                                    placeholder="Pouls" wire:model='newPatientConsultation.pouls'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Médecine Infirmerie -->
                    @if (getRoleServiceName()=='Infirmerie' || getRoleServiceName()=='Médecine générale')
                        
                        <div class="tab-pane fade" id="pathlogieTraitement" role="tabpanel"
                            aria-labelledby="pathlogieTraitement-tab">
                            <div class="mb-0">
                                <!-- Examens physiques-->
                                <div class="card px-2">
                                    <h5 class="bg-primary text-center text-light mt-2">Examens et hypothese diagnostique</h5>
                                    <div class=" row mt-2 px-2">
                                        <div class="col-12 col-md-12 col-sm-12 ">
                                            <h5 class="bas-souligner text-primary">Examens physiques</h5>
                                            <div class="col-12 col-md-12 col-sm-12 mt-2">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="examensPhysiques" id="examensPhysiques"
                                                        cols="30" rows="1" wire:model='newPatientExamensPhysiques.autresExamensPhysiques'></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Examens Examen-->
                                    <div class=" row mt-2 px-2">
                                        <div class="col-12 col-md-12 col-sm-12 ">
                                            <h6 class="bas-souligner text-primary">Examen image/pdf</h6>
                                            <div class="row">

                                                <div class="form-group col-12 col-md-6 col-sm-12 mt-2 fill">
                                                    <label for="libelle" class="text-primary col-form-label">Libelle</label>
                                                    <input type="text" class="form-control" id="libelle" placeholder="Libelle" wire:model='newPatientTypeExamenPhysiqueImageLibelle'>
                                                </div>

                                                <div class="form-group col-12 col-md-5 col-sm-12 mt-2 fill d-flex justify-content-between">
                                                    <div class="">
                                                        <label for="imageExamenPhysique" class="text-primary col-form-label">Image</label>
                                                        <input type="file" class="form-control col-12 col-md-12 col-sm-12 @error('newPatientTypeExamenPhysiqueImage') is-invalid @enderror" 
                                                                id="newPatientTypeExamenPhysiqueImage" placeholder="Image" wire:model='newPatientTypeExamenPhysiqueImage' accept="application/pdf,image/*">
                                                        @error('newPatientTypeExamenPhysiqueImage')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                        
                                                </div>
                                                
                                                </div>

                                            </div>
                                            

                                        </div>

                                    </div>

                                    <!-- hypothese diagnostique-->

                                    <div class=" row mt-2 px-2">
                                        <div class="col-12 col-md-12 col-sm-12 ">
                                            <h5 class="bas-souligner text-primary">Hypothese diagnostic</h5>
                                            <div class="col-12 col-md-12 col-sm-12 mt-2">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="hypotheseDiagnostic"
                                                        id="hypotheseDiagnostic" cols="30" rows="1" wire:model='newPatientConsultation.hypotheseDiagnostic'></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <!-- Examens complementaires-->
                            
                                <div class="card px-2">

                                    <h5 class="bg-primary text-center text-light mt-2">Examens complementaires</h5>
                                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active text-uppercase" id="biologiques-tab" data-toggle="tab"
                                                href="#biologiques" role="tab" aria-controls="biologiques"
                                                aria-selected="true">biologiques
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-uppercase" id="odonto-tab" data-toggle="tab"
                                                href="#odonto" role="tab" aria-controls="odonto"
                                                aria-selected="false">odonto</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-uppercase" id="ophtalmologie-tab" data-toggle="tab"
                                                href="#ophtalmologie" role="tab" aria-controls="ophtalmologie"
                                                aria-selected="false">Examen
                                                ophtalmologie</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-uppercase" id="radiologie-tab" data-toggle="tab"
                                                href="#radiologie" role="tab" aria-controls="radiologie"
                                                aria-selected="false">Examen radiologie</a>
                                        </li>
                                    </ul>


                                    <div class="tab-content" id="myTabContent">

                                        <!-- Examens biologiques-->
                                        <div class="tab-pane fade show active" id="biologiques" role="tabpanel"
                                            aria-labelledby="biologiques-tab">
                                            <div class="row mt-2">
                                                <div class="col-12 col-sm-12 col-md-12">

                                                    <div class="row mt-2">
                                                        <div class="col-12 col-sm-12 col-md-3">
                                                            <div class="form-group">
                                                                <label class="text-primary mb-0"
                                                                    for="nfs">NFS(Sang)</label>
                                                                <input type="text" name="nfs" class="form-control" id="nfs" wire:model='newPatientExamenBiologiques.nfs'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-3">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="goutteEpaisse">Goutte
                                                                    épaisse</label>
                                                                <input type="text" name="goutteEpaisse" class="form-control"
                                                                    id="goutteEpaisse" wire:model='newPatientExamenBiologiques.goutteEpaisse'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-3">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="crp">CRP</label>
                                                                <input type="text" name="crp" class="form-control"
                                                                    id="crp" wire:model='newPatientExamenBiologiques.crp'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-3">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="widal">WIDAL</label>
                                                                <input type="text" name="widal" class="form-control"
                                                                    id="widal" wire:model='newPatientExamenBiologiques.widal'>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-12 col-sm-12 col-md-3">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="creatine">Créatine</label>
                                                                <input type="text" name="creatine" class="form-control"
                                                                    id="creatine" wire:model='newPatientExamenBiologiques.creatine'>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-12 col-md-3">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="uree">Urée</label>
                                                                <input type="text" name="uree" class="form-control"
                                                                    id="uree" wire:model='newPatientExamenBiologiques.uree'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-3">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="glycemie">Glycémie</label>
                                                                <input type="text" name="glycemie" class="form-control"
                                                                    id="glycemie" wire:model='newPatientExamenBiologiques.glycemie'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-3">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="transa">Transa</label>
                                                                <input type="text" name="transa" class="form-control"
                                                                    id="transa" wire:model='newPatientExamenBiologiques.transa'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-12 col-sm-12 col-md-5">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="ecdu">ECDU</label>
                                                                <input type="text" name="ecdu" class="form-control"
                                                                    id="ecdu" wire:model='newPatientExamenBiologiques.ecdu'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-7">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary mr-5"
                                                                    for="autreExamenBiologie">Autre examen</label>
                                                                <input type="text" name="autreExamenBiologie"
                                                                    class="form-control" id="autreExamenBiologie" wire:model='newPatientExamenBiologiques.autreExamenBiologie'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <!-- Examens  odonto-->
                                        <div class="tab-pane fade" id="odonto" role="tabpanel" aria-labelledby="odonto-tab">

                                            <div class="row mt-2">
                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <div class="row mt-2">
                                                        <div class="col-12 col-sm-12 col-md-4">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="retroAlveolaire">Rétro-alvéolaire</label>
                                                                <input type="text" name="retroAlveolaire"
                                                                    class="form-control" id="retroAlveolaire" wire:model='newPatientExamenOdonto.retroAlveolaire'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-4">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="panneauDentaire">Panneau
                                                                    dentaire</label>
                                                                <input type="text" name="panneauDentaire"
                                                                    class="form-control" id="panneauDentaire" wire:model='newPatientExamenOdonto.panneauDentaire'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-4">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary mr-5"
                                                                    for="autreExamendentaires">Autre examen</label>
                                                                <input type="text" name="autreExamendentaires"
                                                                    class="form-control" id="autreExamendentaires" wire:model='newPatientExamenOdonto.autreExamendentaires'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Examens ophtalmologie-->
                                        <div class="tab-pane fade" id="ophtalmologie" role="tabpanel"
                                            aria-labelledby="ophtalmologie-tab">

                                            <div class="mt-2">
                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <div class="row mt-2">
                                                        <div class="col-12 col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="radieOeil">Radio
                                                                    d'oeil</label>
                                                                <input type="text" name="radieOeil" class="form-control"
                                                                    id="radieOeil" wire:model='newPatientExamenOphtalmologie.radieOeil'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="champVisuel">Champ
                                                                    visuel</label>
                                                                <input type="text" name="champVisuel" class="form-control"
                                                                    id="champVisuel" wire:model='newPatientExamenCOphtalmologie.champVisuel'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-12 col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="fondOeil">Fond
                                                                    d'oeil</label>
                                                                <input type="text" name="fondOeil" class="form-control"
                                                                    id="fondOeil" wire:model='newPatientExamenOphtalmologie.fondOeil'>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary" for="autreExamenOphtalmologie">Autre
                                                                    examen</label>
                                                                <input type="text" name="autreExamenOphtalmologie"
                                                                    class="form-control" id="autreExamenOphtalmologie" wire:model='newPatientExamenOphtalmologie.autreExamenOphtalmologie'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </div>


                                        <!-- Examens radiologie-->
                                        <div class="tab-pane fade" id="radiologie" role="tabpanel"
                                            aria-labelledby="radiologie-tab">

                                            <div class="row mt-2">
                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <div class="row mt-2">
                                                        <div class="col-12 col-sm-12 col-md-4">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="pulmonaire">Pulmonaire</label>
                                                                <input type="text" name="pulmonaire" class="form-control"
                                                                    id="pulmonaire" wire:model='newPatientExamenRadiologie.pulmonaire'>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-12 col-md-4">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="scanner">Scanner</label>
                                                                <input type="text" name="scanner" class="form-control"
                                                                    id="scanner" wire:model='newPatientExamenRadiologie.scanner'>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-12 col-md-4">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary"
                                                                    for="irl">IRL</label>
                                                                <input type="text" name="irl" class="form-control" id="irl" wire:model='newPatientExamenRadiologie.irl'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-12 col-sm-12 col-md-4">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary mr-5"
                                                                    for="asp">ASP</label>
                                                                <input type="text" name="asp" class="form-control" id="asp" wire:model='newPatientExamenRadiologie.asp'>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-8">
                                                            <div class="row">
                                                                <label
                                                                    class="text-primary col-12 col-sm-12 col-md-2 mt-3">Echo:</label>
                                                                <div class="col-12 col-sm-12 col-md-5">
                                                                    <div class="form-group">
                                                                        <label class="mb-0 text-primary"
                                                                            for="abdominale">Abdominale</label>
                                                                        <input type="text" name="abdominale"
                                                                            class="form-control" id="abdominale" wire:model='newPatientExamenRadiologie.abdominale'>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-5">
                                                                    <div class="form-group">
                                                                        <label class="mb-0 text-primary"
                                                                            for="pelvienne">Pelvienne</label>
                                                                        <input type="text" name="pelvienne"
                                                                            class="form-control" id="pelvienne" wire:model='newPatientExamenRadiologie.pelvienne'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-12 col-sm-12 col-md-8">
                                                            <div class="form-group">
                                                                <label class="mb-0 text-primary mr-5"
                                                                    for="autreExamenRadio">Autre examen</label>
                                                                <input type="text" name="autreExamenRadio"
                                                                    class="form-control" id="autreExamenBiologie" wire:model='newPatientExamenRadiologie.autreExamenRadio'>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>

                                    <!-- Examens image-->
                                    <div class=" row mt-2 px-2">
                                        <div class="col-12 col-md-12 col-sm-12 ">
                                            <h6 class="bas-souligner text-primary">Examen image/Pdf</h6>
                                            <div class="row">

                                                <div class="col-12 col-md-3 col-sm-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="typeExamenComplementaire" class="text-primary col-form-label">Type examen complementaire</label>
                                                        <select id="typeExamenComplementaire" class="form-control" wire:model='newPatientTypeExamenComplementaireImage.examen'>
                                                            <option value="" class="form-control"></option>
                                                            <option value="Biologique" class="form-controle">Examens biologiques</option>
                                                            <option value="Odonto" class="form-controle">Examens odontos</option>
                                                            <option value="Ophtalmologie" class="form-controle">Examens ophtalmologies</option>
                                                            <option value="Radio" class="form-controle">Examens radiologies</option>
                                                        </select>
                                                        @if ($choixExamenComplementaie == false)
                                                        <span class="text-danger">Selectionner le type</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group col-12 col-md-4 col-sm-12 mt-2 fill">
                                                    <label for="libelle" class="text-primary col-form-label">Libelle</label>
                                                    <input type="text" class="form-control" id="libelle" placeholder="Libelle" wire:model='newPatientTypeExamenComplementaireImage.libelle'>
                                                </div>


                                                <div class="form-group col-12 col-md-5 col-sm-12 mt-2 fill d-flex justify-content-between">
                                                    <div class="">
                                                        <label for="typeExamenComplementaireImage" class="text-primary col-form-label">Image/Pdf</label>
                                                        <input type="file" class="form-control col-12 col-md-10 col-sm-12 @error('typeExamenComplementaireImage') is-invalid @enderror" 
                                                                id="typeExamenComplementaireImage" placeholder="Image" wire:model='typeExamenComplementaireImage' accept="application/pdf,image/*">
                                                        @error('typeExamenComplementaireImage')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                        
                                                </div>
                                                
                                                
                                                
                                                </div>

                                            </div>
                                            

                                        </div>

                                    </div>
                                    

                                </div>


                                <!-- Pathologies -->
                                <div class="card mt-3 px-2">
                                    <h5 class="bg-primary text-center text-light mt-2">Pathologies diagnostiquées</h5>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="paludisme" class="custom-control-input"
                                                    id="paludisme" value="Paludisme" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="paludisme">Paludisme</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="gastroenterite" class="custom-control-input"
                                                    id="gastroenterite" value="Gastro-entérite" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="gastroenterite">Gastro-entérite</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="pneumonie" class="custom-control-input"
                                                    id="pneumonie" value="Pneumonie" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="pneumonie">Pneumonie</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="conjectivite" class="custom-control-input"
                                                    id="conjectivite" value="Conjectivite" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="conjectivite">Conjectivite</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="fievreTyphoide" class="custom-control-input"
                                                    id="fievreTyphoide" value="Fièvre typhoide" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary" for="fievreTyphoide">Fièvre
                                                    typhoide</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="dermatose" class="custom-control-input"
                                                    id="dermatose" value="Dermatose" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="dermatose">Dermatose</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="ist" class="custom-control-input" id="ist"
                                                    value="IST" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary" for="ist">IST</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="anemie" class="custom-control-input"
                                                    id="anemie" value="Anémie" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary" for="anemie">Anémie</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="asthme" class="custom-control-input"
                                                    id="asthme" value="Asthme" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary" for="asthme">Asthme</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="hta" class="custom-control-input" id="hta"
                                                    value="HTA" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary" for="hta">HTA</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="traumatismeVoiePublique"
                                                    class="custom-control-input" id="traumatismeVoiePublique"
                                                    value="Traumatisme voie publique" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="traumatismeVoiePublique">Traumatisme voie publique</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="diabete" class="custom-control-input"
                                                    id="diabete" value="Diabète" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="diabete">Diabète</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="troublesPsychiatriques"
                                                    class="custom-control-input" id="troublesPsychiatriques"
                                                    value="Troubles psychiatriques" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="troublesPsychiatriques">Troubles psychiatriques</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="facteursRisqueCardiovasculaire"
                                                    class="custom-control-input" id="facteursRisqueCardiovasculaire"
                                                    value="Facteurs de risque cardiovasculaire" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="facteursRisqueCardiovasculaire">Facteurs risque
                                                    cardiovasculaire</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="autresTraumatismes"
                                                    class="custom-control-input" id="autresTraumatismes"
                                                    value="Autres traumatismes" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="autresTraumatismes">Autres traumatismes</label>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="autresMaladiesNonInfectieuses"
                                                    class="custom-control-input" id="autresMaladiesNonInfectieuses"
                                                    value="Autres maladies non infectieuses" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="autresMaladiesNonInfectieuses">Autres maladies non
                                                    infectieuses</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="maladiesIndeterminees"
                                                    class="custom-control-input" id="maladiesIndeterminees"
                                                    value="Maladies indeterminées" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="maladiesIndeterminees">Maladies indeterminées</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="rougeole"
                                                    class="custom-control-input" id="rougeole"
                                                    value="Rougeole" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="rougeole">Rougeole</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="bronchiolite"
                                                    class="custom-control-input" id="bronchiolite"
                                                    value="Bronchiolite" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="bronchiolite">Bronchiolite</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="bronchioliteAigue"
                                                    class="custom-control-input" id="bronchioliteAigue"
                                                    value="Bronchiolite aiguë" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="bronchioliteAigue">Bronchiolite aiguë</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="varicelle"
                                                    class="custom-control-input" id="varicelle"
                                                    value="Varicelle" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="varicelle">Varicelle</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="rhinopharyngite"
                                                    class="custom-control-input" id="rhinopharyngite"
                                                    value="Rhinopharyngite" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="rhinopharyngite">Rhinopharyngite</label>
                                            </div>
                                            <div class="custom-control custom-checkbox col-12 col-md-4 col-sm-12">
                                                <input type="checkbox" name="laryngiteAigue"
                                                    class="custom-control-input" id="laryngiteAigue"
                                                    value="Laryngite aiguë" wire:model='newPatientPathologies'>
                                                <label class="custom-control-label text-primary"
                                                    for="laryngiteAigue">Laryngite aiguë</label>
                                            </div>
                                        </div>
                                    

                                        <div class="form-group row mt-3">
                                            <label class="mb-0 text-primary mr-5" for="autrePathologie">Autre
                                                Pathologie</label>
                                            <input type="text" name="autrePathologie"
                                                class="form-control col-12 col-md-12 col-lg-12 col-xl-7 col-sm-12"
                                                id="autrePathologie" wire:model='autrePathologie'>
                                        </div>
                                    </div>

                                    <br><br>

                                </div>

                                <!-- Traitement -->
                                <div class="card mt-2 px-2">

                                    <h5 class="bg-primary text-center text-light mt-2">Traitement</h5>
                                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-sm-12">
                                                <div class="row">
                                                    <div class="col-6 col-lg-6 col-md-12 col-sm-12">
                                                        <label class="text-primary">Mise en observation</label>
                                                        <div class="row px-1">
                                                            <div class="col-6 form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="hospitalise" id="hospitalise1" value="Oui" wire:model='newPatientConsultation.miseObservation'>
                                                                <label class="form-check-label text-primary"
                                                                    for="hospitalise1">Oui</label>
                                                            </div>
                                                            <div class="col-2 form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="hospitalise" id="hospitalise2" value="Non"
                                                                    checked="" wire:model='newPatientConsultation.miseObservation'>
                                                                <label class="form-check-label text-primary"
                                                                    for="hospitalise2">Non</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-lg-6 col-md-12 col-sm-12">
                                                        <label class="text-primary">Référé</label>
                                                        <div class="row px-1">
                                                            <div class="col-6 form-check form-group">
                                                                <input class="form-check-input" type="radio" name="refere"
                                                                    id="refere1" value="Oui" wire:model='newPatientConsultation.refere'>
                                                                <label class="form-check-label text-primary"
                                                                    for="refere1">Oui</label>
                                                            </div>
                                                            <div class="col-2 form-check">
                                                                <input class="form-check-input" type="radio" name="refere"
                                                                    id="refere2" value="Non" checked="" wire:model='newPatientConsultation.refere'>
                                                                <label class="form-check-label text-primary"
                                                                    for="refere2">Non</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-8 col-sm-12 mb-5">
                                                <div class="row mt-2 px-3">
                                                    <label for="prescription" class="text-primary">Prescription</label>
                                                    <textarea name="prescription" id="prescription" cols="10" rows=""
                                                        class="form-control" wire:model='newPatientConsultation.traitement'></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Cabinet dentaire -->
                    @if (getRoleServiceName()=='Cabinet dentaire')
                        <div class="tab-pane fade" id="pathlogieTraitement" role="tabpanel"
                            aria-labelledby="pathlogieTraitement-tab">
                            <div class="card px-2">
                                <h5 class="bg-primary text-center text-light mt-2">Examens physiques</h5>
                                <div class="row">
                                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <div class="form-group ml-4">
                                                    <label class="text-primary">Examen exobuccal</label>
                                                    <input type="text" class="form-control" wire:model='newPatientExamensPhysiques.examenExobuccal' id="examenExobuccal">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ml-2">
                                            <div class="col-12 col-md-12 col-sm-12">
                                                <label class="text-primary">Examen endobuccal</label>
                                                <div class="row ml-3">
                                                        <label class="custom-control-label text-primary col-12 col-md-1 col-sm-12 mt-3">CAO</label>
                                                        <div class="form-group col-12 col-md-3 col-sm-12">
                                                            <div class="row form-group fill">
                                                                <label for="examenEndobuccalC" class="text-primary col-form-label">C :</label>
                                                                <input id="examenEndobuccalC" type="text" class="form-control col-10 ml-2" wire:model='newPatientExamensPhysiques.examenEndobuccalC'>
                                                            </div>
                                                        
                                                        </div>
                                                        <div class="form-group col-12 col-md-3 col-sm-12">
                                                            <div class="row form-group fill">
                                                                <label for="examenEndobuccalA" class="text-primary col-form-label">A :</label>
                                                                <input id="examenEndobuccalA" type="text" class="form-control col-10 ml-2 " wire:model='newPatientExamensPhysiques.examenEndobuccalA'>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-md-3 col-sm-12">
                                                            <div class="row form-group fill">
                                                                <label for="examenEndobuccalO" class="text-primary col-form-label">O :</label>
                                                                <input id="examenEndobuccalO" type="text" class="form-control col-10 ml-2 " wire:model='newPatientExamensPhysiques.examenEndobuccalO'>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <div class="form-group row ml-3 mt-3 fill">
                                                    <label for="hbd" class="text-primary col-form-label">HBD:</label>
                                                    <input type="text" class="form-control col-8 col-lg-8 col-md-6 col-sm-6 ml-2" wire:model='newPatientExamensPhysiques.hbd' id="hbd" placeholder="HBD">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <div class="form-group row ml-1 mt-3 fill">
                                                    <label for="autresExamen" class="text-primary col-form-label">Autres examen:</label>
                                                    <input type="text" class="form-control col-8 col-lg-8 col-md-6 col-sm-6 ml-2 " wire:model='newPatientExamensPhysiques.autresExamensPhysiques' id="autresExamen" placeholder="Autres examen">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <!-- Examen image/pdf -->
                             <div class=" row mt-2 px-2">
                                <div class="col-12 col-md-12 col-sm-12 ">
                                    <h6 class="bas-souligner text-primary">Examen image/pdf</h6>
                                    <div class="row">

                                        <div class="form-group col-12 col-md-6 col-sm-12 mt-2 fill">
                                            <label for="libelle" class="text-primary col-form-label">Libelle</label>
                                            <input type="text" class="form-control" id="libelle" placeholder="Libelle" wire:model='newPatientTypeExamenPhysiqueImageLibelle'>
                                        </div>

                                        <div class="form-group col-12 col-md-5 col-sm-12 mt-2 fill d-flex justify-content-between">
                                            <div class="">
                                                <label for="imageExamenPhysique" class="text-primary col-form-label">Image</label>
                                                <input type="file" class="form-control col-12 col-md-12 col-sm-12 @error('newPatientTypeExamenPhysiqueImage') is-invalid @enderror" 
                                                        id="newPatientTypeExamenPhysiqueImage" placeholder="Image" wire:model='newPatientTypeExamenPhysiqueImage' accept="application/pdf,image/*">
                                                @error('newPatientTypeExamenPhysiqueImage')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                                
                                           </div>
                                           
                                        </div>

                                    </div>
                                    

                                </div>

                            </div>
                            </div>

                            <div class="card px-2">
                                <h5 class="bg-primary text-center text-light mt-2">Hypothese diagnostique et Examens complementaires</h5>
                    
                                <!-- hypothese diagnostique-->
                                <div class=" row mt-2 px-2">
                                    <div class="col-12 col-md-12 col-sm-12 ">
                                        <h5 class="bas-souligner text-primary">Hypothese diagnostic</h5>
                                        <div class="col-12 col-md-12 col-sm-12 mt-2">
                                            <div class="form-group">
                                                <textarea class="form-control"
                                                    id="hypotheseDiagnostic" cols="30" rows="1" wire:model='newPatientConsultation.hypotheseDiagnostic'></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Examens complementaires-->
                                <div class=" row mt-2 px-2">
                                    <div class="col-12 col-md-12 col-sm-12 ">
                                        <h5 class="bas-souligner text-primary">Examens complementaires</h5>
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <div class="form-group row ml-3 mt-3 fill">
                                                    <label for="radio" class="text-primary col-form-label">Radio:</label>
                                                    <input type="text" class="form-control col-8 col-lg-8 col-md-6 col-sm-6 ml-2 " wire:model='newPatientExamenOdonto.radioDentaire' id="radio" placeholder="Radio">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-sm-12">
                                                <div class="form-group row ml-1 mt-3 fill">
                                                    <label for="autresExamenComplementaire" class="text-primary col-form-label">Autres examen:</label>
                                                    <input type="text" class="form-control col-8 col-lg-8 col-md-6 col-sm-6 ml-2 " wire:model='newPatientExamenOdonto.autreExamendentaires' id="autresExamenComplementaire" placeholder="Autres examen">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Examens image-->
                                <!-- Examens  image-->
                            <div class=" row mt-2 px-2">
                                <div class="col-12 col-md-12 col-sm-12 ">
                                    <h6 class="bas-souligner text-primary">Examen image/Pdf</h6>
                                    <div class="row">

                                        <div class="col-12 col-md-3 col-sm-12 mt-2">
                                            <div class="form-group">
                                                <label for="typeExamenComplementaire" class="text-primary col-form-label">Type examen complementaire</label>
                                                <select id="typeExamenComplementaire" class="form-control" wire:model='newPatientTypeExamenComplementaireImage.examen'>
                                                    <option value="" class="form-control"></option>
                                                    <option value="Biologique" class="form-controle">Examens biologiques</option>
                                                    <option value="Odonto" class="form-controle">Examens odontos</option>
                                                    <option value="Ophtalmologie" class="form-controle">Examens ophtalmologies</option>
                                                    <option value="Radio" class="form-controle">Examens radiologies</option>
                                                </select>
                                                @if ($choixExamenComplementaie == false)
                                                <span class="text-danger">Selectionner le type</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group col-12 col-md-4 col-sm-12 mt-2 fill">
                                            <label for="libelle" class="text-primary col-form-label">Libelle</label>
                                            <input type="text" class="form-control" id="libelle" placeholder="Libelle" wire:model='newPatientTypeExamenComplementaireImage.libelle'>
                                        </div>


                                        <div class="form-group col-12 col-md-5 col-sm-12 mt-2 fill d-flex justify-content-between">
                                            <div class="">
                                                <label for="typeExamenComplementaireImage" class="text-primary col-form-label">Image/Pdf</label>
                                                <input type="file" class="form-control col-12 col-md-10 col-sm-12 @error('typeExamenComplementaireImage') is-invalid @enderror" 
                                                        id="typeExamenComplementaireImage" placeholder="Image" wire:model='typeExamenComplementaireImage' accept="application/pdf,image/*">
                                                @error('typeExamenComplementaireImage')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                                
                                           </div>
                                          
                                           
                                           
                                        </div>

                                    </div>
                                    

                                </div>

                            </div>

                            </div>

                        </div>

                        <div class="tab-pane fade" id="traitement" role="tabpanel" aria-labelledby="traitement-tab">
                            <div class="mb-0">
                                <div class="card px-2">
                                    <h5 class="bg-primary text-center text-light mt-2">Diagnostic</h5>
                                    <div class="ml-1 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group ml-3">
                                                    <label class="text-primary">Affection carieuse</label>
                                                    <input type="text" class="form-control col-12 col-sm-12 col-md-12" wire:model='newPatientPathologies.affectionCarieuse' id="affectionCarieuse">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group ml-3">
                                                    <label class="text-primary">Maladie paradontale</label>
                                                    <input type="text" class="form-control col-12 col-sm-12 col-md-12" wire:model='newPatientPathologies.maladieParadontale' id="maladieParadontale">
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="form-group row ml-3">
                                            <label for="autresDiagnostic" class="text-primary mt-3">Autres :</label>
                                            <input type="text" class="form-control col-12 col-sm-12 col-md-8 ml-2" wire:model='newPatientPathologies.autresDiagnostic' id="autresDiagnostic">
                                        </div><br>
                                    </div>
                                </div>

                                <div class="card px-2">
                                    <h5 class="bg-primary text-center text-light mt-2">Traitement</h5>
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-5 ml-5">
                                            <div class="custom-control custom-checkbox row">
                                                <input type="checkbox" class="custom-control-input" name="traitementDetartrage" id="traitementDetartrage" value="Détartrage" wire:model='newPatientTraitementDentaireChecks'>
                                                <label class="custom-control-label text-primary" for="traitementDetartrage">Détartrage</label>
                                            </div>
                                            <div class="form-group row mt-4">
                                                <label for="traitementExtraction" class=" text-primary">Extraction</label>
                                                <input type="text" class="form-control" wire:model='newPatientTraitementDentaire.extraction' id="traitementExtraction">
                                            </div>

                                            <div class="form-group row">
                                                <label for="oce" class="text-primary">OCE</label>
                                                <input type="text" class="form-control col-12 col-sm-12 col-md-12" wire:model='newPatientTraitementDentaire.oce' id="oce">
                                            </div>
                                            <div class="form-group row">
                                                <label for="traitementsParadontales" class="text-primary">Traitements paradontales</label>
                                                <input type="text" class="form-control col-12 col-sm-12 col-md-12" wire:model='newPatientTraitementDentaire.paradontales' id="traitementsParadontales">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-5 ml-5">
                                            <div class="custom-control custom-checkbox row">
                                                <input type="checkbox" name="traitementSurfacageRadiculaire" class="custom-control-input" id="traitementSurfacageRadiculaire" value="Surfaçage radiculaire" wire:model='newPatientTraitementDentaireChecks'>
                                                <label class="custom-control-label text-primary" for="traitementSurfacageRadiculaire">Surfaçage radiculaire</label>
                                            </div>
                                            <div class="form-group row mt-4">
                                                <label for="traitementRehabilitationProthetique" class="text-primary">Réhabilitation prothétique</label>
                                                <input type="text" class="form-control" wire:model='newPatientTraitementDentaire.prothetique' id="traitementRehabilitationProthetique">
                                            </div>

                                            <div class="form-group row">
                                                <label class="text-primary">Autres</label>
                                                <input type="text" class="form-control col-12 col-sm-12 col-md-12" wire:model='newPatientTraitementDentaire.traitementsAutres' id="traitementsAutres">
                                            </div>
                                            <div class="form-group row">
                                                <label for="prescriptionMedicamenteuse" class="text-primary">Prescription</label>
                                                <input type="text" class="form-control col-12 col-sm-12 col-md-12" wire:model='newPatientConsultation.traitement' id="prescriptionMedicamenteuse">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif

                    <!-- Soins infirmier -->
                    @if (getRoleServiceName()=='Infirmerie')
                        <div class="tab-pane fade" id="soins" role="tabpanel" aria-labelledby="soins-tab">
                            <div class="mb-0">
                                <div class="card px-2">
                                    <div class="col-12">
                                        <h5 class="bg-primary text-center text-light mt-2">Soins réalisées</h5>
                                        <div class="row px-5 mt-3">
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="custom-control custom-checkbox col-12 col-lg-12 col-md-12 col-sm-12">
                                                        <input type="checkbox" name="pansement" class="custom-control-input" id="pansement" value="Pansement" wire:model='newPatientSoins'>
                                                        <label class="custom-control-label text-primary" for="pansement">Pansement</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="custom-control custom-checkbox col-12 col-lg-12 col-md-12 col-sm-12">
                                                        <input type="checkbox" name="persufion" class="custom-control-input" id="persufion" value="Persufion" wire:model='newPatientSoins'>
                                                        <label class="custom-control-label text-primary" for="persufion">Persufion</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="row">
                                                    <div class="custom-control custom-checkbox col-12 col-lg-12 col-md-12 col-sm-12">
                                                        <input type="checkbox" name="injection" class="custom-control-input" id="injection" value="Injection" wire:model='newPatientSoins'>
                                                        <label class="custom-control-label text-primary" for="injection">Injection</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row ml-5 mt-2">
                                            <label for="autresSoins" class="text-primary col-form-label">Autres soins :</label>
                                            <input id="autresSoins" type="text" class="form-control col-7 col-lg-7 col-md-12 col-sm-12 ml-2 " name="autresSoins" placeholder="Autres soins" wire:model='newPatientAutresSoins'/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </form>
            <div class="modal-footer mb-3">
                <button class="btn  btn-primary mt-3"
                    id="createNewPatientConsultationBtn" wire:click='addSuiteConsultation()'>Enregistrer</button>
            </div>
        </div>
    </div>
</div>