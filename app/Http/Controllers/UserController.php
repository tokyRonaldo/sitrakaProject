<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $html =
                    '<div class="btn-group"><button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">action<span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-left" role="menu">';
                    $html .= '<li><a href="'. action('App\Http\Controllers\UserController@edit', [$row->id]) .'" class="edit-product"><i class="fas fa-edit"></i>edit</a></li>';
                    $html .= '<li><a  href="'. action('App\Http\Controllers\UserController@destroy', [$row->id]) .'" class="delete-product"><i  class="fa fa-trash"></i>delete</a></li>';
                    // $html .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">edit</a>';
                    $html .= '</ul></div>';
                    return $html;
                })
                ->addColumn('username', function($row){
                    $username='<div class="name">' .$row->username.'</div>';
                    return $username;
                })
                ->addColumn('email', function($row){
                    $email='<div class="name">' .$row->email.'</div>';
                    return $email;
                })
                ->addColumn('roles', function($row){
                    $role="";
                    foreach($row->user_roles as $user_role){
                        $role.='<div class="name">' .$user_role->role->nom.'</div><br>'; 
                    }
                    return $role;
                })
                // ->filterColumn('username', function ($query, $keyword) {
                //     $query->where( function($q) use($keyword) {
                //         $q->where('username', 'like', "%{$keyword}%");
                //         // ->orWhere('contacts.supplier_business_name', 'like', "%{$keyword}%");
                //     });
                // })
            
                ->rawColumns(['action','username','email','roles'])
                ->make(true);
        }
        return view('users.index', [
            // 'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::get();
   
        return view('users.create', [
            'roles' => $roles
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $produit_detail['username']=$request->input('username');
            $produit_detail['email']=$request->input('email');
            $produit_detail['password']=Hash::make($request->input('password'));
            // $produit_detail['role']=$request->input('role');
            $roles=$request->input('roles');
          
            
            // if($validate){
            $user=User::create($produit_detail);

            if(!empty($roles)){
            foreach($roles as $role){
             $user_role=UserRole::create([
                'role_id'=>$role['id'],
                'user_id'=>$user->id,
             ])   ;
            }

        }
            // $user_id=$user->id;
            // }
            DB::commit();
            $output = ['success' => 1,
                            'msg' => 'creer avec succès',
                        ];
                        return redirect('user')->with('status', $output);
            
    
  
       
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
        $user=User::find($id);

        $roles=Role::get();
   
        return view('users.edit', [
             'user' => $user,
             'roles' => $roles
        ]);
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
        $user=User::find($id);
            $produit_detail['username']=$request->input('username');
            $produit_detail['email']=$request->input('email');
            $produit_detail['password']=$request->input('password');
            $roles=$request->input('roles');

            $user->username=$produit_detail['username'];
            $user->email=$produit_detail['email'];
            $user->password=$produit_detail['password'];
            $user->save();

           
            //user_role effacer
            $user_roles=$user->user_roles;
            foreach($user_roles as $user_role){
                $user_role_delete=UserRole::find($user_role->id);
                $user_role_delete->delete();
            }
            if(!empty($roles)){

            //user role reajouter
            foreach($roles as $role){
                $user_role=UserRole::create([
                   'role_id'=>$role['id'],
                   'user_id'=>$user->id,
                ])   ;
               }
            }
           


            DB::commit();
            $output = ['success' => 1,
                            'msg' => 'creer avec succès'
                        ];
       
        return redirect('users')->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user=User::find($id);
            $user->delete();
            foreach($user->user_roles as $user_role){
            $user_role_id=UserRole::find($user_role->id);
            $user_role_id->delete();
            

            }
            DB::commit();
            $output = ['success' => 1,
                            'msg' => 'supprimer avec succès'
                        ];

        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['success' => 0,
                            'msg' =>"erreur"
                        ];
            return redirect('users')->with('status', $output);
        }
        return redirect('users')->with('status', $output);
    }

}
