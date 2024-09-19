<?php

namespace App\Livewire;

use App\Models\Consultation;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;
use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Support\Facades\Storage;

class HistoriqueConsultation extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $currentPage = PAGELISTCONSULTATION;
    public $date="";
    public $consultation;
    public Patient $patient;
    public $pdfContent="";
    public $fille="";
    
    
    public function render()
    {
    
        //dump( $this->search );
        $consultations = $this->patient->consultations()->latest()->paginate( 5 );
        $consultations->onEachSide(1);
        $data = [
            'consultations'=>$consultations
        ];
        return view('livewire.user.historique.consultation.index',$data )
                    ->extends("layouts.template")
                    ->section("content");
    }



    public function detailConsultation( Consultation $consultation ) {
        //$this->newPatient = Patient::find( $id )->toArray();
        //dd($consultation->examenComplementaires->where('examen','Biologique')->all());
        $this->consultation = $consultation;
       // $this->consultation = Consultation::latest()->where( 'patient_id', $id )->first();

        $this->currentPage = PAGEDETAILCONSULTATION;
    }

    public function listeConsultation() {
        $this->currentPage = PAGELISTCONSULTATION;
    }


    public function generatePDF()
    {
        // Exemple de contenu HTML pour le PDF


        $consultation = $this->consultation;
  

        $content = view('livewire.user.historique.consultation.fiche-medicale',compact("consultation"))->render();
        
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
