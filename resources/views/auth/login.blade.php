@extends('auth.template')

@section('content')


<div class="card">
    <div class="row align-items-center text-center">
        <div class="col-md-12">
            <div class="card-body">
                <img src="{{asset('assets/images/user.png')}}" alt="icon" class="w-50">
                <h4 class="mb-3 f-w-400">Connexion</h4>
                <form action="{{route('handleLogin')}}" method="post" class="needs-validation" novalidate>

                    @if (Session::get('error_msg'))
                        <p class="text-danger">{{Session::get('error_msg')}}</p>
                        
                    @endif

                    @if (Session::get('message'))
                        <p class="text-success">{{Session::get('message')}}</p>
                        
                    @endif

                    @csrf
                    @method('POST')
                    <div class="form-group mb-4">
                        <label class="floating-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" tabindex="1" required>
                        <div class="invalid-feedback"> Veillez entrer votre Email </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" tabindex="2" required>
                        <div class="invalid-feedback"> Veillez entrer votre mot de passe </div>
                    </div>
                    <button type="submit" name="connexion" class="btn btn-block btn-primary mb-4" tabindex="3">Se connecter</button>
                    <p class="mb-2 text-muted">Mot de passe oublié ? <a href="#" data-toggle="modal" data-target="#resetPasswordModal" class="f-w-400">Reinitialiser</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
