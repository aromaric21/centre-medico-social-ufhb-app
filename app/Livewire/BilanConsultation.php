<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Soins;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Controle;
use App\Models\Antecedent;
use App\Models\Pathologie;
use App\Models\Consultation;
use Spipu\Html2Pdf\Html2Pdf;
use App\Models\ExamenPhysique;
use App\Models\TraitementDentaire;
use App\Models\ExamenComplementaire;
use App\Models\Role;

class BilanConsultation extends Component
{
    
    public $professions = ['Personnel','Etudiant','Autre'];
    public $trancheAges = ['0-4 Ans','5-9 Ans','10-14 Ans','15-19 Ans','20-24 Ans','25-49 Ans','50 Ans et plus'];
    public $sexes = ['Masculin','Féminin'];
    public $examenComplementairesArray = ['Biologique','Radio','Ophtalmologie','Odonto'];
    public $dateDebut;
    public $dateFin;
    public $date;
    public $periode;
    public $rechercheSecretaire="tous";
    
    

    
    public function render()
    {
        Carbon::setLocale("fr");
        //dd(Carbon::now()->translatedFormat('F'));
        if($this->dateFin==null && $this->dateDebut==null){
            $this->periode = "Mois de ".now()->translatedFormat('F');
        }else {
            $this->periode = "Du ".dateTime($this->dateDebut)." au ".dateTime($this->dateFin);
        }

        if($this->dateDebut==null){
            $this->dateDebut = now()->startOfMonth()->toDateString();
        }

        if($this->dateFin==null){
            $this->dateFin = now()->toDateString();
        }
       
        if (getRoleServiceName()=="Secrétariat") {
            $secretaireRecherche=$this->rechercheSecretaire;
        } else {
            $secretaireRecherche=getRoleServiceName();
        }
        
        
        
        $data = [
            'patient'=>new Patient(),
            'consultation'=>new Consultation(),
            'controle'=>new Controle(),
            'pathologie'=>new Pathologie(),
            'antecedent'=>new Antecedent(),
            'soins'=>new Soins(),
            'examenComplementaires'=>new ExamenComplementaire(),
            'examenPhysique' => new ExamenPhysique(),
            'professions'=>$this->professions,
            'trancheAges'=>$this->trancheAges,
            'traitement' => new TraitementDentaire(),
            'debutDate'=>$this->dateDebut,
            'finDate'=>$this->dateFin,
            'periode'=>$this->periode,
            'roles'=>new Role(),
            'secretaireRecherche'=>$secretaireRecherche,
            'examenComplementairesArray'=>$this->examenComplementairesArray,
            'sexes'=>$this->sexes
        ];
        
        return view( 'livewire.user.bilan.consultation.index', $data)
                ->extends( 'layouts.template' )
                ->section( 'content' );
    }



    public function generatePDF()
    {
        
        $consultation = new Consultation();
        $controle = new Controle();
        $pathologie = new Pathologie();
        $antecedent = new Antecedent();
        $soins=new Soins();
        $patient = new Patient();
        $examenComplementaires = new ExamenComplementaire();
        $examenPhysique = new ExamenPhysique();
        $traitement = new TraitementDentaire();
        $professions = $this->professions;
        $trancheAges = $this->trancheAges;
        $debutDate = $this->dateDebut;
        $finDate = $this->dateFin;
        $periode = $this->periode;
        $examenComplementairesArray = $this->examenComplementairesArray;
        $sexes = $this->sexes;

        if (getRoleServiceName()=="Secrétariat") {
            $secretaireRecherche=$this->rechercheSecretaire;
        } else {
            $secretaireRecherche=getRoleServiceName();
        }
  

        $content = view('livewire.user.bilan.consultation.bilan',compact(
            'consultation',
            'controle',
            'pathologie',
            'antecedent',
            'soins',
            'patient',
            'examenComplementaires',
            'examenPhysique',
            'traitement',
            'professions',
            'trancheAges',
            'secretaireRecherche',
            'debutDate',
            'finDate',
            'periode',
            'examenComplementairesArray',
            'sexes'
        ))->render();
        
        // Créer une instance de HTML2PDF
        $html2pdf = new Html2Pdf('L', 'A4', 'fr');
        
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

