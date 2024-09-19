<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraitementDentaire extends Model
{
    use HasFactory;

    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }

    public function listeTraitement($service,$debutDate,$finDate){
        
        if ($service=="tous") {
            return TraitementDentaire::join('consultations', 'consultations.id', '=', 'traitement_dentaires.consultation_id')
                        ->selectRaw('traitement_dentaires.typeTraitement, sum(traitement_dentaires.id) as nrbeTraitement')
                        ->groupBy('traitement_dentaires.typeTraitement')
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        } else {
            return TraitementDentaire::join('consultations', 'consultations.id', '=', 'traitement_dentaires.consultation_id')
                        ->selectRaw('traitement_dentaires.typeTraitement, sum(traitement_dentaires.id) as nrbeTraitement')
                        ->groupBy('traitement_dentaires.typeTraitement')
                        ->where('consultations.service', $service)
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        }
        
      
         
    }

    public function bilanTraitement($service,$sexe,$trancheAge,$debutDate,$finDate,$typeTraitement){
        
        if ($service=="tous") {
            return TraitementDentaire::join('consultations', 'consultations.id', '=', 'traitement_dentaires.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','traitement_dentaires.*')
                        ->where([
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'traitement_dentaires.typeTraitement'=>$typeTraitement,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        } else {
            return TraitementDentaire::join('consultations', 'consultations.id', '=', 'traitement_dentaires.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','traitement_dentaires.*')
                        ->where([
                            'consultations.service'=>$service,
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'traitement_dentaires.typeTraitement'=>$typeTraitement,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        }
        
 

         
    }
}
