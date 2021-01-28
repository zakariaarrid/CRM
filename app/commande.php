<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commande extends Model
{
    public $fillable=['nom_prenom','phone','ville_id','prix','produit','note','adress','status','day1','day2','day3','status','validated_by','created_by','livrer_by','livreur_id','Qty','ville_name','created_at','livred_at'];
    public function ville(){
        return $this->belongsTo('App\Ville');
    }
    public function statut(){
        return $this->belongsTo('App\Statut');
    }   
    public function user(){
        return $this->belongsTo('App\User');
    }   
}
