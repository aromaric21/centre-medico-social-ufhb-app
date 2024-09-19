<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controle extends Model
{
    use HasFactory;

    protected $fillable = [
        'etatSante',
        'observation',
        'profession',
        'dateControle',
        'consultation_id',
    ];

    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }


    
    public function bilanControle($service,$sexe,$profession,$trancheAge,$debutDate,$finDate){
        
        if ($service=="tous") {
            return Controle::join('consultations', 'consultations.id', '=', 'controles.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','controles.*')
                        ->where([
                            'patients.sexe'=>$sexe,
                            'consultations.profession'=>$profession,
                            'consultations.trancheAge'=>$trancheAge,
                        ])
                        ->whereBetween('controles.dateControle', [$debutDate, $finDate])
                        ->count();
        } else {
            return Controle::join('consultations', 'consultations.id', '=', 'controles.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','controles.*')
                        ->where([
                            'consultations.service'=>$service,
                            'patients.sexe'=>$sexe,
                            'consultations.profession'=>$profession,
                            'consultations.trancheAge'=>$trancheAge,
                        ])
                        ->whereBetween('controles.dateControle', [$debutDate, $finDate])
                        ->count();
        }
        
       

         
    }


    public function nbreControleByService($service){
        if ($service=="tout") {
            return Controle::count();
        } else {
            return Controle::join('consultations', 'consultations.id', '=', 'controles.consultation_id')
                        ->select('consultations.*','controles.*')
                        ->where('consultations.service',$service)
                        ->count();
        }
        
    }
}
