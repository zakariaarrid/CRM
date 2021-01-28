<?php

namespace App\Http\Controllers;

use App\commande;
use App\Role;
use App\Statut;
use App\User;
use App\Ville;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users=User::all();
       return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::pluck('name','id')->all();
        $villes=Ville::pluck('name','id')->all();
        return view('admin.user.add_user',compact('roles','villes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $user = User::where('email', '=', $request['email'])->first();
        if ($user === null) {
            if(trim($request->password)==''){
                $input=$request->except(password);
            }else{
                $input=$request->all();    
                $input['password']=bcrypt($input['password']);               
            }           
            User::create($input);           
        }else{
           Session::flash('mail_exist',$request['email'].' exist already');
           return redirect('/admin/user/create');
        }
        Session::flash('user_added','the user has been successfully added');
        return redirect('/admin/user');
       
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
        $roles=Role::pluck('name','id')->all();
        $villes=Ville::pluck('name','id')->all();
        $user=User::findOrFail($id);
        return view('admin.user.edit',compact('user','roles','villes'));

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
        if(isset($request["edit"]) && !empty($request["edit"])){        
            $user=User::findOrFail($id);
            $input=$request->all();
            if(trim($request->password)!=''){
                $input['password']=bcrypt($input['password']);
            }            
            $user->update(array_filter($input));
            $commandes=commande::all();
            $statut=Statut::where('step',1)->pluck('name','id')->all();  
            Session::flash('user_edit','the user has been successfully updated');      
        }elseif(isset($request["delete"]) && !empty($request["delete"])){            
            $user_w_deleted=User::findOrFail($id);
            $user_w_deleted->delete();
            Session::flash('user_delete','The user has been deleted');            
        }
        return redirect('/admin/user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_w_deleted=User::findOrFail($id);
        $user_w_deleted->delete();
        Session::flash('user_delete','The user has been deleted'); 
        return redirect('/admin/user');
   
    }
   
    
}
