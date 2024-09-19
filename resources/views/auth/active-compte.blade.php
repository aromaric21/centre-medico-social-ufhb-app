@extends('auth.template')

@section('content')


<div class="card">
    <div class="row align-items-center text-center">
        <div class="col-md-12">
            <div class="card-body">
                <img src="{{asset('assets/images/user.png')}}" alt="icon" class="w-50">
                <h4 class="mb-3 f-w-400">Activation de compte</h4>
                <form action="{{route('handleActivecompte',$email)}}" method="post" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    @if (Session::get('error_msg'))
                        <p class="text-danger">{{Session::get('error_msg')}}</p>
                        
                    @endif
                    <p class="alert alert-success text-center">
                        Un code d'activation a été a ete envoye sur le mail {{ $email }} . <br> Entrez le code pour activer votre compte.
                    </p>

                    <div class="form-group mb-4">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$email}}" tabindex="2"  required readonly>
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="password">Entrer le code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" tabindex="2" value="{{ old('code') }}" required>
                        <div class="invalid-feedback"> Veillez entrer Code </div>
                        @error('code') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="password">Nouveau mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" tabindex="2" required>
                        <div class="invalid-feedback"> Veillez entrer votre mot de passe </div>
                        @error('password') <span class="text-danger">{{$message}} </span> @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="floating-label" for="confirmpassword">Confirmer mot de passe</label>
                        <input type="password" class="form-control @error('confirmpassword') is-invalid @enderror" id="confirmpassword" name="confirmpassword" tabindex="2" required>
                        <div class="invalid-feedback"> Veillez entrer votre mot de passe </div>
                        @error('confirmpassword') <span class="text-danger"> {{$message}}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-block btn-primary mb-4" tabindex="3">Activer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection