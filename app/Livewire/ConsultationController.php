<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Role;
use Livewire\Component;
use App\Models\Consultation;
use Livewire\WithPagination;

class ConsultationController extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $currentPage = PAGELISTCONSULTATION;

    public $service = '';
    public $docteur = '';
    public $date = '';
    public $consultation;
    public $infoPatient;
    public $fille="";

    public function render() {
        Carbon::setLocale("fr");
        $listeConsultation = new Consultation();
        $searchService = '%'.$this->service.'%';
        $searchDocteur = '%'.$this->docteur.'%';
        $searchDate = '%'.$this->date.'%';
       
        $data = [
            'consultations'=>$listeConsultation->listeConsultation($searchService,$searchDocteur,$searchDate)
                                                ->latest("consultations.created_at"),
            "roles"=>Role::get()
        ];
        return view( 'livewire.user.secretaire.consultation.index', $data )
                ->extends( 'layouts.template' )
                ->section( 'content' );
    }


    
    public function detailConsultation( Consultation $consultation ) {
        $this->consultation = $consultation;

        $this->currentPage = PAGEDETAILCONSULTATION;
    }

    public function listeConsultation() {
        $this->currentPage = PAGELISTCONSULTATION;
    }


    public function showModal($fille, $modal)
    {

        $this->fille = $fille;
        $this->dispatch('showModal', message: $modal);

        // $this->modal = $modal;

    }

    public function closeModal($modal)
    {
        $this->resetErrorBag();
        $this->dispatch('closeModal', message: $modal);
    }
}
