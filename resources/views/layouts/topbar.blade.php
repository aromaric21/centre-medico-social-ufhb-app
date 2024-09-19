<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue bg-primary"
    style="position: fixed; z-index: 999;">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{asset('assets/images/logo_cpb.png')}}" alt="" class="logo">
            <img src="{{asset('assets/images/logo-icon.png')}}" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">

        <ul class="navbar-nav ml-auto">
            <!-- notification end -->

            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" id="afficherListeNotification" href="#" data-toggle="dropdown">
                        <i id="newNotification" class="icon feather icon-bell"></i><span
                            class="newNotification text-danger"><i><strong><span
                                        id="nbreNewNotification"></span></strong></i></span></a>

                    <div class='dropdown-menu dropdown-menu-right notification'>
                        <div class='noti-head'>
                            <h6 class='d-inline-block m-b-0'>Notifications</h6>
                            <div class='float-right'>
                                <a href='#!' id='toutSupprime'>Tout supprimé</a>
                            </div>
                        </div>
                        <ul class='noti-body'>
                            <div id="listeNotification"></div>
                        </ul>
                        <div class='noti-footer'>
                            <a href='/centreMedicoSociaux/user/listeAction-utilisateur'>Tout afficher</a>
                        </div>
                    </div>

                </div>
            </li>
            <!-- notification end -->
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{asset('assets/images/user.png')}}" class="img-radius"
                                alt="User-Profile-Image">
                                <span>{{userFullName()}}</span>
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{route("profil",auth()->user()->id)}}"
                                    class="dropdown-item" id="changer"><i class="feather icon-user"></i>
                                    Profil</a></li>
                            <li><a href="{{route('logout')}}" class="dropdown-item"><i
                                        class="feather icon-log-out"></i> Se deconnecter</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>