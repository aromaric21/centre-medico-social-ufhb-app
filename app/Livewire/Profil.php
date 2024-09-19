<?php

namespace App\Livewire;

use Exception;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profil extends Component
{
    public User $user;
    public $editUser = [];
    public $password = [];
    public $btnAction = "";

    public function render()
    {

        $this->editUser = $this->user->toArray();
        $data = [
            'user' => $this->user->first()
        ];
        return view('livewire.profil.index', $data)
            ->extends("layouts.template")
            ->section("content");
    }

    public function messages()
    {
        if ($this->btnAction == "updateProfil") {
            return [
                'editUser.nom.required' => "Le nom est requis",
                'editUser.nom.min' => "Les caractères du nom doivent etre au minimum de 2 caractères",
                'editUser.prenom' => 'Le prenom est requis',
                'editUser.prenom.min' => 'Les caractères du prenom doivent etre au minimum de 2 caractères',
                'editUser.contact.required' => 'Le contact est requis',
                'editUser.contact.min' => 'Le contact doit est de dix chiffres',
                'editUser.contact.unique' => "Cet contact existe deja"
            ];
        }

        if ($this->btnAction == "updatePassword") {
            return [
                'password.ancienPassword.required' => "L'ancien mot de passe est requis",
                'password.newPassword.required' => "Le nouveau mot de passe est requis",
                'password.confirm_newpassword.required' => "La confirmation du mot de passe est requis",
                'password.newPassword.min' => 'Le mot de passe doit contenir au moins 8 caractères',
                'password.confirm_newpassword.min' => 'Le mot de passe doit contenir au moins 8 caractères',
                'password.newPassword.same' => 'Les Mots de passe ne sont pas identiques',
                'password.confirm_newpassword.same'=>'Les Mots de passe ne sont pas identiques'
            ];
        }
    }

    public function rules()
    {

        if ($this->btnAction == "updateProfil") {
            return [
                'editUser.nom' => 'required|min:2',
                'editUser.prenom' => 'required|min:2',
                'editUser.contact' => ['required','min:10',Rule::unique("users", "contact")->ignore($this->editUser['id'])],
            ];
        }

        if ($this->btnAction == "updatePassword") {
            return [
                'password.ancienPassword' => 'required',
                'password.newPassword' => 'required|min:1|same:password.confirm_newpassword',
                'password.confirm_newpassword'=>'required|min:1|same:password.newPassword',
            ];
        }
    }

    public function updateUser()
    {

        $this->btnAction = "updateProfil";
        if ($this->validate()) {
            try {
                $this->user->nom = $this->editUser["nom"];
                $this->user->prenom = $this->editUser["prenom"];
                $this->user->contact = $this->editUser["contact"];
                //dd($this->user);
                $this->user->update();
                $this->dispatch('showSuccessMessage', message: ['message' => 'Profil mis à jour avec succès !', 'type' => 'success']);
                $this->btnAction = "";
                $this->editUser = [];
                $this->resetErrorBag();
            } catch (Exception $e) {
                dd($e);
            }
        }
    }


    public function updatePassword()
    {

        $this->btnAction = "updatePassword";
        if ($this->validate()) {
            try {
                $credentials = ["email"=>auth()->user()->email, "password"=>$this->password["ancienPassword"]];
                //$creds = Auth::attempt($credentials);
                //dd($creds);
                if (Auth::attempt($credentials)) {
                    $this->user->password = Hash::make($this->password["newPassword"]);
                    //dd($this->user);
                    $this->user->update();
                    
                    $this->dispatch('showSuccessMessage', message: ['message' => 'Mot de passe mis à jour avec succès !', 'type' => 'success']);
                }else{
                    $this->dispatch('showSuccessMessage', message: ['message' => "L'ancien mot de passe est incorrect !", 'type' => 'danger']);

                }
              
            } catch (Exception $e) {
                dd($e);
            }
            $this->btnAction = "";
            $this->password = [];
            $this->resetErrorBag();
        }
    }
}
