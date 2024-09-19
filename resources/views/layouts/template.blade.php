<!DOCTYPE html>
<html lang="en">

<head>
    <title>Centre Medico-Social</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- prism css -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/prism-coy.css')}}">
    <link rel="stylesheet" href="{{asset('assets/package/dist/sweetalert2.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    @livewireStyles


</head>

<body>
    <div>
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>


        <!-- connexion -->
        <!-- fin connexion -->



        <div class="body">
            <input type="hidden" name="idUserConnecte" id="idUserConnecte" value="1">
            <!-- [ Pre-loader ] End -->
        @include('layouts.sidebar')

        @include('layouts.topbar')
            
            <!-- [ Header ] end -->
            <!-- [ Main Content ] start -->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <span id="afficherNotification"></span>
                                    <!-- alerte -->
                                    <span id="alerteMessageInfo"></span>
                                    <!-- [ breadcrumb ] start -->
                            
                                    @yield('content')
                                
                                    <!-- [ breadcrumb ] end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>

        <div id="modifierPasswordModal" class="modal fade" data-backdrop="static" data-keyboad="false" tabindex="-1"
            role="dialog" aria-labelledby="modifierPasswordModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifierPasswordModalCenterTitle">Changer Mot de Passe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="modifierPasswordForm">
                            <input type="hidden" name="id" id="idUser" value="1">
                            <div class="form-group ml-3">
                                <label for="password" class="floating-label text-primary errorPassword">Ancien mot de
                                    passe</label>
                                <input type="password" class="form-control errorPassword" name="password" id="password"
                                    required>
                            </div>
                            <div class="form-group ml-3">
                                <label for="password1" class="floating-label text-primary errorPassword">Nouveau mot de
                                    passe</label>
                                <input type="password" class="form-control errorPassword" name="password1" id="password1"
                                    required>
                            </div>
                            <div class="form-group ml-3">
                                <label for="password2" class="floating-label text-primary errorPassword">Confirmer mot de
                                    passe</label>
                                <input type="password" class="form-control errorPassword" name="password2" id="password2"
                                    required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal"
                            id="fermermodifierPasswordBtn">Annuler</button>
                        <button type="button" class="btn  btn-primary" id="modifierPasswordBtn">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-light" style="border: 1px solid white;">
            <div class="text-center">
                <p>Copyright &copy; Designed & Developed by <span class="text-primary">Eb-tec</span> 2023</p>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/ripple.js')}}"></script>
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>
    <script src="{{asset('assets/js/jspdf.min.js')}}"></script>
    <script src="{{asset('assets/js/html2canvas.min.js')}}"></script>

    <!-- prism Js -->
    <script src="{{asset('assets/js/plugins/prism.js')}}"></script>
    <script src="{{asset('assets/package/dist/sweetalert2.min.js')}}"></script>



    <script>
        function alerteMessage(div, typeAlerte, message) {
            let typeMessage = '';
            $(`#${div}`).html(`
            <div style="position:fixed;top:40px;right: 40px; z-index: 9999;">
                <div class="toast hide ${div}" role="alert" aria-live="assertive" data-delay="10000" aria-atomic="true">
                    <div class="toast-header">
                        <span class="text-${typeAlerte}"><i class="icon feather icon-bell"></i> <strong class=" mr-auto"> ${message}</strong></span>
                        <button type="button" class="m-l-5 mb-1 mt-1 close mr-auto" data-dismiss="toast" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            `);

            $(`.${div}`).toast('show')
        }
    </script>

    @livewireScripts
</body>

</html>