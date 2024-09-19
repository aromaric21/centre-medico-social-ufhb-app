<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacie',
        'infirmerie',
        'biologie',
        'dentaire',
        'ophtalmologie',
        'patient_id',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function bilanCaisse($service,$dateDebut,$dateFin){
        return Caisse::whereBetween('created_at', [$dateDebut, $dateFin])->sum($service);
    }
}
