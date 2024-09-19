<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Caisse;
use Livewire\Component;
use Spipu\Html2Pdf\Html2Pdf;

class BilanCaisse extends Component
{

    public $dateDebut;
    public $dateFin;
    public $periode;
    public $pdfContent="";

    public function render() {

        $depense= new Caisse();
       //dd(now()->startOfMonth()->toDateString()." 00:00:00");
        Carbon::setLocale("fr");
        //dd(Carbon::now()->translatedFormat('F'));
        if($this->dateFin==null && $this->dateDebut==null){
            $this->periode = "Mois de ".now()->translatedFormat('F');
        }else {
            $this->periode = "Du ".dateTime(explode(" ",$this->dateDebut)[0])." au ".dateTime(explode(" ",$this->dateFin)[0]);
        }

        if($this->dateDebut==null){
            $this->dateDebut = now()->startOfMonth()->toDateString()." 00:00:00";
        }

        if($this->dateFin==null){
            $this->dateFin = now()->toDateString()." 23:59:59";
        }
            
        $data = [
            'pharmacie'=>$depense->bilanCaisse('pharmacie',$this->dateDebut,$this->dateFin),
            'cabinetDentaire'=>$depense->bilanCaisse('dentaire',$this->dateDebut,$this->dateFin),
            'ophtalmologie'=>$depense->bilanCaisse('ophtalmologie',$this->dateDebut,$this->dateFin),
            'infirmerie'=>$depense->bilanCaisse('infirmerie',$this->dateDebut,$this->dateFin),
            'laboratoire'=>$depense->bilanCaisse('biologie',$this->dateDebut,$this->dateFin),
            'periode'=>$this->periode,
        ];
        
        return view( 'livewire.user.bilan.caisse.index', $data )
        ->extends( 'layouts.template' )
        ->section( 'content' );
    }



    public function generatePDF()
    {
        // Exemple de contenu HTML pour le PDF
        $depense= new Caisse();
        $pharmacie=$depense->bilanCaisse('pharmacie',$this->dateDebut,$this->dateFin);
        $cabinetDentaire=$depense->bilanCaisse('dentaire',$this->dateDebut,$this->dateFin);
        $ophtalmologie=$depense->bilanCaisse('ophtalmologie',$this->dateDebut,$this->dateFin);
        $infirmerie=$depense->bilanCaisse('infirmerie',$this->dateDebut,$this->dateFin);
        $laboratoire=$depense->bilanCaisse('biologie',$this->dateDebut,$this->dateFin);
        $periode=$this->periode;
        

        $content = view('livewire.user.bilan.caisse.bilan',compact(
            'pharmacie',
            'cabinetDentaire',
            'ophtalmologie',
            'infirmerie',
            'laboratoire',
            'periode'
        ))->render();
        
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
