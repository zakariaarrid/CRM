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
use DateTime;
use DB;



class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $livreurs=User::where('role_id' ,2)->where('is_active' ,1)->get();        
        return view('admin.commande.add_commande',compact('villes','statut','livreurs'));
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
        $startTime = new DateTime($request['created_at']);
        $startTime=$startTime->format('Y-m-d H:i:s'); 
        $request['created_at']=$startTime;          
        if(!empty($request['day1']) && isset($request['day1'])){
            if($request['day1']==6 || $request['day1']==5 ){
              $request->request->add(['validated_by' => Auth::user()->name ]);
            }elseif($request['day1']==3){ 
              $startTime = new DateTime($request['created_at']);
              $startTime=$startTime->format('Y-m-d H:i:s'); 
              $request['created_at']=$startTime;         
            }
            $request->request->add(['status' =>$request['day1'] ]);            
        }       
        if(commande::create($request->all()))
         Session::flash('order_added','the order has been successfully added');  

      
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
       
        $livreur_name = "";
        $livreur_ville = "";
       // $statut=Statut::where('step',1)->pluck('name','id')->all();
        $date_created_at = new DateTime();              
        $commande=commande::findOrFail($id);
       
        $statut=Statut::where('step',1)->pluck('name','id')->all(); 
        $villes=Ville::all(); 
        $livreurs=User::where('role_id' ,2)->where('is_active' ,1)->get();    
        if($commande->status==3){
            $date_created_at = new DateTime($commande->created_at);                    
        }
        
        if($commande->status==5){
            
            $livreur_name=User::find($commande->livreur_id);     
            if($livreur_name)  {               
                $livreur_ville=Ville::findOrfail($livreur_name->ville_id);           
                $livreur_name=$livreur_name->name;
                $livreur_ville=$livreur_ville->name;
            }else {
                $livreur_name='';
                $livreur_ville='';
            }
            
                   
        }
        $date_created_at=$date_created_at->format('m/d/Y');  

        
       
        return view('admin.commande.edit_commande',compact('commande','villes','livreurs','statut','date_created_at','livreur_name','livreur_ville'));
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
      

       if(!empty($request["day11"])){
           $commande=Commande::findOrFail($request["day11"]);
            if($request["day1"] == 1){
                $data =[
                    'day1' => $request["day1"],
                    'status' => $request["day1"],
                    'validated_by' => Auth::user()->name,
                    'livred_at' => $this_time
                ];
            }else {
                $data =[
                    'day1' => $request["day1"],
                    'status' => $request["day1"],
                    'validated_by' => Auth::user()->name
                ];
            }

           
       }elseif(!empty($request["day22"])){
           $commande=Commande::findOrFail($request["day22"]);
            if($request["day2"] == 1){
                $data = array(
                    'day2' => $request["day2"],
                    'status' => $request["day2"],
                    'validated_by' => Auth::user()->name,
                    'livred_at' => $this_time
                );
            }else{
                $data = array(
                    'day2' => $request["day2"],
                    'status' => $request["day2"],
                    'validated_by' => Auth::user()->name
                    

                );
            }
       }elseif(!empty($request["day33"])){
           $commande=Commande::findOrFail($request["day33"]);
           if($request["day3"] == 1){
                $data =[
                    'day3' => $request["day3"],
                    'status' => $request["day3"],
                    'validated_by' => Auth::user()->name,
                    'livred_at' => $this_time
                ];
           }else{
                $data =[
                    'day3' => $request["day3"],
                    'status' => $request["day3"],
                    'validated_by' => Auth::user()->name
                    
                ];
           }
           
       }
       $commande->update([
           'day1' => 0,
           'day2' => 0,
           'day3' => 0
       ]);
       $commande->update($data);
      /* $commandes=commande::all();
       $statut=Statut::where('step',1)->pluck('name','id')->all();
       return view('admin.dashboard',compact('commandes','statut'));*/
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
              
        if($cmd->day1!=0){
             $request->request->add(['status' => $request['status'] ,'day1' => $request['status'] ,'day2' => 0 ,'day3' => 0]);
        }elseif($cmd->day2!=0){
            $request->request->add(['status'  => $request['status'] ,'day1' => 0 ,'day2' => $request['status'] ,'day3' => 0]);
        }elseif($cmd->day3!=0){
            $request->request->add(['status'  => $request['status'] ,'day1' => 0 ,'day2' => 0 ,'day3' => $request['status']]);
        }
        /*if(isset($request['livreur_id']) && !empty($request['livreur_id'])){
            $request->request->add(['status' => '5' ,'day1' => 0 ,'day2' => 0 ,'day3' => 0]);
        }*/
        if($request['status']==3){ 
            $startTime = new DateTime($request['created_at']);
            $startTime=$startTime->format('Y-m-d H:i:s'); 
            $request['created_at']=$startTime;          
        }else{
             /**default value**/
                $startTime = new DateTime();
                $startTime=$startTime->format('Y-m-d H:i:s');
                $request['created_at']=$startTime;  
             /*****************/  
        }

        if($request['status']==2){           
            $request['livreur_id']='0';          
        }

       
       

        if($cmd->update($request->all()))
          Session::flash('order_edit','the order (AM-'.$cmd->id.') has been successfully updated');          

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
        return redirect()->back();
    }
    /**
     * @confirmed order
     *
     *
     *
     */
    public function confirmation_order()
    {
        $commandes=commande::all();
        $statut=Statut::where('step',1)->pluck('name','id')->all();
        return view('admin.commande.confirmer_order',compact('commandes','statut'));
    }
    

   public function dashy()
   {
       $commandes=commande::all();
       $statut=Statut::where('step',1)->pluck('name','id')->all();

       return view('admin.dashboard',compact('commandes','statut'));
   }
   /*
    *order in delivering
    */
    public function order_in_delivering()
    {
        $commandes=commande::where('status','=','5')->get();       
        $statut=Statut::where('step',1)->pluck('name','id')->all();                 
        return view('admin.commande.in_delivering',compact('commandes','statut'));
    }
    /*
    *order delivered
    */
    public function order_delivered()
    {
        $commandes=commande::where('status','=','1')->get();       
        $statut=Statut::where('step',1)->pluck('name','id')->all();         
        return view('admin.commande.order_delivered',compact('commandes','statut'));
    }
    /*
    *get_data
    */
    public function getdata(){
        $a = 2;
        $b = 7;
        if(commande::where('validated_by','!=','')->whereMonth('created_at','=',date('m'))->count())
          $count[] = commande::where('validated_by','!=','')->whereMonth('created_at','=',date('m'))->count();
        else $count[]=0 ;       
        if(commande::where('status','=','5')->whereMonth('created_at','=',date('m'))->count())
          $count[] = commande::where('status','=','5')->whereMonth('created_at','=',date('m'))->count();
        else $count[]=0 ;      
        if(commande::whereMonth('livred_at','=',date('m'))->whereYear('livred_at','=',date('Y'))->count())  
          $count[]=commande::whereMonth('livred_at','=',date('m'))->whereYear('livred_at','=',date('Y'))->count();                   
        else $count[]=0 ; 
        
        if(commande::where('status','!=','6')->orWhere('status','=','0')->count())  
          $count[] = commande::where('status','!=','6')->orWhere('status','=','0')->count();
        else $count[]=0 ;
        /**canceled */    
        $count_c =  $commandecsm1=commande::whereMonth('created_at','=',date('m'))->whereYear('created_at','=',date('Y'))->where(function ($query) use ($a,$b) {
            $query->where('status', '=', $a)
                  ->orWhere('status', '=', $b);
        })->count();     
        if($count_c)  
          $count[] = $count_c;
        else $count[]=0 ; 
        /**total */        
        if(commande::where('status','=','1')->whereMonth('created_at','=',date('m'))->count())  
          $count[] = commande::where('status','=','1')->whereMonth('created_at','=',date('m'))->sum('prix');
        else $count[]=0 ; 
        /**
         * number of orders
         */
        if(commande::whereMonth('created_at','=',date('m'))->count())
        $count[] = commande::whereMonth('created_at','=',date('m'))->count();
        else $count[]=0 ;
        return Json_encode($count);
    }
    /*
    *get_all_order
    */
    public function get_all_order(){
        $commandes=commande::orderBy('created_at', 'desc')->get();        
        $statut=Statut::where('step','!=','')->pluck('name','id')->all();         
        return view('admin.commande.list_orders',compact('commandes','statut'));    
    }
    /**
     * get count delivred orders per city
     */
    public function getdata_per_city(Request $request){
        $time_1 = strtotime($request['Date_1']);
        $time_2 = strtotime($request['Date_2']);
        $newformat_1 = date('Y-m-d',$time_1);
        $newformat_2 = date('Y-m-d',$time_2);
        $commandes = DB::select("select ville_id, name ,count(*) as count,commandes.status from commandes join villes on commandes.ville_id=villes.id  group by commandes.ville_id, villes.name,commandes.status HAVING commandes.created_at >='".$newformat_1."' AND commandes.created_at <= '".$newformat_2."' AND commandes.status='1'");
        return json_encode($commandes);
       
    }

    

   
}
