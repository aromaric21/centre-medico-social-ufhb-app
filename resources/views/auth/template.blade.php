
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
    <link rel="icon"
        href="{{ asset('assets/images/favicon.ico') }}"
        type="image/x-icon">
    <!-- prism css -->
    <link rel="stylesheet"
        href="{{ asset('assets/css/plugins/prism-coy.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/package/dist/sweetalert2.min.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet"
        href="{{ asset("assets\css\style.css") }}">



</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>


    <!-- connexion -->
    
    <nav class="pcoded-navbar theme-horizontal menu-light brand-blue">
        <div class="navbar-wrapper container">
            <div class="navbar-content" id="layout-sidenav">
            </div>
        </div>
    </nav>
    <!-- connexion -->


    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="container">
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
                    <li><a href="{{route("login")}}"><i class="feather icon-log-in"></i> Seconnecter</a></li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->

    <div class="auth-wrapper mt-5">
        <div class="auth-content">
            @yield('content')
        </div>
    </div>

    
<div id="resetPasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalTitle">Mot de passe oublié</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('verifEmail')}}" method="post" class=" needs-validation" novalidate="">
                    @csrf
                    @method('POST')
                    <div class="form-group ml-3">
                        <label for="resetPasswordEmail" class="floating-label text-primary">Entrer l'adresse mail</label>
                        <input type="email" class="form-control" name="resetPasswordEmail" id="resetPasswordEmail" tabindex="1" required>
                        <div class="invalid-feedback"> Veillez entrer votre adresse mail</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-secondary" data-dismiss="modal" id="fermerReinitialiserPasswordBtn">Annuler</button>
                        <button type="submit" class="btn  btn-primary" id="reinitialiserPasswordBtn">Reinitialiser</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

    <!-- fin connexion -->

        <!-- fin connexion -->



        <div class="bg-light" style="border: 1px solid white;">
        <div class="text-center">
            <p>Copyright &copy; Designed & Developed by <span class="text-primary">Eb-tec</span> 2023</p>
        </div>
    </div>

    <!-- Required Js -->
    <script src="{{asset('assets/js/vendor-all.min.js')}}">
    </script>
    <script
        src="{{asset('assets/js/plugins/bootstrap.min.js')}}">
    </script>
    <script src="{{asset('assets/js/ripple.js')}}"></script>
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>
    <script src="{{asset('assets/js/jspdf.min.js')}}"></script>
    <script src="{{asset('assets/js/html2canvas.min.js')}}"></script>

    <!-- prism Js -->
    <script
        src="{{asset('assets/js/plugins/prism.js')}}">
    </script>
    <script
        src="{{asset('assets/package/dist/sweetalert2.min.js')}}">
    </script>
 
    <script>
        //alerte message
        function alerteMessage(div, typeAlerte, message) {
            let typeMessage = '';
            if (typeAlerte == 'danger') {
                typeMessage = "Alerte message d'erreur"
            }
            if (typeAlerte == 'success') {
                typeMessage = "Alerte message de succès"
            }
            $(`#${div}`).html(`
            <div style="position:fixed;top:40px;right: 40px; z-index: 9999;">
                <div class="toast hide ${div} bg-${typeAlerte}" role="alert" aria-live="assertive" data-delay="10000" aria-atomic="true">
                    <div class="toast-header">
                        <span class="text-${typeAlerte}"><i class="icon feather icon-bell"></i> <strong class=" mr-auto"> ${typeMessage}</strong></span>
                        <button type="button" class="m-l-5 mb-1 mt-1 close ml-5 ml-auto" data-dismiss="toast" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="toast-body text-light text-center">
                        ${message}
                    </div>
                </div>
            </div>
            `);

            $(`.${div}`).toast('show')
        }
    </script>
</body>

</html>