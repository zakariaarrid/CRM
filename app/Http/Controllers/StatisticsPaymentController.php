<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\commande;
use Carbon\Carbon;
use DB;

class StatisticsPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $rq=array();
        $start = new Carbon('first day of this month');
        $start->startOfMonth();
        $end = new Carbon('last day of this month');
        $end->endOfMonth();
      
        $users_confirmation=User::where('role_id','=','4')->orWhere('role_id','=','3')->get(); 
        $commande_by_month=commande::whereBetween('created_at', [$start, $end])->get(); 
           

        foreach($users_confirmation as $user) {
            if($user->role_id=='3') $role='Confirmatrice';
            elseif($user->role_id=='4') $role='Validateur';
            $name=$user->name;
            if($role=='Confirmatrice'){
                /**
                 * calcule number validation
                 */            
                $filtered_confirmed = $commande_by_month->filter(function ($value, $key) use($name) {                
                    return ($value['validated_by']==$name) ; 
                }); 
                /**
                 * calcule number validation
                 */            
                $filtered_livred = $commande_by_month->filter(function ($value, $key) use($name) {                
                    return ($value['status'] == 1 && $value['validated_by']==$name) ; 
                }); 
                /**
                 * Total sales
                 */ 
                $total_sales=0;
                $total='';
                foreach($filtered_livred as $liv){
                    $total_sales += floatval($liv['prix']);                                       
                }   
               

            }elseif($role=='Validateur'){
                /**
                 * calcule number validation
                 */            
                $filtered_confirmed = $commande_by_month->filter(function ($value, $key) use($name) {                
                    return ($value['validated_by']!='' || $value['created_by']=='65' ) ; 
                }); 
                /**
                 * calcule number validation
                 */            
                $filtered_livred = $commande_by_month->filter(function ($value, $key) use($name) {                
                    return ($value['status'] == 1 && $value['validated_by']==$name) ; 
                });  
                /**
                 * Total sales
                 */ 
                $total_sales=0;
                foreach($filtered_livred as $liv){
                    $total_sales+=$liv['prix'];
                }
            } 

            if(count($filtered_livred) != 0 && count($filtered_confirmed) != 0){
                $delivred_perc=round((count($filtered_livred)/count($filtered_confirmed)*100)) ."%";
            }
            else{ 
                $delivred_perc="0%";
            }
            //$rqs[]=['name' => $user->name,'role' => $role,'nbr_confirmation' => count($filtered_confirmed),'nbr_livred' => count($filtered_livred) ,'delivred_perc' =>$delivred_perc,'total_sales' => $total_sales,'bonus4per' => ($total_sales*0.04),'bonus1per' => ($total_sales*0.01),'totalBonus' => ($total_sales*0.04+$total_sales*0.01)];
            $rqs[]=['name' => $user->name,'role' => $role,'nbr_confirmation' => count($filtered_confirmed),'nbr_livred' => count($filtered_livred) ,'delivred_perc' =>$delivred_perc,'total_sales' => $total_sales,'bonus10' => (count($filtered_livred)*10)]; 
        }   
                    
        return view('admin.statistics-payment.index',compact('rqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        //
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
        //
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
     * for searching commande between date
     */
    public function search(Request $request)
    {
        $time_1_1 = $request['date_1'];
        $time_2_1 = $request['date_2'];
        $time_1 = strtotime($request['date_1']);
        $newformat_1 = date('Y-m-d',$time_1);
        $time_2 = strtotime($request['date_2']);
        $newformat_2 = date('Y-m-d',$time_2);

        if($newformat_2>=$newformat_1){
              /*******************************/
              $rq=array();              
             
              $users_confirmation=User::where('role_id','=','4')->orWhere('role_id','=','3')->get(); 
              if($newformat_2!=$newformat_1)
                //$commande_by_month=commande::whereBetween('created_at', [$newformat_1, $newformat_2])->get();        
                $commande_by_month=commande::whereDate('created_at','>=',$newformat_1)->whereDate('created_at','<=',$newformat_2)->get();        
              else  $commande_by_month=commande::where('created_at', 'like', $newformat_1.'%')->get();
              foreach($users_confirmation as $user) {
                  if($user->role_id=='3') $role='Confirmatrice';
                  elseif($user->role_id=='4') $role='Validateur';
                  $name=$user->name;
                  if($role=='Confirmatrice'){
                      /**
                       * calcule number validation
                       */            
                      $filtered_confirmed = $commande_by_month->filter(function ($value, $key) use($name) {                
                          return ($value['validated_by']==$name) ; 
                      }); 
                      /**
                       * calcule number validation
                       */            
                      $filtered_livred = $commande_by_month->filter(function ($value, $key) use($name) {                
                          return ($value['status'] == 1 && $value['validated_by']==$name) ; 
                      }); 
                      /**
                       * Total sales
                       */ 
                      $total_sales=0;
                      foreach($filtered_livred as $liv){
                          $total_sales+=$liv['prix'];
                      }
      
                  }elseif($role=='Validateur'){
                      /**
                       * calcule number validation
                       */            
                      $filtered_confirmed = $commande_by_month->filter(function ($value, $key) use($name) {                
                          return ($value['validated_by']!='' || $value['created_by']=='65' ) ; 
                      }); 
                      /**
                       * calcule number validation
                       */            
                      $filtered_livred = $commande_by_month->filter(function ($value, $key) use($name) {                
                          return ($value['status'] == 1 && $value['validated_by']==$name) ; 
                      });  
                      /**
                       * Total sales
                       */ 
                      $total_sales=0;
                      foreach($filtered_livred as $liv){
                          $total_sales+=$liv['prix'];
                      }
                  } 
      
                  if(count($filtered_livred) != 0 && count($filtered_confirmed) != 0){
                      $delivred_perc=round((count($filtered_livred)/count($filtered_confirmed)*100)) ."%";
                  }
                  else{
                      $delivred_perc="0%";
                  }
                  //$rqs[]=['name' => $user->name,'role' => $role,'nbr_confirmation' => count($filtered_confirmed),'nbr_livred' => count($filtered_livred) ,'delivred_perc' =>$delivred_perc,'total_sales' => $total_sales,'bonus4per' => ($total_sales*0.04),'bonus1per' => ($total_sales*0.01),'totalBonus' => ($total_sales*0.04+$total_sales*0.01)];
                  $rqs[]=['name' => $user->name,'role' => $role,'nbr_confirmation' => count($filtered_confirmed),'nbr_livred' => count($filtered_livred) ,'delivred_perc' =>$delivred_perc,'total_sales' => $total_sales,'bonus10' => (count($filtered_livred)*10)]; 

              }  
              
                          
              return view('admin.statistics-payment.index',compact('rqs','time_1_1','time_2_1'));
              /*******************************/
        }else{
             return redirect('admin/statistics-payment')->withMessage('Date invalide');
        }        
    }
    /**
     * for searching commande between date
     */
    public function search_command(Request $request)
    {
        $time_1_1 = $request['date_1'];
        $time_2_1 = $request['date_2'];
        $time_1 = strtotime($request['date_1']);
        $newformat_1 = date('Y-m-d 00:00:00',$time_1);
        $time_2 = strtotime($request['date_2']);
        $newformat_2 = date('Y-m-d 00:00:00',$time_2);           
       
        if($newformat_2>=$newformat_1){
              /********************************/
              if(commande::whereDate('created_at','<=',$newformat_2)->whereDate('created_at','>=',$newformat_1)->count())
                   // $number_order = commande::whereBetween('created_at', [$newformat_1, $newformat_2])->count();
                $number_order = commande::whereDate('created_at','<=',$newformat_2)->whereDate('created_at','>=',$newformat_1)->count();
              else $number_order=0 ;             
              if(commande::where('validated_by','!=','')->whereDate('created_at','<=',$newformat_2)->whereDate('created_at','>=',$newformat_1)->count())
                $confirmed_order = commande::where('validated_by','!=','')->whereDate('created_at','<=',$newformat_2)->whereDate('created_at','>=',$newformat_1)->count();
              else $confirmed_order=0 ;
              if(commande::where('status','=','5')->whereDate('created_at','<=',$newformat_2)->whereDate('created_at','>=',$newformat_1)->count())
                $on_progress = commande::where('status','=','5')->whereDate('created_at','<=',$newformat_2)->whereDate('created_at','>=',$newformat_1)->count();
              else $on_progress=0 ;
              if(commande::where('status','=','1')->whereDate('livred_at','<=',$newformat_2)->whereDate('livred_at','>=',$newformat_1)->count())  
              $total= commande::where('status','=','1')->whereDate('livred_at','<=',$newformat_2)->whereDate('livred_at','>=',$newformat_1)->sum('prix');
              else $total=0 ;
              if(commande::where('status','=','2')->whereDate('created_at','<=',$newformat_2)->whereDate('created_at','>=',$newformat_1)->orWhere('status','=','7')->count())  
              $canceled = commande::where('status','=','2')->orWhere('status','=','7')->whereDate('created_at','<=',$newformat_2)->whereDate('created_at','>=',$newformat_1)->count();
              else $canceled=0 ;        
              if(commande::where('status','=','1')->whereDate('livred_at','<=',$newformat_2)->whereDate('livred_at','>=',$newformat_1)->count())  
              $delivred = commande::where('status','=','1')->whereDate('livred_at','<=',$newformat_2)->whereDate('livred_at','>=',$newformat_1)->count();
              else $delivred=0 ; 
              return view('admin.statistics-payment.statistics_command',compact('number_order','confirmed_order','on_progress','total','canceled','delivred','time_1_1','time_2_1'));
              /*******************************/     
        }else{
             return redirect('admin/calcule_statistics')->withMessage('Date invalide'); 
        }

        
        
    }
    /**
     * for searching commande between date
     */
    public function search_command_livred(Request $request){
        $time_1_1 = $request['date_1'];
        $time_2_1 = $request['date_2'];
        $time_1 = strtotime($request['date_1']);
        $newformat_1 = date('Y-m-d',$time_1);
        $time_2 = strtotime($request['date_2']);
        $newformat_2 = date('Y-m-d',$time_2);
       
        if($newformat_2>=$newformat_1){
              /*******************************/

              
            $query = DB::select("select users.name, count(commandes.id) as nbr_livred ,SUM(prix) total from commandes join users on commandes.livrer_by=users.id where livred_at >='".$newformat_1."' AND livred_at<='".$newformat_2."' AND status='1' group by users.name");
              
            return view('admin.statistics-payment.statistic_ delivery_man',compact('query','time_1_1','time_2_1'));

            
              /*******************************/
        }else{
             return redirect('admin/calcule_statistics')->withMessage('Date invalide');
        }       
        
    }
    /**
     * For calculation table 
     */

    public function calculation_table(Request $request){
       // return "ok";
    }

    /**
     * 
     */
    public function calcule_statistics(){

        if(commande::whereMonth('created_at','=',date('m'))->count())
        $number_order = commande::whereMonth('created_at','=',date('m'))->count();
        else $number_order=0 ;
        if(commande::where('validated_by','!=','')->whereMonth('created_at','=',date('m'))->count())
          $confirmed_order = commande::where('validated_by','!=','')->whereMonth('created_at','=',date('m'))->count();
        else $confirmed_order=0 ;
        if(commande::where('status','=','5')->whereMonth('created_at','=',date('m'))->count())
          $on_progress = commande::where('status','=','5')->whereMonth('created_at','=',date('m'))->count();
        else $on_progress=0 ;
        if(commande::where('status','=','1')->whereMonth('livred_at','=',date('m'))->count())  
        $total= commande::where('status','=','1')->whereMonth('livred_at','=',date('m'))->sum('prix');
        else $total=0 ;
        if(commande::where('status','=','2')->whereMonth('created_at','=',date('m'))->orWhere('status','=','7')->count())  
        $canceled = commande::where('status','=','2')->orWhere('status','=','7')->whereMonth('created_at','=',date('m'))->count();
        else $canceled=0 ;        
        if(commande::where('status','=','1')->whereMonth('livred_at','=',date('m'))->count())  
        $delivred = commande::where('status','=','1')->whereMonth('livred_at','=',date('m'))->count();
        else $delivred=0 ; 

        return view('admin.statistics-payment.statistics_command',compact('number_order','confirmed_order','on_progress','total','canceled','delivred'));
    }
    /**
     * 
     */
    public function calcule_delivery(){
        
        $query = DB::select("select users.name, count(commandes.id) as nbr_livred,SUM(prix) total from commandes join users on commandes.livrer_by=users.id where livred_at=CURDATE() AND status='1' group by users.name");
             
        return view('admin.statistics-payment.statistic_ delivery_man',compact('query'));
    
    }
}
