<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResePasswordRequest;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CodeVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
//use App\Mail\SendEmailToUserNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Notifications\SendEmailToUserNotification;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function handleLogin(Request $request){
        //dd($request);

        try {
            //$password= Hash::make($authRequest->password);
            $user = User::where('email', $request->email)->first();
            //dump($user);
            //dd($request->email);

            if ($user) {

                if ($user->etatCompte == 1) {
                    if ($user->role()->first()->libelleRole == 'Secrétaire' || $user->role()->first()->libelleRole == 'Admin') {

                        $credentials = $request->only(['email', 'password']);
    
                        if (Auth::attempt($credentials)) {
                            return redirect()->route('dashboard');
                        } else {
                            return redirect()->back()->withInput()->with('error_msg', 'Parametres de connexion non reconnus');
                        }
                    } else {
                        
                        $credentials = $request->only(['email', 'password']);
    
                        if (Auth::attempt($credentials)) {
                            return redirect()->route('home');
                        } else {
                            return redirect()->back()->withInput()->with('error_msg', 'Parametres de connexion non reconnus');
                        }
                    }
                } else {
                    return redirect()->back()->withInput()->with('error_msg', 'Ce compte est désactivé');
                }
                

                
            } else {
                return redirect()->back()->withInput()->with('error_msg', 'Parametres de connexion non reconnus');
            }
        } catch (Exception $e) {
            dd($e);
        }
        
    }


    public function verifEmail(Request $request){
        
        //dd($user);
        try {
            $user = User::where('email', $request->resetPasswordEmail)->first();
            if ($user) {


               try {
                    CodeVerifyEmail::where("email",$user->email)->delete();
                    $code = rand(1000, 4000);
                    $codeVerifData = [
                        "code"=>$code,
                        "email"=>$user->email
                    ];
                    CodeVerifyEmail::create($codeVerifData);

                    $data = [
                        "code"=>$code, 
                        "email"=>$user->email,
                        "user"=>$user->nom.' '.$user->prenom,
                        "option"=>"resetpassword",
                    ];
                    Notification::route('mail', $user->email)->notify(new SendEmailToUserNotification($data));
                    //dd($sms);
                    //Mail::to($user->email)->send(new SendEmailToUserNotification($data));
                    //dd($sms);
                    return redirect()->route('resetPassword',$user->email);
               } catch (Exception $e) {
                    throw new Exception("Une erreur est survenue lors de la verification de l'email");
                
               }
        

            } else {
                return redirect()->back()->withInput()->with('error_msg', 'Email inconnu');
            }

        } catch (Exception $e) {
            dd($e);
        }
        
    }

    public function resetPassword($email){
        
       return view("auth.reset-password",compact("email"));
        
    }

    public function handleResetPassword($email,ResePasswordRequest $request){
        
       
        //dd($user);
        try {
           
            $user = User::where("email", $email)->first();

            if ($user) {
                $codeVerifyEmail = CodeVerifyEmail::where("email", $email)->first();

                if ($codeVerifyEmail->code == $request->code) {
                    $user->password = Hash::make($request->password);
                    $user->update();

                    if ($user) {
                        $codeVerifyEmail = CodeVerifyEmail::where('email', $user->email)->count();

                        if ($codeVerifyEmail >= 1) {
                            CodeVerifyEmail::where('email', $user->email)->delete();
                        }
                    }
                    return redirect()->route('login')->with('message', "Mot de passe reinitialise avec succes");
                } else {
                    return redirect()->back()->with('error_msg', "Code invalide");
                }
                
            } else {
                return redirect()->back()->with('error_msg', "L'email n'existe pas");
            }
            

        } catch (Exception $e) {
            dd($e);
        }
        
    }


    public function activecompte($email){
        return view("auth.active-compte",compact("email"));
         
     }
 
     public function handleActivecompte($email,ResePasswordRequest $request){
         
        //dd($email);
         //dd($user);
         try {
            
             $user = User::where("email", $email)->first();
            
             if ($user) {
                 $codeVerifyEmail = CodeVerifyEmail::where("email", $email)->first();
 
                 if ($codeVerifyEmail->code == $request->code) {
                     $user->password = Hash::make($request->password);
                     $user->etatCompte = 1;
                     $user->email_verified_at = now();
                     
                     $user->update();
 
                     
                     if ($user) {
                         $codeVerifyEmail = CodeVerifyEmail::where('email', $user->email)->count();
 
                         if ($codeVerifyEmail >= 1) {
                             CodeVerifyEmail::where('email', $user->email)->delete();
                         }
                     }
                     return redirect()->route('login')->with('message', "Compte activé avec succes");
                 } else {
                     return redirect()->back()->with('error_msg', "Code invalide");
                 }
                 
             } else {
                 return redirect()->back()->with('error_msg', "L'email n'existe pas");
             }
             
 
         } catch (Exception $e) {
             dd($e);
         }
         
     }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
