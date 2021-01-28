<?php

namespace App\Http\Controllers;
use App\commande;
use App\Comment;
use App\Statut;
use App\Ville;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datetime;
class ValidatorController extends Controller
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
        return view('validateur.add_command',compact('villes'));
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
        $request->request->add(['created_by' =>Auth::user()->id ,'validated_by' =>Auth::user()->name, 'status' =>'6']);
        $request['day1']=="6";     
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
        $date_created_at = new DateTime();              
        $commande=commande::findOrFail($id);
       
        $statut=Statut::where('step',1)->pluck('name','id')->all(); 
        $villes=Ville::all();      
        $livreurs=User::where('role_id' ,2)->where('is_active' ,1)->get();    
        if($commande->status==3){
            $date_created_at = new DateTime($commande->created_at);                    
        }
        $date_created_at=$date_created_at->format('m/d/Y');  
        return view('validateur.edit',compact('commande','villes','livreurs','statut','date_created_at'));
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
      /*if(isset($request["idcommande"]) && !empty($request["idcommande"])){
          $commande=Commande::findOrFail($request["idcommande"]);
          if($request["status"]==2){
                $commande->update(['status'=> '2', 'day1' => 0, 'day2' => 0, 'day3' => 0]);
                Session::flash('order_cancel','the order (AM-'.$commande->id.') has been successfully canceled');  


          }         
           //test if statut is send by request
           if(isset($request["status"]) && !empty($request["status"])){
                //tester ou le statut ce trouve
                if($commande->day1) $data=['day1'=>$request["status"]];
                elseif($commande->day2) $data=['day2'=>$request["status"]];
                elseif($commande->day3) $data=['day3'=>$request["status"]];
                else $data=['day1'=>$request["status"]];            
           }     
      }
      return redirect('/');*/

    
        
    }
        /**
     * Show the form for editing the specified resource.
     * Edit satut
     * @param  int  response
     * @return \Illuminate\Http\Response
     */
    /*public function edit_statut(Request $request)
    {

    }*/
    

    /*
    *order in delivering
    */
    public function order_in_delivering()
    {
       
        $commandes=commande::where('status','=','5')->get();       
        $statut=Statut::where('step',1)->pluck('name','id')->all();                 
        return view('validateur.in_delivering',compact('commandes','statut'));
    }


}
