<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenPhysique extends Model
{
    use HasFactory;

    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }

    public function listeExamenPhysique($service,$debutDate,$finDate){
        
        if ($service == "tous") {
            return ExamenPhysique::join('consultations', 'consultations.id', '=', 'examen_physiques.consultation_id')
                        ->selectRaw('examen_physiques.typeExamenPhysique, sum(examen_physiques.id) as nrbeExamenPhysique')
                        ->groupBy('examen_physiques.typeExamenPhysique')
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        } else {
            return ExamenPhysique::join('consultations', 'consultations.id', '=', 'examen_physiques.consultation_id')
                        ->selectRaw('examen_physiques.typeExamenPhysique, sum(examen_physiques.id) as nrbeExamenPhysique')
                        ->groupBy('examen_physiques.typeExamenPhysique')
                        ->where('consultations.service', $service)
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        }
        
        
         
    }

    public function bilanExamenPhysique($service,$sexe,$trancheAge,$debutDate,$finDate,$typeExamenPhysique){
        
        if ($service == "tous") {
            return ExamenPhysique::join('consultations', 'consultations.id', '=', 'examen_physiques.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','examen_physiques.*')
                        ->where([
                            'consultations.service'=>$service,
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'examen_physiques.typeExamenPhysique'=>$typeExamenPhysique,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        } else {
            return ExamenPhysique::join('consultations', 'consultations.id', '=', 'examen_physiques.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','examen_physiques.*')
                        ->where([
                            'consultations.service'=>$service,
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'examen_physiques.typeExamenPhysique'=>$typeExamenPhysique,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        }
        
      

         
    }

}
