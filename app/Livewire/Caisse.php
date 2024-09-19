<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Caisse as CaisseDepense;

class Caisse extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $currentPage = PAGELISTDEPENSE;
    public $newDepense = [];
    public $infoDepense;
    public $search = '';

    
    public function render() {
        Carbon::setLocale("fr");
        $searchCriteria = '%'.$this->search.'%';
        //dump( $this->search );
        $depenses = CaisseDepense::where("created_at","like",$searchCriteria)->latest()->paginate( 5 );
        $depenses->onEachSide(1);
            
        $data = [
            'depenses'=>$depenses
        ];
        
        return view( 'livewire.user.caisse.index', $data )
        ->extends( 'layouts.template' )
        ->section( 'content' );
    }



    
    public function messages() {
       
        return [
            'newDepense.infirmerie.min'=>"Erreur montant",
            'newDepense.biologie.min'=>"Erreur montant",
            'newDepense.dentaire.min'=>"Erreur montant",
            'newDepense.ophtalmologie.min'=>"Erreur montant",
            'newDepense.numeroFiche.required'=>"Le numero est requise",
            'newDepense.numeroFiche.exists'=>"Le numero n'existe pas",
        ];
    }

    public function rules() {

        return [
            'newDepense.infirmerie' => 'min:0',
            'newDepense.biologie' => 'min:0',
            'newDepense.dentaire' => 'min:0',
            'newDepense.ophtalmologie' => 'min:0',
            'newDepense.numeroFiche' => 'required|exists:patients,numeroFiche',
        ];

    }


    public function goToListeDepense() {
        
        $this->newDepense = [];
        $this->resetErrorBag();
        $this->currentPage = PAGELISTDEPENSE;
        //$this->editUser = [];
    }


    public function goToCreateNewDepense() {
        $this->currentPage = PAGECREATE;
    }

    public function goToEditDepense(CaisseDepense $depense) {
 
        $this->newDepense = $depense->toArray();
        $this->infoDepense = $depense;
        $this->newDepense["numeroFiche"] = $depense->patient()->first()->numeroFiche;
        $this->resetErrorBag();
        $this->currentPage = PAGEEDITDEPENSE;
        //$this->editUser = [];
    }

    public function addDepense(){
        
        if($this->validate()){
            $patient = Patient::where("numeroFiche", $this->newDepense["numeroFiche"])->first();
            $this->newDepense["patient_id"]=$patient->id;
            $this->newDepense["user_id"]=auth()->user()->id;
            CaisseDepense::create( $this->newDepense );
            $this->resetErrorBag();
            $this->dispatch( 'showSuccessMessage', message: [ 'message'=>'Depense ajoutée avec succèes !', 'type'=>'success' ] );
            $this->newDepense = [];
        }
    }

    public function editDepense(){
        if($this->validate()){
            $this->infoDepense->infirmerie = $this->newDepense["infirmerie"];
            $this->infoDepense->biologie = $this->newDepense["biologie"];
            $this->infoDepense->dentaire = $this->newDepense["dentaire"];
            $this->infoDepense->ophtalmologie = $this->newDepense["ophtalmologie"];
            $this->infoDepense->pharmacie = $this->newDepense["pharmacie"];
            $this->infoDepense->update();
            $this->dispatch( 'showSuccessMessage', message: [ 'message'=>'Depense mise à jour avec succèes !', 'type'=>'success' ] );
            $this->newDepense = [];
        }
    }



    public function confirmeDelete($id){
        $this->dispatch("showConfirmMessage", message: [
            'message'=>"Vous etes sur le point de supprimer cette dépense de la liste des depenses. Voulez-vous contiues?",
            'id'=>$id
        ]);
    }

    /** Supprimer un medicament */
    public function deleteDepense($id){
        CaisseDepense::destroy($id);
        $this->dispatch("showSuccessMessage", message: [
            'message'=>"Dépense supprimé avec succes",
            'type'=>'success'
        ]);
    }


}
