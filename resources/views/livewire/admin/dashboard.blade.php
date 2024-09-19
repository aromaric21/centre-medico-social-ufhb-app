<di>
    <!-- [ breadcrumb ] start -->
    <div class="page-header bg-primary" style="margin-top:-118px">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title row">
                        <h5 class="m-b-10 col-12 col-sm-12 col-md-7">Tableau de bord
                        </h5>
                        <h5 class="m-b-10 col-12 col-sm-12 col-md-5">Nombre de
                            patients enregistrés <span class="ml-2"> {{$patient->nbrePatientByService('tout')}} patients</span></h5>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top:-28px">
        <!-- support-section start -->

        <div class="col-sm-6 col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-yellow"><span>{{$consultation->nbreConsultationByService("tout")}}</span></h4>
                            <h6 class="text-muted m-b-0">Consultations</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-bar-chart-2 f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-yellow">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">Enregistrées</p>
                        </div>
                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-green"><span>{{$controle->nbreControleByService("tout")}}</span>
                            </h4>
                            <h6 class="text-muted m-b-0">Controles</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-bar-chart-2 f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-green">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">Enregistrés</p>
                        </div>
                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="text-c-blue"><span>{{$soins->nbreSoins()}}</span></h4>
                            <h6 class="text-muted m-b-0">Soins</h6>
                        </div>
                        <div class="col-4 text-right">
                            <i class="feather icon-bar-chart-2 f-28"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-c-blue">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <p class="text-white m-b-0">Enregistrés</p>
                        </div>
                        <div class="col-3 text-right">
                            <i class="feather icon-trending-up text-white f-16"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- support-section end -->
    </div>

    <!-- bilan par service -->
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                    <h4 class="m-0"></h4>
                    <span class="text-c-blue">Médécine générale</span>
                    <br><br>
                    <h5>Activités</h5>
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-green"><span>{{$consultation->nbreConsultationByService("Médecine générale")}}</span></h4>
                                            <h6 class="text-muted m-b-0">Consultations</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-bar-chart-2 f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-green">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">
                                                <span id="nbrePourcentageConsultMedecine"></span>
                                                %
                                            </p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="feather icon-thumbs-up text-white f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-red"><span>{{$controle->nbreControleByService("Médecine générale")}}</span></h4>
                                            <h6 class="text-muted m-b-0">Controles</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-bar-chart-2 f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-red">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">
                                                <span id="nbrePourcentageControleMedecine"></span>
                                                %
                                            </p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="feather icon-thumbs-down text-white f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary text-white">
                    <h5 class="text-white">Nombre de patients enregistrés</h5>
                    <div class="row">
                        <div class="col">
                            <h4 class="m-0 text-white" id="inscriptionScolariteSolde"></h4>
                            <h5 class="text-white"><span>{{$patient->nbrePatientByService("Médecine générale")}}</span> patients</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                    <h4 class="m-0"></h4>
                    <span class="text-c-blue">Pédiatrie</span>
                    <br><br>
                    <h5>Activités</h5>
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-green"><span>{{$consultation->nbreConsultationByService("Pédiatrie")}}</span></h4>
                                            <h6 class="text-muted m-b-0">Consultations</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-bar-chart-2 f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-green">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">
                                                <span id="nbrePourcentageConsultMedecine"></span>
                                                %
                                            </p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="feather icon-thumbs-up text-white f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-red"><span>{{$controle->nbreControleByService("Pédiatrie")}}</span></h4>
                                            <h6 class="text-muted m-b-0">Controles</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-bar-chart-2 f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-red">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">
                                                <span id="nbrePourcentageControleMedecine"></span>
                                                %
                                            </p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="feather icon-thumbs-down text-white f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary text-white">
                    <h5 class="text-white">Nombre de patients enregistrés</h5>
                    <div class="row">
                        <div class="col">
                            <h4 class="m-0 text-white" id="inscriptionScolariteSolde"></h4>
                            <h5 class="text-white"><span>{{$patient->nbrePatientByService("Pédiatrie")}}</span> patients</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                    <h4 class="m-0"></h4>
                    <span class="text-c-blue">Cabinet dentaire</span>
                    <br><br>
                    <h5>Activités</h5>
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-green"><span>{{$consultation->nbreConsultationByService("Cabinet dentaire")}}</span></h4>
                                            <h6 class="text-muted m-b-0">Consultations</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-bar-chart-2 f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-green">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">
                                                <span id="nbrePourcentageConsultMedecine"></span>
                                                %
                                            </p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="feather icon-thumbs-up text-white f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-red"><span>{{$controle->nbreControleByService("Cabinet dentaire")}}</span></h4>
                                            <h6 class="text-muted m-b-0">Controles</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-bar-chart-2 f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-red">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">
                                                <span id="nbrePourcentageControleMedecine"></span>
                                                %
                                            </p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="feather icon-thumbs-down text-white f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary text-white">
                    <h5 class="text-white">Nombre de patients enregistrés</h5>
                    <div class="row">
                        <div class="col">
                            <h4 class="m-0 text-white" id="inscriptionScolariteSolde"></h4>
                            <h5 class="text-white"><span>{{$patient->nbrePatientByService("Cabinet dentaire")}}</span> patients</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                    <h4 class="m-0"></h4>
                    <span class="text-c-blue">Ophtalmologie</span>
                    <br><br>
                    <h5>Activités</h5>
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-green"><span>{{$consultation->nbreConsultationByService("Ophtalmologie")}}</span></h4>
                                            <h6 class="text-muted m-b-0">Consultations</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-bar-chart-2 f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-green">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">
                                                <span id="nbrePourcentageConsultMedecine"></span>
                                                %
                                            </p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="feather icon-thumbs-up text-white f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-red"><span>{{$controle->nbreControleByService("Ophtalmologie")}}</span></h4>
                                            <h6 class="text-muted m-b-0">Controles</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <i class="feather icon-bar-chart-2 f-28"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-red">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <p class="text-white m-b-0">
                                                <span id="nbrePourcentageControleMedecine"></span>
                                                %
                                            </p>
                                        </div>
                                        <div class="col-3 text-right">
                                            <i class="feather icon-thumbs-down text-white f-28"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary text-white">
                    <h5 class="text-white">Nombre de patients enregistrés</h5>
                    <div class="row">
                        <div class="col">
                            <h4 class="m-0 text-white" id="inscriptionScolariteSolde"></h4>
                            <h5 class="text-white"><span>{{$patient->nbrePatientByService("Ophtalmologie")}}</span> patients</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- nombre de docteurs -->
    <div class="row">
        <div class="col-12 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 id="nbreMedecin">{{$user->nbreUserByService("Médecine générale")}}</h3>
                            <h6 class="text-muted m-b-0">Médécins<i class="fa fa-user text-c-red m-l-10"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3>{{$user->nbreUserByService("Ophtalmologie")}}</h3>
                            <h6 class="text-muted m-b-0">Ophtalmologues<i class="fa fa-user text-c-red m-l-10"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3>{{$user->nbreUserByService("Cabinet dentaire")}}</h3>
                            <h6 class="text-muted m-b-0">Dentistes<i class="fa fa-user text-c-red m-l-10"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3>{{$user->nbreUserByService("Infirmerie")}}</</h3>
                            <h6 class="text-muted m-b-0">Infirmier<i class="fa fa-user text-c-red m-l-10"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 id="nbreMedecin">{{$user->nbreUserByService("Pédiatrie")}}</h3>
                            <h6 class="text-muted m-b-0">Pédiatres<i class="fa fa-user text-c-red m-l-10"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3>{{$user->nbreUserByService("Pharmacie")}}</h3>
                            <h6 class="text-muted m-b-0">Pharmaciens<i class="fa fa-user text-c-red m-l-10"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3>{{$user->nbreUserByService("Caisse")}}</h3>
                            <h6 class="text-muted m-b-0">Caissières<i class="fa fa-user text-c-red m-l-10"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3>{{$user->nbreUserByService("Secrétariat")}}</</h3>
                            <h6 class="text-muted m-b-0">Secrétaires<i class="fa fa-user text-c-red m-l-10"></i></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</di>
