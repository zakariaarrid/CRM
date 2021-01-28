<?php

namespace App\Http\Controllers;

use App\commande;
use App\Statut;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }
    /**
     * Show chat.
     *
     */
    public function chat()
    {
        return view('chat');

    }
    /*
    * first redirection
    */
     public function home1(){
         if (!Auth::check())
             return view('auth/login');
         else{
              /**Admin */
             if(Auth::user()->isAdmin()){
                $commandes=commande::orderBy('created_at', 'desc')->get();
                // $statut=Statut::where('step',1)->pluck('name','id')->all();
                $statut=Statut::where('step','!=','')->pluck('name','id')->all();
                /*
                * static for number commande delivred
                */
                $commandesm1=commande::whereMonth('livred_at','=','1')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm2=commande::whereMonth('livred_at','=','2')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm3=commande::whereMonth('livred_at','=','3')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm4=commande::whereMonth('livred_at','=','4')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm5=commande::whereMonth('livred_at','=','5')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm6=commande::whereMonth('livred_at','=','6')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm7=commande::whereMonth('livred_at','=','7')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm8=commande::whereMonth('livred_at','=','8')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm9=commande::whereMonth('livred_at','=','9')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm10=commande::whereMonth('livred_at','=','10')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm11=commande::whereMonth('livred_at','=','11')->whereYear('livred_at','=',date('Y'))->count();
                $commandesm12=commande::whereMonth('livred_at','=','12')->whereYear('livred_at','=',date('Y'))->count();

                $commande_delivred_this_years=[$commandesm1,$commandesm2,$commandesm3,$commandesm4,$commandesm5,$commandesm6,$commandesm7,$commandesm8,$commandesm9,$commandesm10,$commandesm11,$commandesm12];

                 /*
                * static for number commande canceled
                */
                $a=2;
                $b=7;

                $commandecsm1=commande::whereMonth('created_at','=','1')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm2=commande::whereMonth('created_at','=','2')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm3=commande::whereMonth('created_at','=','3')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm4=commande::whereMonth('created_at','=','4')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm5=commande::whereMonth('created_at','=','5')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm6=commande::whereMonth('created_at','=','6')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm7=commande::whereMonth('created_at','=','7')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm8=commande::whereMonth('created_at','=','8')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm9=commande::whereMonth('created_at','=','9')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm10=commande::whereMonth('created_at','=','10')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm11=commande::whereMonth('created_at','=','11')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();
                $commandecsm12=commande::whereMonth('created_at','=','12')->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
                    $query->where('status', '=', $a)
                          ->orWhere('status', '=', $b);
                })->count();

                $commande_canceled_this_years=[$commandecsm1,$commandecsm2,$commandecsm3,$commandecsm4,$commandecsm5,$commandecsm6,$commandecsm7,$commandecsm8,$commandecsm9,$commandecsm10,$commandecsm11,$commandecsm12];


                return view('admin.dashboard',compact('commandes','statut','commande_delivred_this_years','commande_canceled_this_years'));
             /**Sec */
            }elseif(Auth::user()->isSec()){
                 //$commandes=commande::where('created_by', '=', Auth::user()->id)->where('status','=','')->get();
                 /***/
                $commandes=commande::where(function ($query) {
                    $query->where('created_by', '=', Auth::user()->id);
                })->where(function ($query) {
                    $query->where('status', '!=', 1)
                          ->where('status', '!=', 2)
                          ->where('status', '!=', 4);
                          //->where('status', '!=', 7);
                })->get();
                 /***/

               // $statut=Statut::where('step',1)->pluck('name','id')->all();

                $statut =[
                    '2' => 'Annuler',
                    '7' => 'Non Livrer',
                    '4' => "N'est pas joignable",
                    '3' => 'Rendez-vous',
                    '5' => 'in delivering',
                    '6' => 'confirmer'
                ];
                $count = commande::where('created_by','=',Auth::user()->id)->where('status','=','1')->whereDate('livred_at', '=', Carbon::today())->count();
                $count_m = commande::where('created_by','=',Auth::user()->id)->where('status','=','1')->whereMonth('livred_at', '=',date('m'))->count();

                // return $statut;
                return view('sec.index',compact('commandes','statut','count','count_m'));
             /**Livreur */
             }elseif(Auth::user()->isLiv()){
                $commandes=commande::where('livreur_id', '=', Auth::user()->id)->where('status','!=','6')->where('status','!=','4')->where('status','!=','7')->where('status','!=','3')->get();
                $statut =[
                    '1' => 'Livrer',
                    '2' => 'annuler',
                    '7' => 'Non Livrer',
                    '4' => "N'est pas joignable",
                    '3' => 'Rendez-vous',
                    '5' => 'In delivering'
                ];
                $count = commande::where('status','=','1')->whereDate('livred_at', '=', Carbon::today())->where('livrer_by','=',Auth::user()->id)->count();

                return view('livreur.index',compact('commandes','statut','count'));
            }elseif(Auth::user()->isValidator()){
                /*modify here*/
                  //$commandes=commande::where('status', '=', 6)->orWhere('created_by','=','65')->where('status', '!=', 1)->get();
                $commandes=commande::where(function ($query) {
                    $query->where('status', '=', 6)
                          ->where('status', '!=', 1)
                          ->where('status', '!=', 2);
                })->orWhere(function ($query) {
                    $query->where('created_by', '=', 65)
                          ->where('status', '!=', 2);
                })->orWhere(function ($query) {
                    $query->where('created_at', '=', Carbon::today())
                          ->where('status', '=', 3);
                })->get();

                /*************/

                $statut=Statut::where('step',1)->pluck('name','id')->all();
                return view('validateur.index',compact('commandes','statut'));
            }
         }
    }
}
