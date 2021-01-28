<?php

namespace App\Http\Controllers;

use App\commande;
use App\Comment;
use App\Statut;
use App\Ville;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Datetime;
use DB;

class LivController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes_count=commande::where('livrer_by', '=', Auth::user()->id)->whereMonth('created_at','=',date('m'))->count(); 
        return $commandes_count;
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {       
        $commande=commande::findOrFail($id);
        $date_created_at = new DateTime($commande->created_at);
        $date_created_at=$date_created_at->format('m/d/Y'); 
        $villes=Ville::pluck('name','id')->all();
        $livreurs=User::where('role_id' ,2)->where('is_active' ,1)->get();  
        $status=Statut::where('step',2)->pluck('name','id')->all(); 
        $statut_actuel=Statut::findOrFail($commande->status);   
        return view('livreur.edit_commande',compact('commande','villes','livreurs','status','date_created_at','statut_actuel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $cmd=commande::findOrFail($id);
       //dd($cmd);
       if($request['status']==3){ 
            $startTime = new DateTime($request['created_at']);
            $startTime=$startTime->format('Y-m-d H:i:s'); 
            $request['created_at']=$startTime; 
            $request->request->add(['livreur_id' => 0]);         
        }elseif($request['status']==1){
            $startTime = new DateTime();
            $startTime=$startTime->format('Y-m-d H:i:s');
            $request['created_at']=$startTime; 
            $this_time = new DateTime();
            $this_time=$this_time->format('Y-m-d H:i:s');
            $request->request->add(['livred_at'=>$this_time,'livrer_by'=> Auth::user()->id]);
        }else{
            /**default value**/
            $startTime = new DateTime();
            $startTime=$startTime->format('Y-m-d H:i:s');
            $request['created_at']=$startTime;  
            /*****************/  
        }  
       // $request->request->add(['livreur_id' => 0]);        
        $request['day1']=$request['status'];  
       // dd($request);
        
        if($cmd->update($request->all()))
          Session::flash('order_edit','the order (AM-'.$cmd->id.') has been successfully updated');  
        //$cmd->update($request->all());
          return redirect('/');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
     /**
     * Show the form for editing the specified resource.
     * Edit satut
     * @param  int  response
     * @return \Illuminate\Http\Response
     */
    public function edit_statut(Request $request)
    {       
      $this_time = new DateTime();
      $this_time=$this_time->format('Y-m-d H:i:s');  
      if($request["id_commande"]){
        $commande=Commande::findOrFail($request["id_commande"]);              
        if($request->statut=='7' && $request->statut=='4' && $request->statut=='3') {
            $livrer_by=0;
            $data = ['livreur_id' => 0];
        }else {
            $livrer_by=Auth::user()->id; 
        }
        $data = [            
            'status'    => $request["statut"],
            'livrer_by' => $livrer_by,
            'day1' => 0,
            'day2' => 0,
            'day3' => 0       
        ];
        if($request->statut == '1'){
            $ar = ['livred_at' => $this_time] ;
            $data = array_merge($data,$ar);
        }
        //$data ['livreur_id'] = 0;     
         
        $commande->update($data);            
      }
     // dd($request);
      /*$commandes=commande::where('livreur_id', '=', Auth::user()->id)->get(); 
      $statut=Statut::where('step',2)->pluck('name','id')->all();*/
      //return view('livreur.index',compact('commandes','statut'));    
      return redirect('/');
    }
    public function none_joingnable() {

        $commandes=commande::where('livreur_id', '=', Auth::user()->id)->where('status','=','4')->get();                    
        $statut =[
            '1' => 'Livrer',  
            '2' => 'annuler',
            '7' => 'Non Livrer',
            '4' => "N'est pas joignable",
            '3' => 'Rendez-vous',
            '5' => 'In delivering'                        
        ]; 

        return view('livreur.non_joignable',compact('commandes','statut'));

    }

     /**
     * for searching commande between date
     */
    public function search_command_livred(Request $request)
    {
        $time_1_1 = $request['date_1'];
        $time_2_1 = $request['date_2'];
        $time_1 = strtotime($request['date_1']);
        $newformat_1 = date('Y-m-d',$time_1);
        $time_2 = strtotime($request['date_2']);
        $newformat_2 = date('Y-m-d',$time_2);
       
        if($newformat_2>=$newformat_1){
              /*******************************/

              
            $query = DB::select("select users.name, count(commandes.id) as nbr_livred ,SUM(prix) total from commandes join users on commandes.livrer_by=users.id where livred_at >='".$newformat_1."' AND livred_at<='".$newformat_2."' AND status='1' AND commandes.livrer_by=".Auth::user()->id." group by users.name");
              
            return view('livreur.statistic_ delivery_man',compact('query','time_1_1','time_2_1'));

            
              /*******************************/
        }else{
             return redirect('livreur_livred')->withMessage('Date invalide');
        }

        
        
    }

     /**
     * 
     */
    public function livreur_livred(){
        
        $query = DB::select("select users.name, count(commandes.id) as nbr_livred,SUM(prix) total from commandes join users on commandes.livrer_by=users.id where livred_at=CURDATE() AND status='1' AND commandes.livrer_by=".Auth::user()->id." group by users.name");
             
        return view('livreur.statistic_ delivery_man',compact('query'));
    
    }
    
}
