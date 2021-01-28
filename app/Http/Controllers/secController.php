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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Datetime;

class secController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes=Ville::pluck('name','id')->all();
        $statut=Statut::where('step',1)->pluck('name','id')->all();        
        return view('sec.add_commande',compact('villes','statut'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'phone'=>'required'//,
            //'prix'=>'required|numeric|min:2'

        ]);       
        $request->request->add(['created_by' =>Auth::user()->id ]);
        if(isset($request['day1']) && !empty($request['day1'])){
              $request->request->add(['status' =>$request['day1'] ]);             
              if($request['day1']=="6"){
                $startTime = new DateTime();
                $startTime=$startTime->format('Y-m-d H:i:s');
                $request->request->add(['validated_by' =>Auth::user()->name ]); 
              }
              elseif($request['day1']==3){ 
                    $startTime = new DateTime($request['created_at']);
                    $startTime=$startTime->format('Y-m-d H:i:s');                            
              }else{
                    $startTime = new DateTime();
                    $startTime=$startTime->format('Y-m-d H:i:s');
              }
        }else{
            $startTime = new DateTime();
            $startTime=$startTime->format('Y-m-d H:i:s');             
        }
        $request['created_at']=$startTime; 
        if(commande::create($request->all())){
            Session::flash('order_added','the order has been successfully added');
        }      
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$statuts=Statut::where('step',1)->pluck('name','id')->all();
        $statuts =[                                        
            '2' => 'Annuler',                    
            '7' => 'Non Livrer', 
            '4' => "N'est pas joignable",
            '3' => 'Rendez-vous',
            '5' => 'in delivering',
            '6' => 'confirmer'                                            
        ]; 
        $commande=commande::findOrFail($id);
        $villes=Ville::pluck('name','id')->all();
        //if($commande->status==3){
            $date_created_at = new DateTime($commande->created_at);
            $date_created_at=$date_created_at->format('m/d/Y');           
       /* }else{
            $date_created_at=$commande->created_at;
        }*/
        return view('sec.edit',compact('commande','villes','statuts','date_created_at'));
    }
    /**
     * Show the form for editing the specified resource.
     * Edit satut
     * @param  int  response
     * @return \Illuminate\Http\Response
     */
    public function edit_statut(Request $request)
    {

        if(!empty($request["day11"])){
            $commande=Commande::findOrFail($request["day11"]);
            $data =[
                'day1' => $request["day1"],
                'status' => $request["day1"],
                'validated_by' => Auth::user()->name
            ];

        }elseif(!empty($request["day22"])){
            $commande=Commande::findOrFail($request["day22"]);
            $data = array(
                'day2' => $request["day2"],
                'status' => $request["day2"],
                'validated_by' => Auth::user()->name

            );
        }elseif(!empty($request["day33"])){
            $commande=Commande::findOrFail($request["day33"]);
            $data =[
                'day3' => $request["day3"],
                'status' => $request["day3"],
                'validated_by' => Auth::user()->name
            ];

        }
        /**
         * show div alert success if statut is success
         */
        if($data["status"]==6){
            Session::flash('order_confirmed_sec','the order (AM-'.$commande->id.') has been successfully confirmed');           
        }
        $commande->update([
            'day1' => 0,
            'day2' => 0,
            'day3' => 0
        ]);        
        if($commande->update($data))      
           return redirect('/');
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
        if(isset($request["edit"])){   
            //test if statut is send by request
            if(isset($request["status"]) && !empty($request["status"])){
                //tester ou le statut ce trouve
                if($cmd->day1){
                     $data=['day1'=>$request["status"]];
                }elseif($cmd->day2){
                    $data=['day2'=>$request["status"]];
                }elseif($cmd->day3){
                    $data=['day3'=>$request["status"]];
                }else{
                    $data=['day1'=>$request["status"]];
                }
            }     
            if(isset($data))
               $request->request->add($data); 
            if($request['status']==3){ 
                $startTime = new DateTime($request['created_at']);
                $startTime=$startTime->format('Y-m-d H:i:s'); 
                $request['created_at']=$startTime;          
            }else{
                if($request['status']==6){
                    $request->request->add(['validated_by' => Auth::user()->name]); 
                }
                 /**default value**/
                    $startTime = new DateTime();
                    $startTime=$startTime->format('Y-m-d H:i:s');
                    $request['created_at']=$startTime;  
                 /*****************/  
            }
              
           if($cmd->update($request->all()))
              Session::flash('order_edit','the order (AM-'.$cmd->id.') has been successfully updated');  
        }else{
            if($cmd->update(['status'=> '2', 'day1' => 0, 'day2' => 0, 'day3' => 0]))
              Session::flash('order_cancel','the order (AM-'.$cmd->id.') has been successfully canceled');
        } 
        
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
        $commande_w_deleted=commande::findOrFail($id);
        $commande_w_deleted->delete();
        Session::flash('commande_delete','The commande has been deleted'); 
        return redirect('/');
    }
     /**
     * @confirmed order
     *
     *
     *
     */
    public function confirmation_order()
    {      
        $commandes=commande::where('validated_by','=',Auth::user()->name)->get();
        $statut=Statut::pluck('name','id')->all();
        return view('sec.confirmed_order',compact('commandes','statut'));
    }
     /**
     * 
     */
    public function calcule_delivery(){
        
        $count = commande::where('created_by','=',Auth::user()->id)->where('status','=','1')->whereDate('created_at', '=', Carbon::today())->count();

             
        return view('sec.my_livred_command',compact('count'));
    
    }
     /**
     * for searching commande between date
     */
    public function search_command_livred(Request $request)
    {
       // return 'ok';
        
        $time_1_1 = $request['date_1'];
        $time_2_1 = $request['date_2'];
        $time_1 = strtotime($request['date_1']);
        $newformat_1 = date('Y-m-d',$time_1);
        $time_2 = strtotime($request['date_2']);
        $newformat_2 = date('Y-m-d',$time_2);
       
        if($newformat_2>=$newformat_1){
              /*******************************/
           
            
            $count = commande::where('created_by','=',Auth::user()->id)->where('status','=','1')->whereDate('livred_at', '>=', $newformat_1)->whereDate('livred_at', '<=',$newformat_2)->count();

             
             return view('sec.my_livred_command',compact('count','time_1_1','time_2_1'));


            
              /*******************************/
        }else{
             return redirect('mycommandlivred')->withMessage('Date invalide');
        }

        
        
    }
}
