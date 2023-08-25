<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $html =
                    '<div class="btn-group"><button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">action<span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-left" role="menu">';
                    $html .= '<li><a href="'. action('App\Http\Controllers\RoleController@edit', [$row->id]) .'" class="edit-product"><i class="fas fa-edit"></i>edit</a></li>';
                    $html .= '<li><a  href="'. action('App\Http\Controllers\RoleController@destroy', [$row->id]) .'" class="delete-product"><i  class="fa fa-trash"></i>delete</a></li>';
                    // $html .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">edit</a>';
                    $html .= '</ul></div>';
                    return $html;
                })
                ->addColumn('role', function($row){
                    $role='<div class="name">' .$row->nom.'</div>';
                    return $role;
                })
                ->rawColumns(['action','role'])
                ->make(true);
        }
        return view('roles.index', [
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
        return view('roles.create', [
            // 'user' => User::findOrFail($id)
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
        
        try{
            $role_detail['nom']=$request->input('role');

            $role=Role::create($role_detail);

            DB::commit();
            $output = ['success' => 1,
                            'msg' => 'creer avec succès',
                        ];
            
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['success' => 0,
                            'msg' =>"erreur",
                        ];
            
        }
    
    
        return redirect('roles')->with('status', $output);
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
        $role=Role::find($id);
        return view('roles.edit', [
             'role' => $role
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
        $role=Role::find($id);
        try{
            $role_detail['nom']=$request->input('role');

            $role=$role->update($role_detail);
            // $role->save();

            DB::commit();
            $output = ['success' => 1,
                            'msg' => 'creer avec succès'
                        ];
            
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['success' => 0,
                            'msg' =>"erreur"
                        ];
            
        }
        return redirect('roles')->with('status', $output);
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
            $role=Role::find($id);
            $role->delete();

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
            return redirect('roles')->with('status', $output);
        }
        return redirect('roles')->with('status', $output);
    }

}
