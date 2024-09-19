<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact',
        'residence',
        'profession',
        'age',
        'trancheAge',
        'assure',
        'motifConsultation',
        'poids',
        'temperature',
        'tensionArterielle',
        'pouls',
        'histoireMaladie',
        'hypotheseDiagnostic',
        'miseObservation',
        'refere',
        'traitement',
        'dateConsultation',
        'service',
        'patient_id',
        'user_id'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pathologies(){
        return $this->hasMany(Pathologie::class);
    }

    public function examenPhysiques(){
        return $this->hasMany(ExamenPhysique::class);
    }

    public function examenComplementaires(){
        return $this->hasMany(ExamenComplementaire::class);
    }

    public function soins(){
        return $this->hasMany(Soins::class);
    }

    public function controles(){
        return $this->hasMany(Controle::class);
    }

    public function antecedents(){
        return $this->hasMany(Antecedent::class);
    }

    public function traitementDentaires(){
        return $this->hasMany(TraitementDentaire::class);
    }


    public function bilanConsultation($service,$sexe,$profession,$trancheAge,$debutDate,$finDate){

        if ($service=="tous") {
            return Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*')
                        ->where([
                            'patients.sexe'=>$sexe,
                            'consultations.profession'=>$profession,
                            'consultations.trancheAge'=>$trancheAge,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        } else {
            return Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*')
                        ->where([
                            'consultations.service'=>$service,
                            'patients.sexe'=>$sexe,
                            'consultations.profession'=>$profession,
                            'consultations.trancheAge'=>$trancheAge,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        }
        
        

         
    }

    public function bilanTraitement($service,$option,$critere,$debutDate,$finDate){
        
        if ($service=="tous") {
            return Consultation::where([
                $option=>$critere
            ])
            ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
            ->count();
        } else {
            return Consultation::where([
                'service'=>$service,
                $option=>$critere
            ])
            ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
            ->count();
        }
        
        

         
    }



    public function listeConsultation($service,$docteur,$date){

        return User::join('consultations', 'users.id', '=', 'consultations.user_id')
                    ->select('users.*','consultations.*')
                    ->where('consultations.service','like',$service)
                    ->where('consultations.dateConsultation','like',$date)
                    ->whereAny(["users.nom","users.prenom"],'like',$docteur);

    }

    public function nbreConsultationByService($service){
        if ($service=="tout") {
            return Consultation::count();
        } else {
            return Consultation::where('service',$service)->count();
        }
        
    }

}
