<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamenComplementaire extends Model
{
    use HasFactory;

    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }


    public function listeExamenComplementaire($service,$debutDate,$finDate,$examen){

        if ($service == "tous") {
            return ExamenComplementaire::join('consultations', 'consultations.id', '=', 'examen_complementaires.consultation_id')
                        ->selectRaw('examen_complementaires.typeExamen, sum(examen_complementaires.id) as nrbeTypeExamen')
                        ->groupBy('examen_complementaires.typeExamen')
                        ->where([
                            'examen_complementaires.examen' => $examen,
                            ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        } else {
            return ExamenComplementaire::join('consultations', 'consultations.id', '=', 'examen_complementaires.consultation_id')
                        ->selectRaw('examen_complementaires.typeExamen, sum(examen_complementaires.id) as nrbeTypeExamen')
                        ->groupBy('examen_complementaires.typeExamen')
                        ->where([
                            'consultations.service' => $service,
                            'examen_complementaires.examen' => $examen,
                            ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        }
        
        

         
    }

    public function bilanExamenComplementaires($service,$sexe,$trancheAge,$debutDate,$finDate,$examen,$typeExamen){
        
        if ($service=="tous") {
            return ExamenComplementaire::join('consultations', 'consultations.id', '=', 'examen_complementaires.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','examen_complementaires.*')
                        ->where([
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'examen_complementaires.examen'=>$examen,
                            'examen_complementaires.typeExamen'=>$typeExamen,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        } else {
            return ExamenComplementaire::join('consultations', 'consultations.id', '=', 'examen_complementaires.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','examen_complementaires.*')
                        ->where([
                            'consultations.service'=>$service,
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'examen_complementaires.examen'=>$examen,
                            'examen_complementaires.typeExamen'=>$typeExamen,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        }
        
        

         
    }

}
