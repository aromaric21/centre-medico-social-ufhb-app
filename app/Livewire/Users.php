<?php

namespace App\Livewire;

use Exception;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CodeVerifyEmail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailToUserNotification;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $currentPage = PAGELIST;
    public $newUser = [];
    public $editUser = [];



    public function messages()
    {
        if ($this->currentPage == PAGECREATEFORM) {
            return [
                'newUser.nom.required' => "Le nom est requis",
                'newUser.nom.min' => "Les caractères du nom doivent etre au minimum de 2 caractères",
                'newUser.prenom' => 'Le prenom est requis',
                'newUser.prenom.min' => 'Les caractères du prenom doivent etre au minimum de 2 caractères',
                'newUser.contact.required' => 'Le contact est requis',
                'newUser.contact.min' => 'Le contact doit est de dix chiffres',
                'newUser.contact.unique' => "Cet contact existe deja",
                'newUser.email.required' => 'Le mail est requis',
                'newUser.email.email' => "Le mail n'est pas valide",
                'newUser.email.unique' => "Cet Email existe deja",
                'newUser.role_id.required' => "Le service est requis"
            ];
        }

        if ($this->currentPage == PAGEEDITFORM) {
            return [
                'editUser.nom.required' => "Le nom est requis",
                'editUser.nom.min' => "Les caractères du nom doivent etre au minimum de 2 caractères",
                'editUser.prenom' => 'Le prenom est requis',
                'editUser.prenom.min' => 'Les caractères du prenom doivent etre au minimum de 2 caractères',
                'editUser.contact.required' => 'Le contact est requis',
                'editUser.contact.min' => 'Le contact doit est de dix chiffres',
                'editUser.contact.unique' => "Cet contact existe deja",
                'editUser.email.required' => 'Le mail est requis',
                'editUser.email.email' => "Le mail n'est pas valide",
                'editUser.email.unique' => "Cet Email existe deja",
                'editUser.role_id.required' => "Le service est requis"
            ];
        }
    }

    public function rules()
    {
        if ($this->currentPage == PAGEEDITFORM) {
            return [
                'editUser.nom' => 'required|min:2',
                'editUser.prenom' => 'required|min:2',
                'editUser.contact' =>  ['required', 'min:10', Rule::unique("users", "contact")->ignore($this->editUser['id'])],
                'editUser.email' => ['required', 'email', Rule::unique("users", "email")->ignore($this->editUser['id'])],
                'editUser.role_id' => 'required'
            ];
        }



        if ($this->currentPage == PAGECREATEFORM) {
            return [
                'newUser.nom' => 'required|min:2',
                'newUser.prenom' => 'required|min:2',
                'newUser.contact' => 'required|unique:users,contact|min:10',
                'newUser.email' => 'required|email|unique:users,email',
                'newUser.role_id' => 'required'
            ];
        }
    }


    public function render()
    {

        Carbon::setLocale("fr");

        $users = User::latest()->paginate(5);
        $users->onEachSide(1);

        return view('livewire.admin.users.index', [
            "users" => $users,
            "roles" => Role::all()
        ])
            ->extends("layouts.template")
            ->section("content");
    }


    public function goToAddUser()
    {
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToListeUser()
    {
        $this->currentPage = PAGELIST;
        $this->editUser = [];
    }

    public function goToEditUser($id)
    {
        $this->editUser = User::find($id)->toArray();
        //dd($this->editUser);
        $this->currentPage = PAGEEDITFORM;
    }

    public function apdateUser()
    {
        $validationAttributes = $this->validate();
        User::find($this->editUser['id'])->update($validationAttributes['editUser']);
        $this->dispatch("showSuccessMessage", message: ['message' => "Utilisateur mis a jour avec succès !", 'type' => 'success']);
    }

    /** Ajouter un nouvel utilisateur */
    public function addUser()
    {

        $this->validate();
        $code = rand(1000, 4000);
        $user = new User();
        $user->nom = $this->newUser["nom"];
        $user->prenom = $this->newUser["prenom"];
        $user->contact = $this->newUser["contact"];
        $user->email = $this->newUser["email"];
        $user->password = Hash::make(1);
        $user->etatCompte = 0;
        $user->role_id = (int)$this->newUser["role_id"];
        //$user->save();
        
            if ($user->save()) {
                
                try {
                    CodeVerifyEmail::where("email",$this->newUser["email"])->delete();
                    $code = rand(1000, 4000);
                    $codeVerifData = [
                        "code"=>$code,
                        "email"=>$this->newUser["email"]
                    ];
                    CodeVerifyEmail::create($codeVerifData);
                    $data = [
                        "code" => $code,
                        "email" => $this->newUser["email"],
                        "user" => $this->newUser["nom"]. ' ' . $this->newUser["prenom"],
                        "option" => "activercompte",
                    ];
                    Notification::route('mail', $this->newUser["email"])->notify(new SendEmailToUserNotification($data));

                    $this->newUser = [];
                    $this->dispatch("showSuccessMessage", message: ['message' => "Utilisateur créé avec succès !", 'type' => 'success']);
                
                }  catch (Exception $e) {
                    
                    throw new Exception("Une erreur est survenue lors de l'enregistrement de l'utilisateur");
        
                }

            }else {
                $this->dispatch("showSuccessMessage", message: ['message' => "Une erreur est survenue lors de l'enregistrement de l'utilisateur !", 'type' => 'danger']);
            }
       


        //dd($validationAttributes);
        //Ajouter un nouvel utilisateur
        //$validationAttributes["newUser"]['password'] = Hash::make(1);
        //User::create($validationAttributes["newUser"]);
        
    }

    /** Supprimer un utilisateur */
    public function confirmeDelete($nom, $user_id)
    {
        $this->dispatch("showConfirmMessage", message: [
            'message' => "Vous etes sur le point de supprimer $nom de la liste des utilisateur. Voulez-vous contiues?",
            'user_id' => $user_id,
            'typeConfirm' => 'delete'
        ]);
    }

    /** Supprimer un utilisateur */
    public function deleteUser($id)
    {
        User::destroy($id);
        $this->dispatch("showSuccessMessage", message: [
            'message' => "Utilisateur supprime avec succes",
            'type' => 'success'
        ]);
    }


    public function confirmeDesactiveOrActiveUser($nom, $user_id)
    {
        $user = User::find($user_id);
        if ($user->etatCompte == 1) {
            $message = "de desactiver";
        } else {
            $message = "d'activer";
        }
        $this->dispatch("showConfirmMessage", message: [
            'message' => "Vous etes sur le point $message le compte de l'utilisateur $nom. Voulez-vous contiues?",
            'user_id' => $user_id,
            'typeConfirm' => 'desactiveOrActive'
        ]);
    }

    public function desactiveOrActiveUser($id)
    {
        $user = User::find($id);
        if ($user->etatCompte == 1) {
            $user->update(['etatCompte' => 0]);
        } else {
            $user->update(['etatCompte' => 1]);
        }

        $this->dispatch("showSuccessMessage", message: ['message' => "Utilisateur mis a jour avec succès !", 'type' => 'success']);
    }
}
