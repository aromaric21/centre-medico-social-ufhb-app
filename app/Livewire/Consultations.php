<?php

namespace App\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Soins;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Controle;
use App\Models\Antecedent;
use App\Models\Pathologie;
use App\Models\Consultation;
use Livewire\WithPagination;
use App\Models\ExamenPhysique;
use Illuminate\Validation\Rule;
use App\Models\TraitementDentaire;
use App\Models\ExamenComplementaire;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Consultations extends Component
{

    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $currentPage = PAGELISTPATIENT;
    public $currentModal = true;
    public $choixExamenComplementaie = true;

    public $search = '';
    public $newPatientExamenEndobuccal = '';
    public $separatorExamenEndobuccal = '';
    public $infoPatient;
    public $lastInfoConsultationPatient;
    public $newPatientExamensPhysiques = [];
    public $newPatientSoins = [];
    public $newPatientAutresSoins;
    public $updateProfil = [];
    public $autrePathologie = [];
    public $newPatientTraitementDentaireChecks = [];
    public $newPatient = [];
    public $newPatientAntecedent = [];
    public $newPatientConsultation = [];
    public $newPatientPathologies = [];
    public $newPatientExamenRadiologie = [];
    public $newPatientExamenOphtalmologie = [];
    public $newPatientExamenOdonto = [];
    public $newPatientExamenBiologiques = [];
    public $controle = [];

    public $newPatientTraitementDentaire = [];
    public $newPatientTypeExamenComplementaireImage = [];
    
    
    public $newPatientTypeExamenPhysiqueImageLibelle;
    public $newPatientTypeExamenPhysiqueImage = null;
    public $typeExamenComplementaireImage = null;

    public $suitExamenPhysiqueImage = null;
    public $suitExamenComplementaireImage = null;




    public $examenComplementaires = [
        'nfs' => 'NFS',
        'goutteEpaisse' => 'Goutte épaisse',
        'crp' => 'CRP',
        'widal' => 'WIDAL',
        'uree' => 'Urée',
        'glycemie' => 'Glycémie',
        'transa' => 'Transa',
        'ecdu' => 'ECDU',
        'autreExamenBiologie' => 'Autres',
        'retroAlveolaire' => 'Rétro-alvéolaire',
        'panneauDentaire' => 'Panneau dentaire',
        'radioDentaire' => 'Radio',
        'autreExamendentaires' => 'Autres',
        'radieOeil' => "Radio d'oeil",
        'champVisuel' => 'Champ visuel',
        'fondOeil' => "Fond d'oeil",
        'autreExamenOphtalmologie' => 'Autres',
        'pulmonaire' => 'Pulmonaire',
        'scanner' => 'Scanner',
        'irl' => 'IRL',
        'asp' => 'ASP',
        'abdominale' => 'Echo Abdominale',
        'pelvienne' => 'Echo Pelvienne',
        'autreExamenRadio' => 'Autres'
    ];

    public $keyExamenComplementaires = [
        'nfs',
        'goutteEpaisse',
        'crp',
        'widal',
        'uree',
        'glycemie',
        'transa',
        'ecdu',
        'autreExamenBiologie',
        'retroAlveolaire',
        'panneauDentaire',
        'radioDentaire',
        'autreExamendentaires',
        'radieOeil',
        'champVisuel',
        'fondOeil',
        'autreExamenOphtalmologie',
        'pulmonaire',
        'scanner',
        'irl',
        'asp',
        'abdominale',
        'pelvienne',
        'autreExamenRadio'
    ];

    public $examensPhysiques = [
        'examenEndobuccalC' => 'C',
        'examenEndobuccalA' => 'A',
        'examenEndobuccalO' => 'O',
        'hbd' => 'HBD',
        'autresExamensPhysiques' => 'Autres',
    ];

    public $keyExamensPhysiques = [
        'examenEndobuccalC',
        'examenEndobuccalA',
        'examenEndobuccalO',
        'hbd',
        'autresExamensPhysiques'
    ];

    public $traitementDentaires = [
        'extraction' => 'Extraction',
        'oce' => 'OCE',
        'paradontales' => 'Traitements paradontales',
        'prothetique' => 'Prothétique',
        'traitementsAutres' => 'Autres',
    ];

    public $keytraitementDentaires = [
        'extraction',
        'oce',
        'paradontales',
        'prothetique',
        'traitementsAutres',
    ];

    public $pathologieDentaires = [
        'affectionCarieuse' => 'Affection carieuse',
        'maladieParadontale' => 'Maladie paradontale',
        'autresDiagnostic' => 'Autres'
    ];


    public $examenBiologies = [
        'nfs' => 'NFS',
        'goutteEpaisse' => 'Goutte épaisse',
        'crp' => 'CRP',
        'widal' => 'WIDAL',
        'uree' => 'Urée',
        'glycemie' => 'Glycémie',
        'transa' => 'Transa',
        'ecdu' => 'ECDU',
        'autreExamenBiologie' => 'Autres'
    ];

    public $examenRadios = [
        'pulmonaire' => 'Pulmonaire',
        'scanner' => 'Scanner',
        'irl' => 'IRL',
        'asp' => 'ASP',
        'abdominale' => 'Echo Abdominale',
        'pelvienne' => 'Echo Pelvienne',
        'autreExamenRadio' => 'Autres'
    ];
    public $examenOphtalmos = [
        'radieOeil' => "Radio d'oeil",
        'champVisuel' => 'Champ visuel',
        'fondOeil' => "Fond d'oeil",
        'autreExamenOphtalmologie' => 'Autres'
    ];
    public $examenOdontos = [
        'retroAlveolaire' => 'Rétro-alvéolaire',
        'panneauDentaire' => 'Panneau dentaire',
        'autreExamendentaires' => 'Autres'
    ];


    public $listeSoins = [
        'Pansement',
        'Persufion',
        'Injection'
    ];

    public function messages()
    {
        if ($this->currentPage == PAGENEWPATIENT || $this->currentPage == PAGESUITECONSULTATIONFORM) {
            return [
                'newPatient.nomPrenom.required' => 'le nom et le prenom sont requis',
                'newPatientConsultation.dateConsultation.required' => 'La date consultation est requis',
                'newPatientConsultation.dateConsultation.date' => 'La date consultation doit etre en format AAAA-mm-jj',
                'newPatient.sexe.required' => 'Le sexe est requis',
                'newPatientConsultation.age.required' => "L'age est requis",
                'newPatientConsultation.profession.required' => 'La profession est requise',
                'newPatientTypeExamenPhysiqueImage.file' => 'Le fichier doit etre en pdf, jpeg, png, jpg',
                'typeExamenComplementaireImage.file' => 'Le fichier doit etre en pdf, jpeg, png, jpg',
                'newPatientTypeExamenPhysiqueImage.max' => 'La taille du fichier doit etre de 10MB au maximum',
                'typeExamenComplementaireImage.max' => 'La taille du fichier doit etre de 10MB au maximum',
            ];
        }

        if ($this->currentPage == PAGEEXPATIENTFORM) {
            return [
                'newPatientConsultation.dateConsultation.required' => 'La date consultation est requis',
                'newPatientConsultation.dateConsultation.date' => 'La date consultation doit etre en format AAAA-mm-jj',
                'newPatientConsultation.age.required' => "L'age est requis",
                'newPatientConsultation.profession.required' => 'La profession est requise',
                'newPatientTypeExamenPhysiqueImage.file' => 'Le fichier doit etre en pdf, jpeg, png, jpg',
                'typeExamenComplementaireImage.file' => 'Le fichier doit etre en pdf, jpeg, png, jpg',
                'newPatientTypeExamenPhysiqueImage.max' => 'La taille du fichier doit etre de 10MB au maximum',
                'typeExamenComplementaireImage.max' => 'La taille du fichier doit etre de 10MB au maximum',
            ];
        }

        if ($this->currentPage == PAGELISTPATIENT) {
            if ($this->currentModal) {
                return [
                    'controle.etatSante.required' => "L'etat de sante est requis",
                    'controle.observation.required' => "L'observation est requise",
                    'controle.dateControle.required' => 'La date est requise',
                    'controle.dateControle.date' => 'La date doit etre en format AAAA-mm-jj',
                ];
            } else {
                return [
                    'updateProfil.nomPrenom.required' => 'le nom et le prenom sont requis',
                    'updateProfil.sexe.required' => 'Le sexe est requis',
                    'updateProfil.profession.required' => 'La profession est requise',
                    'updateProfil.age.required' => "L'age est requis",
                ];
            }
        }
    }

    public function rules()
    {

        if ($this->currentPage == PAGENEWPATIENT || $this->currentPage == PAGESUITECONSULTATIONFORM) {

            $rulesArray = [
                'newPatient.nomPrenom' => 'required|min:4',
                'newPatientConsultation.dateConsultation' => 'required|date',
                'newPatient.sexe' => 'required',
                'newPatientConsultation.age' => 'required',
                'newPatientConsultation.profession' => 'required'
            ];
            if ($this->typeExamenComplementaireImage !== null) {
                $rulesArray= ['typeExamenComplementaireImage' => 'file:pdf,jpeg,png,jpg|max:10240'];
                
            } 
            if($this->newPatientTypeExamenPhysiqueImage !== null){
                $rulesArray= ['newPatientTypeExamenPhysiqueImage' => 'file:pdf,jpeg,png,jpg|max:10240'];
            }


            return $rulesArray;
            
        }

        if ($this->currentPage == PAGEEXPATIENTFORM) {

            $rulesArray = [
                'newPatientConsultation.dateConsultation' => 'required|date',
                'newPatientConsultation.age' => 'required',
                'newPatientConsultation.profession' => 'required'
            ];

            if ($this->typeExamenComplementaireImage !== null) {
                $rulesArray= ['newPatientTypeExamenPhysiqueImage' => 'file:pdf,jpeg,png,jpg|max:10240'];
            }
            if ($this->newPatientTypeExamenPhysiqueImage !== null) {
                $rulesArray= ['newPatientTypeExamenPhysiqueImage' => 'file:pdf,jpeg,png,jpg|max:10240'];
            }

            return $rulesArray;
        }

        if ($this->currentPage == PAGELISTPATIENT) {
            if ($this->currentModal) {
                return [
                    'controle.etatSante' => 'required',
                    'controle.observation' => 'required',
                    'controle.dateControle' => 'required|date'
                ];
            } else {
                return [
                    'updateProfil.nomPrenom' => 'required',
                    'updateProfil.sexe' => 'required',
                    'updateProfil.age' => 'required',
                    'updateProfil.profession' => 'required'
                ];
            }
        }
    }


    public function render()
    {

        $searchCriteria = '%' . $this->search . '%';
        //dump( $this->search );
        $patients = Patient::where('nomPrenom', 'like', $searchCriteria)
                ->orWhere('numeroFiche', 'like', $searchCriteria)
                ->latest()->paginate(5);
        $patients->onEachSide(1);
        $data = [
            'patients' => $patients,
            'examenBiologies' => $this->examenBiologies,
            'examenRadios' => $this->examenRadios,
            'examenOphtalmos' => $this->examenOphtalmos,
            'examenOdontos' => $this->examenOdontos
        ];
        return view('livewire.user.consultation.index', $data)
            ->extends('layouts.template')
            ->section('content');
    }


    public function goToNewPatient()
    {
        $this->currentPage = PAGENEWPATIENT;
    }

    public function goToExPatient($id)
    {
        $this->newPatient = Patient::find($id)->toArray();
        $consultation = Consultation::latest()->where('patient_id', $id)->first();
        $this->newPatientConsultation['assure'] = $consultation->assure;
        $this->newPatientConsultation['age'] = $consultation->age;
        $this->newPatientConsultation['profession'] = $consultation->profession;
        $this->newPatientConsultation['contact'] = $consultation->contact;
        $this->newPatientConsultation['residence'] = $consultation->residence;

        $this->currentPage = PAGEEXPATIENTFORM;
    }

    public function goToSuiteConsultation($id)
    {
        $this->newPatient = Patient::find($id)->toArray();
        $consultation = Consultation::latest()->where(['patient_id' => $id, 'service' => getRoleServiceName()])->first();

        if (!empty($consultation)) {
            $this->newPatientConsultation = $consultation->toArray();
            //examens Physiques
            foreach ($consultation->examenPhysiques->all() as $listeExamenPhysiques) {

                if ($listeExamenPhysiques->imageUrl !== null) {
                    
                    $this->suitExamenPhysiqueImage = $listeExamenPhysiques->imageUrl;
                    $this->newPatientTypeExamenPhysiqueImageLibelle = $listeExamenPhysiques->libelleExamenPhysique;
                }else{

                    if ($listeExamenPhysiques->typeExamenPhysique == 'Autres' || $listeExamenPhysiques->typeExamenPhysique == null) {
                        $this->newPatientExamensPhysiques['autresExamensPhysiques'] = $listeExamenPhysiques->libelleExamenPhysique;
                    }

                    if ($listeExamenPhysiques->typeExamenPhysique == 'Examen exobuccal') {
                        $this->newPatientExamensPhysiques['examenExobuccal'] = $listeExamenPhysiques->libelleExamenPhysique;
                    }

                    if ($listeExamenPhysiques->typeExamenPhysique == 'HBD') {
                        $this->newPatientExamensPhysiques['hbd'] = $listeExamenPhysiques->libelleExamenPhysique;
                    }

                    if ($listeExamenPhysiques->typeExamenPhysique == 'Examen endobuccal') {
                        $newPatientExamenEndobuccal = explode('/', $listeExamenPhysiques->libelleExamenPhysique);
                        foreach ($newPatientExamenEndobuccal as $examenEndobuccal) {
                            if (explode(': ', $examenEndobuccal)[0] == 'C') {
                                $this->newPatientExamensPhysiques['examenEndobuccalC'] = explode(': ', $examenEndobuccal)[1];
                            }
                            if (explode(': ', $examenEndobuccal)[0] == 'A') {
                                $this->newPatientExamensPhysiques['examenEndobuccalA'] = explode(': ', $examenEndobuccal)[1];
                            }
                            if (explode(': ', $examenEndobuccal)[0] == 'O') {
                                $this->newPatientExamensPhysiques['examenEndobuccalO'] = explode(': ', $examenEndobuccal)[1];
                            }
                        }
                
                    }

                }
                
            }


            //antecedents
            foreach ($consultation->antecedents->all() as $antecedent) {

                if ($antecedent->typeAntecedent == 'Medicaux') {
                    $this->newPatientAntecedent['antecedentMedicaux'] = $antecedent->antecedent;
                }
                if ($antecedent->typeAntecedent == 'Chirurgicaux') {
                    $this->newPatientAntecedent['antecedentChirurgicaux'] = $antecedent->antecedent;
                }

                if ($antecedent->typeAntecedent == 'Gyneco-Obsterique') {
                    $this->newPatientAntecedent['antecedentGynecoObsterique'] = $antecedent->antecedent;
                }
            }

            //pathologies
            foreach ($consultation->pathologies->all() as $key => $pathologie) {


                if (in_array($pathologie->typePathologie, ['Affection carieuse', 'Maladie paradontale', 'Autres'])) {

                    foreach ($this->pathologieDentaires as $key => $listPathologieDentaires) {
                        if ($pathologie->typePathologie == $listPathologieDentaires) {
                            $this->newPatientPathologies[$key] = $pathologie->pathologie;
                            $this->autrePathologie = $pathologie->pathologie;
                        }
                    }
                } else {
                    $this->newPatientPathologies[$key] = $pathologie->pathologie;
                }
            }

            //examens Complementaires
            foreach ($consultation->examenComplementaires->all() as $examen) {

                if ($examen->imageUrl !== null) {
                    $this->newPatientTypeExamenComplementaireImage["examen"]=$examen->examen;
                    $this->newPatientTypeExamenComplementaireImage["libelle"]=$examen->libelleExamenComplementaire;
                    $this->suitExamenComplementaireImage = $examen->imageUrl;
                } else {
                   
               
                
                    if ($examen->examen == 'Ophtalmologie') {
                        foreach ($this->examenComplementaires as $key => $examenComplementaire) {
                            if ($examen->typeExamen == $examenComplementaire) {
                                $this->newPatientExamenOphtalmologie[$key] = $examen->libelleExamenComplementaire;
                            }
                        }
                    }
    
                    if ($examen->examen == 'Radio') {
                        foreach ($this->examenComplementaires as $key => $examenComplementaire) {
                            if ($examen->typeExamen == $examenComplementaire) {
                                $this->newPatientExamenRadiologie[$key] = $examen->libelleExamenComplementaire;
                            }
                        }
                    }
    
                    if ($examen->examen == 'Biologique') {
                        foreach ($this->examenComplementaires as $key => $examenComplementaire) {
                            if ($examen->typeExamen == $examenComplementaire) {
                                $this->newPatientExamenBiologiques[$key] = $examen->libelleExamenComplementaire;
                            }
                        }
                    }
    
                    if ($examen->examen == 'Odonto') {
                        foreach ($this->examenComplementaires as $key => $examenComplementaire) {
                            if ($examen->typeExamen == $examenComplementaire) {
                                $this->newPatientExamenOdonto[$key] = $examen->libelleExamenComplementaire;
                            }
                        }
                    }
                }

                
            }


            //Traitement Dentaire
            foreach ($consultation->traitementDentaires->all() as $key => $traitementDentaire) {


                if ($traitementDentaire->typeTraitement !== 'Détartrage' &&  $traitementDentaire->typeTraitement !== 'Surfaçage radiculaire') {
                    foreach ($this->traitementDentaires as $key => $listeTraitementDentaire) {
                        if ($traitementDentaire->typeTraitement == $listeTraitementDentaire) {
                            $this->newPatientTraitementDentaire[$key] = $traitementDentaire->libelle;
                        }
                    }
                } else {
                    $this->newPatientTraitementDentaireChecks[$key] = $traitementDentaire->libelle;
                }
            }

            //soins
            foreach ($consultation->soins->all() as $key => $soins) {
                if (in_array($soins->soins, $this->listeSoins)) {

                    $this->newPatientSoins[$key] = $soins->soins;
                } else {
                    $this->newPatientAutresSoins = $soins->soins;
                }
            }




            $this->currentPage = PAGESUITECONSULTATIONFORM;
        } else {
            $this->currentPage = PAGELISTPATIENT;
        }
    }

    public function goToListePatient()
    {

        $this->newPatientTraitementDentaire = [];
        $this->newPatientExamensPhysiques = [];
        $this->autrePathologie = [];
        $this->newPatient = [];
        $this->newPatientAntecedent = [];
        $this->newPatientConsultation = [];
        $this->newPatientPathologies = [];
        $this->newPatientExamenRadiologie = [];
        $this->newPatientExamenOphtalmologie = [];
        $this->newPatientExamenOdonto = [];
        $this->newPatientExamenBiologiques = [];
        $this->newPatientSoins = [];
        $this->newPatientTraitementDentaireChecks = [];
        $this->newPatientAutresSoins = '';
        $this->newPatientExamenEndobuccal = '';
        $this->separatorExamenEndobuccal = '';

        $this->suitExamenPhysiqueImage = null;
        $this->newPatientTypeExamenPhysiqueImageLibelle = "";

        $this->newPatientTypeExamenComplementaireImage=[];
        $this->suitExamenComplementaireImage = null;
        
        $this->resetErrorBag();
        $this->currentPage = PAGELISTPATIENT;
        //$this->editUser = [];
    }

    /** Ajouter un nouvel utilisateur */

    public function addNewPatientConsultation()
    {
        //dd(empty($this->newPatientTypeExamenComplementaireImage["examen"]));

        if ($this->typeExamenComplementaireImage !== null) {
            if (!empty($this->newPatientTypeExamenComplementaireImage["examen"])) {
                $typeSelectionne = true;
            }else {
                $typeSelectionne = false;
            }
        }elseif (isset($this->newPatientTypeExamenComplementaireImage["examen"])) {
            
            if (empty($this->newPatientTypeExamenComplementaireImage["examen"])) {
                $typeSelectionne = true;
            }else {
                $typeSelectionne = false;
            }
        }else {
            $typeSelectionne = true;
        }
            //dd(isset($this->typeExamenDentaireImage["examen"]));
        if ($typeSelectionne == true) {
            $this->choixExamenComplementaie = true;
            //dump($this->newPatientConsultation.' '.$this->newPatientExamensPhysiques.' '.$this->newPatientTraitementDentaire.' '.$this->newPatientTraitementDentaireCheck.' '.$this->newPatientExamenOdonto );
            //dump($this->newPatientExamenOdonto);
            if ($this->validate()) {
                try {
                    if (Patient::create($this->newPatient)) {

                        $patient = Patient::latest('id')->where('nomPrenom', $this->newPatient['nomPrenom'])->first();

                        if (
                            isset($this->newPatientConsultation['tel']) && !empty(trim($this->newPatientConsultation['tel'])) &&
                            isset($this->newPatientConsultation['cel']) && !empty(trim($this->newPatientConsultation['cel']))
                        ) {
                            $this->newPatientConsultation['contact'] = $this->newPatientConsultation['tel'] . ' / ' . $this->newPatientConsultation['cel'];
                        } else if (isset($this->newPatientConsultation['tel']) && !empty(trim($this->newPatientConsultation['tel']))) {
                            $this->newPatientConsultation['contact'] = $this->newPatientConsultation['tel'];
                        } else if (isset($this->newPatientConsultation['cel']) && !empty(trim($this->newPatientConsultation['cel']))) {
                            $this->newPatientConsultation['contact'] = $this->newPatientConsultation['cel'];
                        }

                        if ($this->newPatientConsultation['age'] >= 0 && $this->newPatientConsultation['age'] <= 4) {
                            $trancheAge = '0-4 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 5 && $this->newPatientConsultation['age'] <= 9) {
                            $trancheAge = '5-9 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 10 && $this->newPatientConsultation['age'] <= 14) {
                            $trancheAge = '10-14 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 15 && $this->newPatientConsultation['age'] <= 19) {
                            $trancheAge = '15-19 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 20 && $this->newPatientConsultation['age'] <= 24) {
                            $trancheAge = '20-24 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 25 && $this->newPatientConsultation['age'] <= 49) {
                            $trancheAge = '25-49 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 50) {
                            $trancheAge = '50 Ans et plus';
                        }

                        $this->newPatientConsultation['trancheAge'] = $trancheAge;
                        $this->newPatientConsultation['user_id'] = auth()->user()->id;
                        $this->newPatientConsultation['patient_id'] = $patient->id;
                        $this->newPatientConsultation['service'] = getRoleServiceName();

                        //Consultation
                        if (Consultation::create($this->newPatientConsultation)) {
                            $consultation = Consultation::latest('id')->where([
                                'user_id' => auth()->user()->id,
                                'service' => getRoleServiceName(),
                                'patient_id' => $patient->id,
                                'trancheAge' => $trancheAge
                            ])->first();



                            // ***** Debut Examen Physique *****/
                            //Debut Examen Physique

                            if (isset($this->newPatientExamensPhysiques['examenExobuccal']) && !empty($this->newPatientExamensPhysiques['examenExobuccal'])) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamensPhysiques['examenExobuccal'];
                                $ExamenPhysique->typeExamenPhysique = 'Examen exobuccal';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                            }

                            if (isset($this->newPatientExamensPhysiques['hbd']) && !empty($this->newPatientExamensPhysiques['hbd'])) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamensPhysiques['hbd'];
                                $ExamenPhysique->typeExamenPhysique = 'HBD';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                            }

                            foreach ($this->newPatientExamensPhysiques as $key => $examen) {
                                //dump( $key );
                                if (in_array($key, ['examenEndobuccalC', 'examenEndobuccalA', 'examenEndobuccalO'])) {
                                    $this->newPatientExamenEndobuccal .= $this->separatorExamenEndobuccal . '' . $this->examensPhysiques[$key] . ': ' . $examen;
                                    $this->separatorExamenEndobuccal = '/';
                                }
                            }

                            if (isset($this->newPatientExamenEndobuccal) && $this->newPatientExamenEndobuccal != '') {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamenEndobuccal;
                                $ExamenPhysique->typeExamenPhysique = 'Examen endobuccal';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                                $this->separatorExamenEndobuccal = '';
                            }

                            if (isset($this->newPatientExamensPhysiques['autresExamensPhysiques']) && !empty($this->newPatientExamensPhysiques['autresExamensPhysiques'])) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamensPhysiques['autresExamensPhysiques'];
                                $ExamenPhysique->typeExamenPhysique = 'Autres';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                            }


                            //Examen image
                            if (isset($this->newPatientTypeExamenPhysiqueImage) && $this->newPatientTypeExamenPhysiqueImage !== null) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientTypeExamenPhysiqueImageLibelle;
                                $ExamenPhysique->typeExamenPhysique = 'Autres';
                                $ExamenPhysique->imageUrl = $this->newPatientTypeExamenPhysiqueImage->store('uploads', 'public');
                                //$ExamenPhysique->imageUrl = $this->newPatientTypeExamenPhysiqueImage["image"]->store('uploads', 'public');
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                                $this->newPatientTypeExamenPhysiqueImage = null;
                            }

                            //Fin Examen Physique
                            // ***** Fin Examen Physique *****/


                            //Antecedent
                            foreach ($this->newPatientAntecedent as $key => $antecedents) {
                                $antecedent = new Antecedent();
                                if ($key == 'antecedentMedicaux') {
                                    $antecedent->typeAntecedent = 'Medicaux';
                                }
                                if ($key == 'antecedentChirurgicaux') {
                                    $antecedent->typeAntecedent = 'Chirurgicaux';
                                }

                                if ($key == 'antecedentGynecoObsterique') {
                                    $antecedent->typeAntecedent = 'Gyneco-Obsterique';
                                }
                                $antecedent->antecedent = $antecedents;
                                $antecedent->consultation_id = $consultation->id;
                                $antecedent->save();
                            }


                            //*****Debut Examen complementaire****/

                            //Examen Radiologie
                            foreach ($this->newPatientExamenRadiologie as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Radio';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Ophtalmologie
                            foreach ($this->newPatientExamenOphtalmologie as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Ophtalmologie';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Odonto
                            foreach ($this->newPatientExamenOdonto as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Odonto';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Biologiques
                            foreach ($this->newPatientExamenBiologiques as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Biologique';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            if (isset($this->typeExamenComplementaireImage) && $this->typeExamenComplementaireImage !== null) {
                                $examenComplementaire = new ExamenComplementaire();
                                $examenComplementaire->libelleExamenComplementaire = isset($this->newPatientTypeExamenComplementaireImage["libelle"]) ? $this->newPatientTypeExamenComplementaireImage["libelle"] : "";
                                $examenComplementaire->typeExamen = "Autres";
                                $examenComplementaire->examen = isset($this->newPatientTypeExamenComplementaireImage["examen"]) ? $this->newPatientTypeExamenComplementaireImage["examen"] : "";
                                $examenComplementaire->imageUrl  = $this->typeExamenComplementaireImage->store('uploads', 'public');
                                $examenComplementaire->consultation_id  = $consultation->id;
                                $examenComplementaire->save();
                                $this->typeExamenComplementaireImage = null;
                                $this->newPatientTypeExamenComplementaireImage = [];
                            }

                        

                            // ***** Fin Examen complementaire *****/


                            //*****Debut Traitement Dentaire****/

                            //Traitement Dentaire newPatientTraitementDentaire
                            foreach ($this->newPatientTraitementDentaireChecks as $traitement) {
                                $traitementDentaire = new TraitementDentaire();
                                $traitementDentaire->libelle = $traitement;
                                $traitementDentaire->typeTraitement = $traitement;
                                $traitementDentaire->consultation_id = $consultation->id;
                                $traitementDentaire->save();
                            }

                            //Traitement Dentaire
                            foreach ($this->newPatientTraitementDentaire as $key => $examen) {
                                $traitementDentaire = new TraitementDentaire();
                                //dump( $key );
                                if (in_array($key, $this->keytraitementDentaires)) {
                                    $traitementDentaire->libelle = $examen;
                                    $traitementDentaire->typeTraitement = $this->traitementDentaires[$key];

                                    $traitementDentaire->consultation_id = $consultation->id;
                                    $traitementDentaire->save();
                                }
                            }

                            // ***** Fin Traitement Dentaire *****/

                            //Pathologie
                            foreach ($this->newPatientPathologies as $key => $pathologies) {

                                $pathologie = new Pathologie();
                                if (in_array($key, ['affectionCarieuse', 'maladieParadontale', 'autresDiagnostic'])) {
                                    $pathologie->pathologie = $pathologies;
                                    $pathologie->typePathologie = $this->pathologieDentaires[$key];
                                } else {
                                    $pathologie->pathologie = $pathologies;
                                    $pathologie->typePathologie = $pathologies;
                                }

                                $pathologie->consultation_id = $consultation->id;
                                $pathologie->save();
                            }

                            //autre Pathologie
                            if (isset($this->autrePathologie) && !empty($this->autrePathologie)) {
                                $pathologie = new Pathologie();
                                $pathologie->pathologie = $this->autrePathologie;
                                $pathologie->typePathologie = 'Autres';
                                $pathologie->consultation_id = $consultation->id;
                                $pathologie->save();
                            }




                            //*****Debut soins infirmier****/
                            //soins
                            foreach ($this->newPatientSoins as $patientSoins) {
                                $soins = new Soins();
                                $soins->soins = $patientSoins;
                                $soins->consultation_id = $consultation->id;
                                $soins->save();
                            }

                            //autre soins
                            if (isset($this->newPatientAutresSoins) && !empty($this->newPatientAutresSoins)) {
                                $soins = new Soins();
                                $soins->soins = $this->newPatientAutresSoins;
                                $soins->consultation_id = $consultation->id;
                                $soins->save();
                            }
                            // ***** Fin soins infirmier *****/

                            $this->dispatch('showSuccessMessage', message: ['message' => 'Consultation enregistrée avec succès !', 'type' => 'success']);
                        }
                    }
                } catch (Exception $e) {
                    dd($e);
                }
            }
        } else {
            $this->choixExamenComplementaie = false;
            $this->dispatch('showSuccessMessage', message: ['message' => "Veillez selectionner le type d'examen ou choisir un fichier !", 'type' => 'danger']);
        }
    }

    /** Ajouter un suite Consultation*/

    public function addSuiteConsultation()
    {
        

        if ($this->typeExamenComplementaireImage !== null || $this->suitExamenComplementaireImage !== null) {
            if (!empty($this->newPatientTypeExamenComplementaireImage["examen"])) {
                $typeSelectionne = true;
            }else {
                $typeSelectionne = false;
            }
        }elseif (isset($this->newPatientTypeExamenComplementaireImage["examen"])) {
            
            if (empty($this->newPatientTypeExamenComplementaireImage["examen"])) {
                $typeSelectionne = true;
            }else {
                $typeSelectionne = false;
            }
        }else {
            $typeSelectionne = true;
        }

        if ($typeSelectionne == true) {
            $this->choixExamenComplementaie = true;
            if ($this->validate()) {
                try {

                    if (Patient::find($this->newPatient['id'])->update($this->newPatient)) {

                        //$patient = Patient::latest( 'id' )->where( 'nomPrenom', $this->newPatient[ 'nomPrenom' ] )->first();
                        Consultation::destroy($this->newPatientConsultation['id']);
                        //dd( 'ok' );
                        //Pathologie::where( 'consultation_id', $this->newPatientConsultation[ 'id' ] )->delete();
                        // Antecedent::where( 'consultation_id', $this->newPatientConsultation[ 'id' ] )->delete();
                        // ExamenPhysique::where( 'consultation_id', $this->newPatientConsultation[ 'id' ] )->delete();
                        //ExamenComplementaire::where( 'consultation_id', $this->newPatientConsultation[ 'id' ] )->delete();

                        if ($this->newPatientConsultation['age'] >= 0 && $this->newPatientConsultation['age'] <= 4) {
                            $trancheAge = '0-4 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 5 && $this->newPatientConsultation['age'] <= 9) {
                            $trancheAge = '5-9 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 10 && $this->newPatientConsultation['age'] <= 14) {
                            $trancheAge = '10-14 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 15 && $this->newPatientConsultation['age'] <= 19) {
                            $trancheAge = '15-19 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 20 && $this->newPatientConsultation['age'] <= 24) {
                            $trancheAge = '20-24 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 25 && $this->newPatientConsultation['age'] <= 49) {
                            $trancheAge = '25-49 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 50) {
                            $trancheAge = '50 Ans et plus';
                        }

                        $this->newPatientConsultation['trancheAge'] = $trancheAge;
                        $this->newPatientConsultation['user_id'] = auth()->user()->id;
                        $this->newPatientConsultation['patient_id'] = $this->newPatient['id'];
                        $this->newPatientConsultation['service'] = getRoleServiceName();

                        //Consultation
                        //Consultation
                        if (Consultation::create($this->newPatientConsultation)) {
                            $consultation = Consultation::latest('id')->where([
                                'user_id' => auth()->user()->id,
                                'service' => getRoleServiceName(),
                                'patient_id' => $this->newPatient['id'],
                                'trancheAge' => $trancheAge
                            ])->first();



                            // ***** Debut Examen Physique *****/
                            //Debut Examen Physique
                            if (isset($this->newPatientExamensPhysiques['autresExamensPhysiques']) && !empty($this->newPatientExamensPhysiques['autresExamensPhysiques'])) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamensPhysiques['autresExamensPhysiques'];
                                $ExamenPhysique->typeExamenPhysique = 'Autres';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                            }

                            if (isset($this->newPatientExamensPhysiques['examenExobuccal']) && !empty($this->newPatientExamensPhysiques['examenExobuccal'])) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamensPhysiques['examenExobuccal'];
                                $ExamenPhysique->typeExamenPhysique = 'Examen exobuccal';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                            }

                            if (isset($this->newPatientExamensPhysiques['hbd']) && !empty($this->newPatientExamensPhysiques['hbd'])) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamensPhysiques['hbd'];
                                $ExamenPhysique->typeExamenPhysique = 'HBD';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                            }

                            foreach ($this->newPatientExamensPhysiques as $key => $examen) {
                                //dump( $key );
                                if (in_array($key, ['examenEndobuccalC', 'examenEndobuccalA', 'examenEndobuccalO'])) {
                                    $this->newPatientExamenEndobuccal .= $this->separatorExamenEndobuccal . '' . $this->examensPhysiques[$key] . ': ' . $examen;
                                    $this->separatorExamenEndobuccal = '/';
                                }
                            }

                            if (isset($this->newPatientExamenEndobuccal) && $this->newPatientExamenEndobuccal != '') {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamenEndobuccal;
                                $ExamenPhysique->typeExamenPhysique = 'Examen endobuccal';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                                $this->separatorExamenEndobuccal = '';
                            }

                            //Examen image
                            if (isset($this->newPatientTypeExamenPhysiqueImage) && $this->newPatientTypeExamenPhysiqueImage !== null) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientTypeExamenPhysiqueImageLibelle;
                                $ExamenPhysique->typeExamenPhysique = 'Autres';
                                $ExamenPhysique->imageUrl = $this->newPatientTypeExamenPhysiqueImage->store('uploads', 'public');
                                //$ExamenPhysique->imageUrl = $this->newPatientTypeExamenPhysiqueImage["image"]->store('uploads', 'public');
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                                $this->newPatientTypeExamenPhysiqueImage = null;
                            }elseif ($this->suitExamenPhysiqueImage !== null) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientTypeExamenPhysiqueImageLibelle;
                                $ExamenPhysique->typeExamenPhysique = 'Autres';
                                $ExamenPhysique->imageUrl = $this->suitExamenPhysiqueImage;
                                //$ExamenPhysique->imageUrl = $this->newPatientTypeExamenPhysiqueImage["image"]->store('uploads', 'public');
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                                $this->newPatientTypeExamenPhysiqueImage = null;
                                $this->suitExamenPhysiqueImage = null;
                            }
                            

                            //Fin Examen Physique
                            // ***** Fin Examen Physique *****/


                            //Antecedent
                            foreach ($this->newPatientAntecedent as $key => $antecedents) {
                                $antecedent = new Antecedent();
                                if ($key == 'antecedentMedicaux') {
                                    $antecedent->typeAntecedent = 'Medicaux';
                                }
                                if ($key == 'antecedentChirurgicaux') {
                                    $antecedent->typeAntecedent = 'Chirurgicaux';
                                }

                                if ($key == 'antecedentGynecoObsterique') {
                                    $antecedent->typeAntecedent = 'Gyneco-Obsterique';
                                }
                                $antecedent->antecedent = $antecedents;
                                $antecedent->consultation_id = $consultation->id;
                                $antecedent->save();
                            }


                            //*****Debut Examen complementaire****/

                            //Examen Radiologie
                            foreach ($this->newPatientExamenRadiologie as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Radio';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Ophtalmologie
                            foreach ($this->newPatientExamenOphtalmologie as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Ophtalmologie';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Odonto
                            foreach ($this->newPatientExamenOdonto as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Odonto';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Biologiques
                            foreach ($this->newPatientExamenBiologiques as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Biologique';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }


                            // ***** image Examen complementaire *****/
                            if (isset($this->typeExamenComplementaireImage) && $this->typeExamenComplementaireImage !== null) {
                                $examenComplementaire = new ExamenComplementaire();
                                $examenComplementaire->libelleExamenComplementaire = isset($this->newPatientTypeExamenComplementaireImage["libelle"]) ? $this->newPatientTypeExamenComplementaireImage["libelle"] : "";
                                $examenComplementaire->typeExamen = "Autres";
                                $examenComplementaire->examen = isset($this->newPatientTypeExamenComplementaireImage["examen"]) ? $this->newPatientTypeExamenComplementaireImage["examen"] : "";
                                $examenComplementaire->imageUrl  = $this->typeExamenComplementaireImage->store('uploads', 'public');
                                $examenComplementaire->consultation_id  = $consultation->id;
                                $examenComplementaire->save();
                                $this->typeExamenComplementaireImage = null;
                                $this->newPatientTypeExamenComplementaireImage = [];
                            }elseif ($this->suitExamenComplementaireImage !== null && !empty($this->newPatientTypeExamenComplementaireImage["examen"])) {
                                $examenComplementaire = new ExamenComplementaire();
                                $examenComplementaire->libelleExamenComplementaire = isset($this->newPatientTypeExamenComplementaireImage["libelle"]) ? $this->newPatientTypeExamenComplementaireImage["libelle"] : "";
                                $examenComplementaire->typeExamen = "Autres";
                                $examenComplementaire->examen = isset($this->newPatientTypeExamenComplementaireImage["examen"]) ? $this->newPatientTypeExamenComplementaireImage["examen"] : "";
                                $examenComplementaire->imageUrl  = $this->suitExamenComplementaireImage;
                                $examenComplementaire->consultation_id  = $consultation->id;
                                $examenComplementaire->save();
                                $this->typeExamenComplementaireImage = null;
                                $this->suitExamenComplementaireImage = null;
                                $this->newPatientTypeExamenComplementaireImage = [];
                            }


                            // ***** Fin Examen complementaire *****/


                            //*****Debut Traitement Dentaire****/

                            //Traitement Dentaire newPatientTraitementDentaire
                            foreach ($this->newPatientTraitementDentaireChecks as $traitement) {
                                $traitementDentaire = new TraitementDentaire();
                                $traitementDentaire->libelle = $traitement;
                                $traitementDentaire->typeTraitement = $traitement;
                                $traitementDentaire->consultation_id = $consultation->id;
                                $traitementDentaire->save();
                            }

                            //Traitement Dentaire
                            foreach ($this->newPatientTraitementDentaire as $key => $examen) {
                                $traitementDentaire = new TraitementDentaire();
                                //dump( $key );
                                if (in_array($key, $this->keytraitementDentaires)) {
                                    $traitementDentaire->libelle = $examen;
                                    $traitementDentaire->typeTraitement = $this->traitementDentaires[$key];

                                    $traitementDentaire->consultation_id = $consultation->id;
                                    $traitementDentaire->save();
                                }
                            }

                            // ***** Fin Traitement Dentaire *****/

                            //Pathologie
                            foreach ($this->newPatientPathologies as $key => $pathologies) {

                                $pathologie = new Pathologie();
                                if (in_array($key, ['affectionCarieuse', 'maladieParadontale', 'autresDiagnostic'])) {
                                    $pathologie->pathologie = $pathologies;
                                    $pathologie->typePathologie = $this->pathologieDentaires[$key];
                                } else {
                                    $pathologie->pathologie = $pathologies;
                                    $pathologie->typePathologie = $pathologies;
                                }

                                $pathologie->consultation_id = $consultation->id;
                                $pathologie->save();
                            }

                            //autre Pathologie
                            if (isset($this->autrePathologie) && !empty($this->autrePathologie)) {
                                $pathologie = new Pathologie();
                                $pathologie->pathologie = $this->autrePathologie;
                                $pathologie->typePathologie = 'Autres';
                                $pathologie->consultation_id = $consultation->id;
                                $pathologie->save();
                            }




                            //*****Debut soins infirmier****/
                            //soins
                            foreach ($this->newPatientSoins as $patientSoins) {
                                $soins = new Soins();
                                $soins->soins = $patientSoins;
                                $soins->consultation_id = $consultation->id;
                                $soins->save();
                            }

                            //autre soins
                            if (isset($this->newPatientAutresSoins) && !empty($this->newPatientAutresSoins)) {
                                $soins = new Soins();
                                $soins->soins = $this->newPatientAutresSoins;
                                $soins->consultation_id = $consultation->id;
                                $soins->save();
                            }
                            // ***** Fin soins infirmier *****/

                            $this->dispatch('showSuccessMessage', message: ['message' => 'Consultation enregistrée avec succès !', 'type' => 'success']);
                        }
                    }
                } catch (Exception $e) {
                    dd($e);
                }
            }
        
        } else {
            $this->choixExamenComplementaie = false;
            $this->dispatch('showSuccessMessage', message: ['message' => "Veillez selectionner le type d'examen ou choisir un fichier !", 'type' => 'danger']);
        }
    }

    /** Ajouter un suite Consultation*/

    public function addExPatientConsultation()
    {
        if ($this->typeExamenComplementaireImage !== null) {
            if (!empty($this->newPatientTypeExamenComplementaireImage["examen"])) {
                $typeSelectionne = true;
            }else {
                $typeSelectionne = false;
            }
        }elseif (isset($this->newPatientTypeExamenComplementaireImage["examen"])) {
            
            if (empty($this->newPatientTypeExamenComplementaireImage["examen"])) {
                $typeSelectionne = true;
            }else {
                $typeSelectionne = false;
            }
        }else {
            $typeSelectionne = true;
        }

        if ($typeSelectionne == true) {
            $this->choixExamenComplementaie = true;

            if ($this->validate()) {
                try {

                    if (Patient::find($this->newPatient['id'])) {

                        if ($this->newPatientConsultation['age'] >= 0 && $this->newPatientConsultation['age'] <= 4) {
                            $trancheAge = '0-4 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 5 && $this->newPatientConsultation['age'] <= 9) {
                            $trancheAge = '5-9 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 10 && $this->newPatientConsultation['age'] <= 14) {
                            $trancheAge = '10-14 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 15 && $this->newPatientConsultation['age'] <= 19) {
                            $trancheAge = '15-19 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 20 && $this->newPatientConsultation['age'] <= 24) {
                            $trancheAge = '20-24 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 25 && $this->newPatientConsultation['age'] <= 49) {
                            $trancheAge = '25-49 Ans';
                        }
                        if ($this->newPatientConsultation['age'] >= 50) {
                            $trancheAge = '50 Ans et plus';
                        }

                        $this->newPatientConsultation['trancheAge'] = $trancheAge;
                        $this->newPatientConsultation['user_id'] = auth()->user()->id;
                        $this->newPatientConsultation['patient_id'] = $this->newPatient['id'];
                        $this->newPatientConsultation['service'] = getRoleServiceName();

                        //Consultation
                        //Consultation
                        if (Consultation::create($this->newPatientConsultation)) {
                            $consultation = Consultation::latest('id')->where([
                                'user_id' => auth()->user()->id,
                                'service' => getRoleServiceName(),
                                'patient_id' => $this->newPatient['id'],
                                'trancheAge' => $trancheAge
                            ])->first();



                            // ***** Debut Examen Physique *****/
                            //Debut Examen Physique
                            if (isset($this->newPatientExamensPhysiques['autresExamensPhysiques']) && !empty($this->newPatientExamensPhysiques['autresExamensPhysiques'])) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamensPhysiques['autresExamensPhysiques'];
                                $ExamenPhysique->typeExamenPhysique = 'Autres';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                            }

                            if (isset($this->newPatientExamensPhysiques['examenExobuccal']) && !empty($this->newPatientExamensPhysiques['examenExobuccal'])) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamensPhysiques['examenExobuccal'];
                                $ExamenPhysique->typeExamenPhysique = 'Examen exobuccal';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                            }

                            if (isset($this->newPatientExamensPhysiques['hbd']) && !empty($this->newPatientExamensPhysiques['hbd'])) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamensPhysiques['hbd'];
                                $ExamenPhysique->typeExamenPhysique = 'HBD';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                            }

                            foreach ($this->newPatientExamensPhysiques as $key => $examen) {
                                //dump( $key );
                                if (in_array($key, ['examenEndobuccalC', 'examenEndobuccalA', 'examenEndobuccalO'])) {
                                    $this->newPatientExamenEndobuccal .= $this->separatorExamenEndobuccal . '' . $this->examensPhysiques[$key] . ': ' . $examen;
                                    $this->separatorExamenEndobuccal = '/';
                                }
                            }

                            if (isset($this->newPatientExamenEndobuccal) && $this->newPatientExamenEndobuccal != '') {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientExamenEndobuccal;
                                $ExamenPhysique->typeExamenPhysique = 'Examen endobuccal';
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                                $this->separatorExamenEndobuccal = '';
                            }

                            //Examen image
                            if (isset($this->newPatientTypeExamenPhysiqueImage) && $this->newPatientTypeExamenPhysiqueImage !== null) {
                                $ExamenPhysique = new ExamenPhysique();
                                $ExamenPhysique->libelleExamenPhysique = $this->newPatientTypeExamenPhysiqueImageLibelle;
                                $ExamenPhysique->typeExamenPhysique = 'Autres';
                                $ExamenPhysique->imageUrl = $this->newPatientTypeExamenPhysiqueImage->store('uploads', 'public');
                                //$ExamenPhysique->imageUrl = $this->newPatientTypeExamenPhysiqueImage["image"]->store('uploads', 'public');
                                $ExamenPhysique->consultation_id = $consultation->id;
                                $ExamenPhysique->save();
                                $this->newPatientTypeExamenPhysiqueImage = null;
                            }

                            //Fin Examen Physique
                            // ***** Fin Examen Physique *****/


                            //Antecedent
                            foreach ($this->newPatientAntecedent as $key => $antecedents) {
                                $antecedent = new Antecedent();
                                if ($key == 'antecedentMedicaux') {
                                    $antecedent->typeAntecedent = 'Medicaux';
                                }
                                if ($key == 'antecedentChirurgicaux') {
                                    $antecedent->typeAntecedent = 'Chirurgicaux';
                                }

                                if ($key == 'antecedentGynecoObsterique') {
                                    $antecedent->typeAntecedent = 'Gyneco-Obsterique';
                                }
                                $antecedent->antecedent = $antecedents;
                                $antecedent->consultation_id = $consultation->id;
                                $antecedent->save();
                            }


                            //*****Debut Examen complementaire****/

                            //Examen Radiologie
                            foreach ($this->newPatientExamenRadiologie as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Radio';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Ophtalmologie
                            foreach ($this->newPatientExamenOphtalmologie as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Ophtalmologie';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Odonto
                            foreach ($this->newPatientExamenOdonto as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Odonto';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Biologiques
                            foreach ($this->newPatientExamenBiologiques as $key => $examen) {
                                $examenComplementaire = new ExamenComplementaire();
                                //dump( $key );
                                if (in_array($key, $this->keyExamenComplementaires)) {
                                    $examenComplementaire->libelleExamenComplementaire = $examen;
                                    $examenComplementaire->typeExamen = $this->examenComplementaires[$key];
                                    $examenComplementaire->examen = 'Biologique';
                                    $examenComplementaire->consultation_id  = $consultation->id;
                                    $examenComplementaire->save();
                                }
                            }

                            //Examen Image
                            if (isset($this->typeExamenComplementaireImage) && $this->typeExamenComplementaireImage !== null) {
                                $examenComplementaire = new ExamenComplementaire();
                                $examenComplementaire->libelleExamenComplementaire = isset($this->newPatientTypeExamenComplementaireImage["libelle"]) ? $this->newPatientTypeExamenComplementaireImage["libelle"] : "";
                                $examenComplementaire->typeExamen = "Autres";
                                $examenComplementaire->examen = isset($this->newPatientTypeExamenComplementaireImage["examen"]) ? $this->newPatientTypeExamenComplementaireImage["examen"] : "";
                                $examenComplementaire->imageUrl  = $this->typeExamenComplementaireImage->store('uploads', 'public');
                                $examenComplementaire->consultation_id  = $consultation->id;
                                $examenComplementaire->save();
                                $this->typeExamenComplementaireImage = null;
                                $this->newPatientTypeExamenComplementaireImage = [];
                            }


                            // ***** Fin Examen complementaire *****/


                            //*****Debut Traitement Dentaire****/

                            //Traitement Dentaire newPatientTraitementDentaire
                            foreach ($this->newPatientTraitementDentaireChecks as $traitement) {
                                $traitementDentaire = new TraitementDentaire();
                                $traitementDentaire->libelle = $traitement;
                                $traitementDentaire->typeTraitement = $traitement;
                                $traitementDentaire->consultation_id = $consultation->id;
                                $traitementDentaire->save();
                            }

                            //Traitement Dentaire
                            foreach ($this->newPatientTraitementDentaire as $key => $examen) {
                                $traitementDentaire = new TraitementDentaire();
                                //dump( $key );
                                if (in_array($key, $this->keytraitementDentaires)) {
                                    $traitementDentaire->libelle = $examen;
                                    $traitementDentaire->typeTraitement = $this->traitementDentaires[$key];

                                    $traitementDentaire->consultation_id = $consultation->id;
                                    $traitementDentaire->save();
                                }
                            }

                            // ***** Fin Traitement Dentaire *****/

                            //Pathologie
                            foreach ($this->newPatientPathologies as $key => $pathologies) {

                                $pathologie = new Pathologie();
                                if (in_array($key, ['affectionCarieuse', 'maladieParadontale', 'autresDiagnostic'])) {
                                    $pathologie->pathologie = $pathologies;
                                    $pathologie->typePathologie = $this->pathologieDentaires[$key];
                                } else {
                                    $pathologie->pathologie = $pathologies;
                                    $pathologie->typePathologie = $pathologies;
                                }

                                $pathologie->consultation_id = $consultation->id;
                                $pathologie->save();
                            }

                            //autre Pathologie
                            if (isset($this->autrePathologie) && !empty($this->autrePathologie)) {
                                $pathologie = new Pathologie();
                                $pathologie->pathologie = $this->autrePathologie;
                                $pathologie->typePathologie = 'Autres';
                                $pathologie->consultation_id = $consultation->id;
                                $pathologie->save();
                            }




                            //*****Debut soins infirmier****/
                            //soins
                            foreach ($this->newPatientSoins as $patientSoins) {
                                $soins = new Soins();
                                $soins->soins = $patientSoins;
                                $soins->consultation_id = $consultation->id;
                                $soins->save();
                            }

                            //autre soins
                            if (isset($this->newPatientAutresSoins) && !empty($this->newPatientAutresSoins)) {
                                $soins = new Soins();
                                $soins->soins = $this->newPatientAutresSoins;
                                $soins->consultation_id = $consultation->id;
                                $soins->save();
                            }
                            // ***** Fin soins infirmier *****/

                            $this->dispatch('showSuccessMessage', message: ['message' => 'Consultation enregistrée avec succès !', 'type' => 'success']);
                        }
                    }
                } catch (Exception $e) {
                    dd($e);
                }
            }
        } else {
            $this->choixExamenComplementaie = false;
            $this->dispatch('showSuccessMessage', message: ['message' => "Veillez selectionner le type d'examen ou choisir un fichier !", 'type' => 'danger']);
        }
    }

    public function addControle()
    {

        //dd( $this->controle[ 'etatSante' ] );
        if ($this->validate()) {
            try {

                $consultation = $this->infoPatient->consultations()->latest()->first();
                $this->controle['consultation_id'] = $consultation->id;
                if (Controle::create($this->controle)) {
                    $this->dispatch('showSuccessMessage', message: ['message' => 'Controle enregistré avec succès !', 'type' => 'success']);
                    $this->controle = [];
                    $this->resetErrorBag();
                }
            } catch (Exception $e) {
                dd($e);
            }
        }
    }

    public function showModal(Patient $patient, $modal)
    {

        $this->infoPatient = $patient;
        $consultation = Consultation::latest()->where(['patient_id' => $patient->id, 'service' => getRoleServiceName()])->first();
        if ($modal == 'editePatientModal') {
            $this->lastInfoConsultationPatient = $patient->consultations()->latest()->first();
            $this->updateProfil['profession'] = $this->lastInfoConsultationPatient->profession;
            $this->updateProfil['assure'] = $this->lastInfoConsultationPatient->assure;
            $this->updateProfil['residence'] = $this->lastInfoConsultationPatient->residence;
            $this->updateProfil['contact'] = $this->lastInfoConsultationPatient->contact;
            $this->updateProfil['age'] = $this->lastInfoConsultationPatient->age;
            $this->updateProfil['nomPrenom'] = $this->infoPatient->nomPrenom;
            $this->updateProfil['sexe'] = $this->infoPatient->sexe;
            $this->updateProfil['numeroFiche'] = $this->infoPatient->numeroFiche;
            $this->currentModal = false;
            $this->dispatch('showModal', message: $modal);
        } else if (!empty($consultation)) {

            $this->currentModal = true;
            $this->dispatch('showModal', message: $modal);
        }

        // $this->modal = $modal;

    }

    public function closeModal($modal)
    {
        $this->resetErrorBag();
        $this->dispatch('closeModal', message: $modal);
    }

    public function updatePatient()
    {

        if ($this->validate()) {

            if ($this->updateProfil['age'] >= 0 && $this->updateProfil['age'] <= 4) {
                $trancheAge = '0-4 Ans';
            }
            if ($this->updateProfil['age'] >= 5 && $this->updateProfil['age'] <= 9) {
                $trancheAge = '5-9 Ans';
            }
            if ($this->updateProfil['age'] >= 10 && $this->updateProfil['age'] <= 14) {
                $trancheAge = '10-14 Ans';
            }
            if ($this->updateProfil['age'] >= 15 && $this->updateProfil['age'] <= 19) {
                $trancheAge = '15-19 Ans';
            }
            if ($this->updateProfil['age'] >= 20 && $this->updateProfil['age'] <= 24) {
                $trancheAge = '20-24 Ans';
            }
            if ($this->updateProfil['age'] >= 25 && $this->updateProfil['age'] <= 49) {
                $trancheAge = '25-49 Ans';
            }
            if ($this->updateProfil['age'] >= 50) {
                $trancheAge = '50 Ans et plus';
            }
            $this->infoPatient->numeroFiche = $this->updateProfil['numeroFiche'];
            $this->infoPatient->nomPrenom = $this->updateProfil['nomPrenom'];
            $this->infoPatient->sexe = $this->updateProfil['sexe'];

            $this->lastInfoConsultationPatient->profession = $this->updateProfil['profession'];
            $this->lastInfoConsultationPatient->assure = $this->updateProfil['assure'];
            $this->lastInfoConsultationPatient->residence = $this->updateProfil['residence'];
            $this->lastInfoConsultationPatient->contact = $this->updateProfil['contact'];
            $this->lastInfoConsultationPatient->age = $this->updateProfil['age'];
            $this->lastInfoConsultationPatient->trancheAge = $trancheAge;

            $this->infoPatient->update();
            $this->lastInfoConsultationPatient->update();
            $this->resetErrorBag();
            $this->dispatch('showSuccessMessage', message: ['message' => 'Controle enregistré avec succès !', 'type' => 'success']);
        }
    }


    protected function cleanupOldUploads()
    {
        $storage = Storage::disk();
        //dd($storage->allFiles("livewire-tmp")[0]);
        foreach($storage->allFiles("livewire-tmp") as $pathFileName){
            
            if (! $storage->exists($pathFileName) || count($storage->allFiles("livewire-tmp")) < 3) continue;
            $fiveSecondsDelete = now()->subSeconds(60)->timestamp;

            if ($fiveSecondsDelete > $storage->lastModified($pathFileName)) {
                $storage->delete($pathFileName);
            }
        }
    }
}
