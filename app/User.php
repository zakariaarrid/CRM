<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_active','role_id','ville_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }
    public function ville(){
        return $this->belongsTo('App\Ville');
    }

    public function isAdmin(){
        if($this->role->name=="administrator" && $this->is_active==1){
            return true;
        }else return false;
    }
    public function isSec(){
        if($this->role->name=="sec" && $this->is_active==1){
            return true;
        }else return false;
    }
    public function isLiv(){
        if($this->role->name=="livreur" && $this->is_active==1){
            return true;
        }else return false;
    }
    public function isValidator(){
        if($this->role->name=="validator" && $this->is_active==1){
            return true;
        }else return false;
    }
}
