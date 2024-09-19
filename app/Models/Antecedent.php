<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedent extends Model
{
    use HasFactory;

    public function consultation(){
        return $this->belongsTo(Consultation::class);
    }


    public function listeAntecedent($service,$debutDate,$finDate){
        
        if ($service=="tous") {
            return Antecedent::join('consultations', 'consultations.id', '=', 'antecedents.consultation_id')
                        ->selectRaw('antecedents.typeAntecedent, sum(antecedents.id) as nrbeAntecedent')
                        ->groupBy('antecedents.typeAntecedent')
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        } else {
            return Antecedent::join('consultations', 'consultations.id', '=', 'antecedents.consultation_id')
                        ->selectRaw('antecedents.typeAntecedent, sum(antecedents.id) as nrbeAntecedent')
                        ->groupBy('antecedents.typeAntecedent')
                        ->where('consultations.service', $service)
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->get();
        }
        

         
    }

    public function bilanAntecedent($service,$sexe,$trancheAge,$debutDate,$finDate,$typeAntecedent){
        
        if ($service=="tous") {
            return Antecedent::join('consultations', 'consultations.id', '=', 'antecedents.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','antecedents.*')
                        ->where([
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'antecedents.typeAntecedent'=>$typeAntecedent,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        } else {
            return Antecedent::join('consultations', 'consultations.id', '=', 'antecedents.consultation_id')
                        ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                        ->select('patients.*','consultations.*','antecedents.*')
                        ->where([
                            'consultations.service'=>$service,
                            'patients.sexe'=>$sexe,
                            'consultations.trancheAge'=>$trancheAge,
                            'antecedents.typeAntecedent'=>$typeAntecedent,
                        ])
                        ->whereBetween('consultations.dateConsultation', [$debutDate, $finDate])
                        ->count();
        }
        
       

         
    }


}
