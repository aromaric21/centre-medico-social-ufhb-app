 <!-- [ navigation menu ] start -->
 <nav class="pcoded-navbar menu-light brand-blue" style="position: fixed; z-index: 999;">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">


            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{asset('assets/images/logoEcole.JPG')}}"
                        alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details">
                            {{getRoleServiceName()}}  @can('admin')<i class="fa fa-caret-down"></i>@endcan
                        </div>
                    </div>
                </div>
                @can('admin')
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-unstyled">
                            <li class="list-group-item">
                                <a href="/centreMedicoSociaux/listeAction-utilisateur">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                    </path></svg> Paramètres
                                </a>
                            </li>
                        </ul>
                    </div>
                @endcan
                
            </div>

            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                @canany(['docteurs', 'pharmacien', 'caissier'])
                <li class="nav-item">
                    <a href="{{route("home")}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-home"></i></span>
                        <span class="pcoded-mtext">Accueil</span>
                    </a>
                </li>
                @endcan

                @canany(['secretaire', 'admin'])
                <li class="nav-item">
                    <a href="{{route("dashboard")}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-home"></i></span>
                        <span class="pcoded-mtext">Tableau de bord</span>
                    </a>
                </li>
                @endcan

                @can('admin')
                <li class="nav-item">
                    <a href="{{route("user")}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-user"></i></span>
                        <span class="pcoded-mtext">Utilisateurs</span>
                    </a>
                </li>
                @endcan

                @can('docteurs')
                <li class="nav-item">
                    <a href="{{route('consultation.index')}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-stethoscope"></i></span>
                        <span class="pcoded-mtext">Consultation</span>
                    </a>
                </li>
                @endcan

                @can('adminSecretaire')
                <li class="nav-item">
                    <a href="{{route('consultation.index')}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                        <span class="pcoded-mtext">Patients</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('secretaire.consultation.index')}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-stethoscope"></i></span>
                        <span class="pcoded-mtext">Liste consultation</span>
                    </a>
                </li>

                @endcan

                @canany(['secretaire', 'docteurs'])
                <li class="nav-item">
                    <a href="{{route("bilan.consultation.index")}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-hospital"></i></span>
                        <span class="pcoded-mtext">Bilan consultation</span>
                    </a>
                </li>
                @endcanany

                @canany(['secretaire', 'admin', 'pharmacien'])
                <li class="nav-item">
                    <a href="{{route('pharmacie.index')}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-database"></i></span>
                        <span class="pcoded-mtext">Liste medicament</span>
                    </a>
                </li>
                @endcanany

                @canany(['secretaire', 'admin','caissier'])
                <li class="nav-item">
                    <a href="{{route('caisse.index')}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-list"></i></span>
                        <span class="pcoded-mtext">Caisse</span>
                    </a>
                </li>
                @endcanany

                @can('adminSecretaireDocteurs')
                <li class="nav-item">
                    <a href="{{route('bilan.caisse.index')}}" class="nav-link active">
                        <span class="pcoded-micon"><i class="fa fa-box"></i></span>
                        <span class="pcoded-mtext">Bilan caisse</span>
                    </a>
                </li>
                @endcan
                
                <br><br>
            </ul>

        </div>
    </div>
</nav>

<!-- [ navigation menu ] end -->
