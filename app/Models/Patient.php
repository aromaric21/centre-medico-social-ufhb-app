<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'numeroFiche',
        'nomPrenom',
        'sexe'
    ];

    public function consultations(){
        return $this->hasMany(Consultation::class);
    }

    public function lastConsultations($id){
        return $this->consultations()->latest()->where("patient_id",$id)->first();
    }

    public function listConsultationsByService(){
        return $this->hasMany(Consultation::class)->where("service",getRoleServiceName());
    }

    public function bilanPatient($service,$sexe,$profession,$trancheAge,$debutDate,$finDate){

        if ($service=="tous") {
            return Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                            ->select('patients.*','consultations.*')
                            ->distinct('consultations.patient_id')
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
                            ->distinct('consultations.patient_id')
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

    public function nbrePatientByService($service){
        if ($service=="tout") {
            return Patient::count();
        } else {
            return Patient::join('consultations', 'patients.id', '=', 'consultations.patient_id')
                            ->select('patients.*','consultations.*')
                            ->distinct('consultations.patient_id')
                            ->where('consultations.service',$service)
                            ->count();
        }
        
    }
}
