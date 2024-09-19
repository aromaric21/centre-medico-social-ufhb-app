<?php

namespace App\Livewire;

use App\Models\Soins;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Controle;
use App\Models\Consultation;
use App\Models\ExamenPhysique;
use App\Models\ExamenComplementaire;
use App\Models\User;

class Dashboard extends Component
{
    public function render()
    {
        $data = [
            'patient'=>new Patient(),
            'consultation'=>new Consultation(),
            'controle'=>new Controle(),
            'user'=>new User(),
            'soins'=>new Soins()
        ];
        return view('livewire.admin.dashboard', $data)
                    ->extends("layouts.template")
                    ->section("content");
    }
}
