<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soins extends Model
{
    use HasFactory;

    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }

    public function listeSoins($service,$debutDate,$finDate){
        
        if ($service=="tous") {
            return Soins::join('consultations', 'consultations.id', '=', 'soins.consultation_id')
                        ->selectRaw('soins.soins, sum(soins.id) as nrbeSoins')
                        ->groupBy('soins.soins')
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        } else {
            return Soins::join('consultations', 'consultations.id', '=', 'soins.consultation_id')
                        ->selectRaw('soins.soins, sum(soins.id) as nrbeSoins')
                        ->groupBy('soins.soins')
                        ->where('consultations.service', $service)
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        }
        
        
         
    }

    public function bilanSoins($service,$sexe,$trancheAge,$debutDate,$finDate,$soins){
        
        if ($service=="tous") {
            return Soins::join('consultations', 'consultations.id', '=', 'soins.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','soins.*')
                        ->where([
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'soins.soins'=>$soins,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        } else {
            return Soins::join('consultations', 'consultations.id', '=', 'soins.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','soins.*')
                        ->where([
                            'consultations.service'=>$service,
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'soins.soins'=>$soins,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        }
        


         
    }

    public function nbreSoins(){
        return Soins::count();
    }
}
