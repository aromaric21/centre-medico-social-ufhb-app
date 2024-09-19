<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [ 
            'email' => 'required|email|exists:users,email', 
            'email' => 'exists:code_verify_emails,email', 
            'code' => 'required|exists:code_verify_emails,code', 
            'password' => 'required|same:confirmpassword', 
            'confirmpassword' => 'required|same:password' 
        ];
    }

    public function messages()
    {
        return [         
            'email.exists' => "Cet email n'exixte pas",         
            'email.required' => "Le mail est requis",         
            'email.email' => "L'addresse mail n'est une email",         
            'code.required' => "Le code est requis",         
            'password.required' => "Le mot de passe est requis",         
            'confirmpassword.required' => "Le mot de passe est requis",         
            'password.same' => "Les mots de passe ne sont pas identiques",         
            'confirmpassword.same' => "Les mots de passe ne sont pas identiques",         
            'code.exists' => "Ce code n'exixte pas",         
        ];
    }
}
