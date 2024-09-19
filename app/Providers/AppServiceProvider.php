<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Gate::define("admin", function(User $user){
            return $user->hasRole('Admin');
        });

        Gate::define("caissier", function(User $user){
            return $user->hasRole('Caissière');
        });

        Gate::define("pharmacien", function(User $user){
            return $user->hasRole('Pharmacien');
        });

        Gate::define("secretaire", function(User $user){
            return $user->hasRole('Secrétaire');
        });

        Gate::define("docteurs", function(User $user){
            return $user->hasAnyRoles(['Médecin','Pédiatre','Dentiste','Ophtalmologue','Infirmier']);
        });


        Gate::define("adminSecretaire", function(User $user){
            return $user->hasAnyRoles(['Admin','Secrétaire']);
        });

        Gate::define("adminSecretaireDocteurs", function(User $user){
            return $user->hasAnyRoles(['Admin','Secrétaire','Médecin','Pédiatre','Dentiste','Ophtalmologue','Infirmier']);
        });

        Gate::define("secretaireDocteurs", function(User $user){
            return $user->hasAnyRoles(['Secrétaire','Médecin','Pédiatre','Dentiste','Ophtalmologue','Infirmier']);
        });

        Gate::define("caissierPharmacienDocteurs", function(User $user){
            return $user->hasAnyRoles(['Pharmacien','Caissière','Médecin','Pédiatre','Dentiste','Ophtalmologue','Infirmier']);
        });

        Gate::define("adminSecretairePharmacien", function(User $user){
            return $user->hasAnyRoles(['Pharmacien','Admin','Secrétaire']);
        });

        Gate::define("adminSecretaireCaissier", function(User $user){
            return $user->hasAnyRoles(['Caissière','Admin','Secrétaire']);
        });
    }
}
