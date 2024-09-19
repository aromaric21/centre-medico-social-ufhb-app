<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Medicament;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Support\Facades\Storage;

class Pharmacie extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $disponibilite = '';
    public $pdfContent="";
    
    public $isAddMedicament = false;
    public $isEditMedicament = false;
    public $medicament = [];
    public $infoMedicament;
    
    public function render() {
        
        $searchCriteria = '%'.$this->search.'%';
        $stockDisponibilite = $this->disponibilite;
        //dump( $this->search );
        if ($stockDisponibilite == '') {
            
            $data = [
                'medicaments'=>Medicament::where( 'nomMedicament', 'like', $searchCriteria )
                ->latest()->paginate( 5 )
            ];
        } else {
            if ($stockDisponibilite=='stockRupture') {
                $data = [
                    'medicaments'=>Medicament::where( 'stock', 0 )
                    ->latest()->paginate( 5 )
                ];
            }
            if ($stockDisponibilite=='ruptureRayon') {
                $data = [
                    'medicaments'=>Medicament::where( 'disponibleRayon', 0 )
                            ->orWhere( 'disponibleRayon', null)
                            ->latest()->paginate( 5 )
                ];
            } 
            if ($stockDisponibilite=='stockRuptureAndRuptureRayon') {
                $data = [
                    'medicaments'=>Medicament::where( 'disponibleRayon', 0 )
                            ->where( 'stock', 0)
                            ->latest()->paginate( 5 )
                ];
            }


            if ($stockDisponibilite=='stockDisponible') {
                $data = [
                    'medicaments'=>Medicament::where( 'stock','>',0 )
                            ->latest()->paginate( 5 )
                ];
            }

            if ($stockDisponibilite=='disponibleRayon') {
                $data = [
                    'medicaments'=>Medicament::where( 'disponibleRayon','>',0 )
                            ->latest()->paginate( 5 )
                ];
            }

            if ($stockDisponibilite=='stockDispoAndDispoRayon') {
                $data = [
                    'medicaments'=>Medicament::where( 'disponibleRayon','>',0 )
                            ->where( 'stock','>',0)
                            ->latest()->paginate( 5 )
                ];
            }
            
            
            
        }
        
        return view( 'livewire.user.pharmacie.index', $data )
        ->extends( 'layouts.template' )
        ->section( 'content' );
    }

    public function messages() {
        
        return [
            'medicament.nomMedicament.required' => 'Le nom du medicament est requis',
            'medicament.nomMedicament.unique' => 'Le nom du medicament existe deja',
            'medicament.stock.required' => 'Le stock est requis',
            'medicament.stock.numeric' => 'Le stock doit etre un nombre',
            'medicament.stock.min' => 'Le stock doit etre une quantitée superieur à 0',
            'medicament.disponibleRayon.numeric' => 'Disponible en rayon doit etre un nombre',
            'medicament.disponibleRayon.min' => 'Disponible en rayon doit etre une quantitée superieur à 0',
        ];
    }

    public function rules() {
        if ($this->isEditMedicament == true) {
            return [
                'medicament.nomMedicament' => ['required','min:2',Rule::unique("medicaments", "nomMedicament")->ignore($this->infoMedicament->id)],
                'medicament.stock' => 'required|numeric|min:0',
                'medicament.disponibleRayon' => 'numeric|min:0'
            ];
        } else {
            return [
                'medicament.nomMedicament' => 'required|min:2|unique:medicaments,nomMedicament',
                'medicament.stock' => 'required|numeric|min:0',
                'medicament.disponibleRayon' => 'numeric|min:0'
            ];
        }
        
        

    }


    //Affiche le formulaire d'ajout d'un nouveau medicament
    public function showAddMedicamentForm(){
        
        $this->isAddMedicament = true;
        $this->isEditMedicament = false;
        $this->resetErrorBag();
    }

    //ferme le formulaire d'ajout d'un nouveau medicament
    public function hideAddMedicamentForm(){
       
        $this->resetErrorBag();
        $this->medicament = [];
        $this->isEditMedicament = false;
        $this->isAddMedicament = false;

    }

    //Affiche le formulaire pour l'ajout d'un nouveau stock
    public function showEditMedicamentForm(Medicament $newStock){
        $this->isEditMedicament = true;
        $this->isAddMedicament = true;
        $this->infoMedicament = $newStock;
        $this->resetErrorBag();
        $this->medicament['nomMedicament'] = $newStock->nomMedicament;
        $this->medicament['stock'] = $newStock->stock;
        $this->medicament['disponibleRayon'] = $newStock->disponibleRayon;
       
    }

    //Enregistrer l'ajout d'un nouveau medicament
    public function addMedicament(){
        if ( $this->validate() ){
            $newMedicament = new Medicament();
            $newMedicament->nomMedicament = $this->medicament['nomMedicament'];
            $newMedicament->stock = $this->medicament['stock'];
            $newMedicament->disponibleRayon = $this->medicament['disponibleRayon'];
            $newMedicament->user_id = auth()->user()->id;
            $newMedicament->save();
            $this->resetErrorBag();
            $this->dispatch( 'showSuccessMessage', message: [ 'message'=>'Nouveau medicament ajouté avec succès !', 'type'=>'success' ] );
            $this->medicament = [];
            $this->isAddMedicament = false;
        }
    }

    //Enregistrer l'ajout d'un nouveau stock
    public function addNewStock(){
        if ( $this->validate() ){
            $this->infoMedicament->nomMedicament = $this->medicament['nomMedicament'];
            $this->infoMedicament->stock = $this->medicament['stock'];
            $this->infoMedicament->disponibleRayon = $this->medicament['disponibleRayon'];
            $this->infoMedicament->update();
            $this->resetErrorBag();
            $this->dispatch( 'showSuccessMessage', message: [ 'message'=>'Stock ajouté avec succès !', 'type'=>'success' ] );
            $this->medicament = [];
            $this->isEditMedicament = false;
            $this->isAddMedicament = false;
        }
    }
    
    public function confirmeDelete($nomMedicament,$id){
        $this->dispatch("showConfirmMessage", message: [
            'message'=>"Vous etes sur le point de supprimer $nomMedicament de la liste des medicaments. Voulez-vous contiues?",
            'id'=>$id
        ]);
    }

    /** Supprimer un medicament */
    public function deleteMedicament($id){
        Medicament::destroy($id);
        $this->dispatch("showSuccessMessage", message: [
            'message'=>"Medicament supprimé avec succes",
            'type'=>'success'
        ]);
    }


    public function generatePDF()
    {
        // Exemple de contenu HTML pour le PDF
  
        $stockDisponibilite=$this->disponibilite;
        

        if ($stockDisponibilite == '') {
            $medicaments = Medicament::get();
            $titre = "Liste des medicaments";
        } else {
            if ($stockDisponibilite=='stockRupture') {
                $medicaments =Medicament::where( 'stock', 0 )->get();
                $titre = "Liste des medicaments en rupture de stock";
            }
            if ($stockDisponibilite=='ruptureRayon') {
                $medicaments =Medicament::where( 'disponibleRayon', 0 )->get();
                $titre = "Liste des medicaments en rupture en rayon";
            } 
            if ($stockDisponibilite=='stockRuptureAndRuptureRayon') {
                $medicaments =Medicament::where( 'disponibleRayon', 0 )
                                        ->where( 'stock', 0)
                                        ->get();
                $titre = "Liste des medicaments en rupture de stock et en rayon";
            }


            if ($stockDisponibilite=='stockDisponible') {
                $medicaments =Medicament::where( 'stock','>',0 )->get();
                $titre = "Liste des medicaments disponible en stock";
            }

            if ($stockDisponibilite=='disponibleRayon') {
                $medicaments =Medicament::where( 'disponibleRayon','>',0 )->get();
                $titre = "Liste des medicaments disponible en rayon";
            }

            if ($stockDisponibilite=='stockDispoAndDispoRayon') {
                $medicaments =Medicament::where( 'disponibleRayon','>',0 )->get();
                $titre = "Liste des medicaments disponible en stock et en rayon";
            }
                
        }

        $content = view('livewire.user.pharmacie.fiche-rapport',compact("medicaments","titre"))->render();
        
        // Créer une instance de HTML2PDF
        $html2pdf = new Html2Pdf();
        
        //$html2pdf->pdf->setFooter('|Page {PAGENO} of {nb}|');
        // Charger le contenu HTML
        $html2pdf->writeHTML($content);
        
        /*
        // Générer et télécharger le PDF
        return response()->streamDownload(function() use ($html2pdf) {
            $html2pdf->output();
        }, 'document.pdf');
        */

        // Générer le contenu du PDF et le stocker dans $pdfContent
        $this->pdfContent = base64_encode($html2pdf->output('', 'S'));
        $this->dispatch( 'generatePdf', pdf: $this->pdfContent );

    }

}
