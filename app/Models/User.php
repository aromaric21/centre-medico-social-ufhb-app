<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'password',
        'etatCompte',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function consultations(){
        return $this->hasMany(Consultation::class);
    }

    public function caisses(){
        return $this->hasMany(Caisse::class);
    }

    public function medicaments(){
        return $this->hasMany(Medicament::class);
    }

    public function hasRole($role){
        return $this->role()->where("libelleRole",$role)->first() !== null;
    }

    public function hasNonRole($role){
        return $this->role()->where("libelleRole","!=",$role)->first() !== null;
    }

    public function hasAnyRoles($roles){
        return $this->role()->whereIn("libelleRole",$roles)->first() !== null;
    }

    public function nbreUserByService($service){
        if ($service=="tout") {
            return User::count();
        } else {
            return User::join('roles', 'roles.id', '=', 'users.role_id')
                            ->select('roles.*','users.*')
                            ->where('roles.service',$service)
                            ->count();
        }
        
    }

}
