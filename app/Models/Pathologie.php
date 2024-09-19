<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pathologie extends Model
{
    use HasFactory;


    protected $fillable = [
        'pathologie',
        'typePathologie',
        'consultation_id',
    ];

    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }



    public function listePathologie($service,$debutDate,$finDate){
        
        if ($service=="tous") {
            return Pathologie::join('consultations', 'consultations.id', '=', 'pathologies.consultation_id')
                        ->selectRaw('pathologies.typePathologie, sum(pathologies.id) as nrbePathologie')
                        ->groupBy('pathologies.typePathologie')
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        } else {
            return Pathologie::join('consultations', 'consultations.id', '=', 'pathologies.consultation_id')
                        ->selectRaw('pathologies.typePathologie, sum(pathologies.id) as nrbePathologie')
                        ->groupBy('pathologies.typePathologie')
                        ->where('consultations.service', '=', $service)
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        }
        

         
    }

    public function bilanPathologie($service,$sexe,$trancheAge,$debutDate,$finDate,$typePathologie){
        
        if ($service) {
            return Pathologie::join('consultations', 'consultations.id', '=', 'pathologies.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','pathologies.*')
                        ->where([
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'pathologies.typePathologie'=>$typePathologie,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        } else {
            return Pathologie::join('consultations', 'consultations.id', '=', 'pathologies.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','pathologies.*')
                        ->where([
                            'consultations.service'=>$service,
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'pathologies.typePathologie'=>$typePathologie,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        }
        


         
    }
}
