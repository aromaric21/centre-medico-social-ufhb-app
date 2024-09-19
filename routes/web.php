<?php

use App\Livewire\Users;
use App\Livewire\Caisse;
use App\Livewire\Dashboard;
use App\Livewire\Pharmacie;
use App\Livewire\BilanCaisse;
use App\Livewire\Consultations;
use App\Livewire\BilanConsultation;
use App\Livewire\HistoriqueControle;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Livewire\ConsultationController;
use App\Livewire\HistoriqueConsultation;
use App\Livewire\Profil;


//Route non securisée
Route::middleware('guest')->group(function(){
    Route::get('/',[AuthController::class,'login'])->name('login');
    Route::post('/',[AuthController::class,'handleLogin'])->name('handleLogin');

    Route::prefix('reinitialisation')->group(function(){

        Route::get('/verification-email',[AuthController::class,'login']);
        Route::post('/verification-email',[AuthController::class,'verifEmail'])->name('verifEmail');
        Route::get('/reset-password/{email}',[AuthController::class,'resetPassword'])->name('resetPassword');
        Route::put('/reset-password/{email}',[AuthController::class,'handleResetPassword'])->name('handleResetPassword');

        Route::get('/reset-password/{email}',[AuthController::class,'resetPassword'])->name('resetPassword');
        Route::put('/reset-password/{email}',[AuthController::class,'handleResetPassword'])->name('handleResetPassword');
    });

    Route::prefix('activation')->group(function(){
        Route::get('/compte/{email}',[AuthController::class,'activecompte'])->name('activecompte');
        Route::put('/compte/{email}',[AuthController::class,'handleActivecompte'])->name('handleActivecompte');
    });

});


//Route Securisee
Route::middleware('auth')->group(function(){

    Route::middleware('admin')->group(function(){
        Route::prefix('admin')->group(function(){
            Route::get('/utilisateur',Users::class)->name('user');
                    
        });
    });

    Route::middleware('adminSecretaire')->group(function(){
        Route::get('/dashboard',Dashboard::class)->name('dashboard');
        Route::get('/liste-consultation',ConsultationController::class)->name('secretaire.consultation.index');
    });


    Route::prefix('user')->group(function(){
        Route::get('/accueil',[UserController::class,'home'])
                                            ->name('home')
                                            ->middleware("caissierPharmacienDocteurs");
        Route::get('/consultation',Consultations::class)
                                            ->name('consultation.index')
                                            ->middleware("adminSecretaireDocteurs");
        Route::get('/historique/consultation/{patient}',HistoriqueConsultation::class)
                                            ->name('historique.consultation.index')
                                            ->middleware("adminSecretaireDocteurs");
        Route::get('/historique/controle/{consultation}',HistoriqueControle::class)
                                            ->name('historique.controle.index')
                                            ->middleware("adminSecretaireDocteurs");
        Route::get('/bilan/consultation',BilanConsultation::class)
                                            ->name('bilan.consultation.index')
                                            ->middleware("secretaireDocteurs");
        Route::get('/pharmacie',Pharmacie::class)->name('pharmacie.index')
                                            ->middleware("adminSecretairePharmacien");
        Route::get('/caisse',Caisse::class)->name('caisse.index')
                                        ->middleware("adminSecretaireCaissier");
        Route::get('/bilan/caisse',BilanCaisse::class)->name('bilan.caisse.index')
                                        ->middleware("adminSecretaireDocteurs");
        
        
    });

    Route::get('/profil/{user}',Profil::class)->name('profil');
    Route::get('/deconnexion',[AuthController::class,'logout'])->name('logout');

});

