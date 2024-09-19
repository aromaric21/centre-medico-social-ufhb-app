<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Controle;
use App\Models\Consultation;
use Livewire\WithPagination;
use Spipu\Html2Pdf\Html2Pdf;

class HistoriqueControle extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $currentPage = PAGELISTCONSULTATION;
    public $date="";
    public $pdfContent="";
    public $fille="";
    public $controle;
    public Consultation $consultation;

    public function render()
    {

        $controles = $this->consultation->controles()->latest()->paginate( 5 );
        $controles->onEachSide(1);

        $data = [
            'controles'=>$controles
        ];
        return view('livewire.user.historique.controle.index',$data )
                    ->extends("layouts.template")
                    ->section("content");
    }

    
    public function detailControle( Controle $controle ) {
        //$this->newPatient = Patient::find( $id )->toArray();
        //dd($consultation->examenComplementaires->where('examen','Biologique')->all());
        $this->controle = $controle;
       // $this->consultation = Consultation::latest()->where( 'patient_id', $id )->first();

        $this->currentPage = PAGEDETAILCONSULTATION;
    }

    public function listeControle() {
        $this->currentPage = PAGELISTCONSULTATION;
    }


    public function generatePDF()
    {
        // Exemple de contenu HTML pour le PDF


        $consultation = $this->consultation;
        $controle = $this->controle;
  

        $content = view('livewire.user.historique.controle.fiche-medicale',compact("consultation","controle"))->render();
        
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
