<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $html =
                    '<div class="btn-group"><button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">action<span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-left" role="menu">';
                    $html .= '<li><a href="'. action('App\Http\Controllers\ClientController@edit', [$row->id]) .'" class="edit-product"><i class="fas fa-edit"></i>edit</a></li>';
                    $html .= '<li><a  href="'. action('App\Http\Controllers\ClientController@destroy', [$row->id]) .'" class="delete-product"><i  class="fa fa-trash"></i>delete</a></li>';
                    // $html .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">edit</a>';
                    $html .= '</ul></div>';
                    return $html;
                })
                 ->addColumn('surnom', function($row){
                    $surnom='<div class="name">' .$row->surnom.'</div>';
                    return $surnom;
                })
                ->addColumn('nom', function($row){
                    $nom='<div class="name">' .$row->nom.'</div>';
                    return $nom;
                })
                ->addColumn('number_phone', function($row){
                    $number_phone='<div class="name">' .$row->number_phone.'</div>';
                    return $number_phone;
                })
                ->addColumn('adresse', function($row){
                    $adresse='<div class="name">' .$row->adresse.'</div>';
                    return $adresse;
                })
                ->rawColumns(['action','surnom','nom','number_phone','adresse'])
                ->make(true);
        }
        return view('client.index', [
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

        return view('client.create', [
            // 'user' => User::findOrFail($id)
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createModal()
    {

        return view('client.create_modal', [
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
         if ($request->ajax()) {
        try{
            $produit_detail['surnom']=$request->input('surnom');
            $produit_detail['nom']=$request->input('nom');
            $produit_detail['number_phone']=$request->input('telephone');
            $produit_detail['adresse']=$request->input('addresse');

            $client=Contact::create($produit_detail);
            $client_id=$client->id;

            DB::commit();
            $output = ['success' => 1,
                            'msg' => 'creer avec succès',
                            'client_id' => $client_id
                        ];
            
        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['success' => 0,
                            'msg' =>"erreur",
                            'client_id' =>""
                        ];
            
        }
        return $output;
    }

    else {
        try{
            $produit_detail['surnom']=$request->input('surnom');
            $produit_detail['nom']=$request->input('nom');
            $produit_detail['number_phone']=$request->input('telephone');
            $produit_detail['adresse']=$request->input('addresse');

            $client=Contact::create($produit_detail);
            $client_id=$client->id;

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
        return redirect('client')->with('status', $output);
    }
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
        $client=Contact::find($id);
        return view('client.create', [
             'client' => $client
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
        $client=Contact::find($id);
        try{
            $produit_detail['surnom']=$request->input('surnom');
            $produit_detail['nom']=$request->input('nom');
            $produit_detail['number_phone']=$request->input('telephone');
            $produit_detail['adresse']=$request->input('addresse');

            $client=$client->update($produit_detail);
            $client->save();

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
        return redirect('client')->with('status', $output);
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
            $client=Contact::find($id);
            $client->delete();

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
            return redirect('client')->with('status', $output);
        }
        return redirect('client')->with('status', $output);
    }

}
