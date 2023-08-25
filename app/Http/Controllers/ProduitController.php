<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Contact;
use App\Utils\ProduitUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Storage;
use DataTables;

class ProduitController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        if ($request->ajax()) {
            // route('project.details', params)
            $data = Article::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $roles = session('roles');
                    $html =
                    '<div class="btn-group"><button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">action<span class="caret"></span></button>';
                    if (isset($roles)){
                        if(in_array('admin',$roles) ||in_array('superAdmin',$roles)){
                            $html .= '<ul class="dropdown-menu dropdown-menu-left" role="menu">';
                    
                    // $html .= '<li><a href="'. action('App\Http\Controllers\ProduitController@show', [$row->id]) .'" class="btn-modal view-product-modal" data-toggle="modal" data-target="#view_modal"><i class="fa fa-eye"></i>show</a></li>';
                  
                    $html .= '<li><a href="'. action('App\Http\Controllers\ProduitController@edit', [$row->id]) .'" class="edit-product"><i class="fas fa-edit"></i>edit</a></li>';
                    $html .= '<li><a  href="'. action('App\Http\Controllers\ProduitController@destroy', [$row->id]) .'" class="delete-product"><i  class="fa fa-trash"></i>delete</a></li>';
                    // $html .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">edit</a>';
                    $html .= '</ul></div>';
                }
            }
            $html .= '</div>';
            return $html;
                })
                ->addColumn('nom', function($row){
                    $nom='<div class="name">' .$row->nom.'</div>';
                    return $nom;
                })
                ->addColumn('sku', function($row){
                    $sku='<div class="name">' .$row->sku.'</div>';
                    return $sku;
                })
                // ->addColumn('sku', function($row){
                //     $sku='<span>' .$row->sku.'</span>';
                //     return $sku;
                // })
                ->addColumn('prix', function($row){
                    $prix='<div class="name">' .$row->prix.'</div>';
                    return $prix;
                })
                ->addColumn('qte', function($row){
                    $qte='<div class="name">' .$row->qte.'</div>';
                    return $qte;
                })
                ->addColumn('dispo', function($row){
                    if($row->is_dispo == 1){
                        $dispo='<p class="name" style="color:green;">dispo</p>';  
                    }
                    else{
                        $dispo='<p class="name" style="color:red;">pas dispo</p>';  
                    }
                    // $dispo='<div class="name">' .$row->is_dispo.'</div>';
                    return $dispo;
                })
                ->addColumn('img', function($row){
                    $image=asset('/storage/images/'.$row->img);
                    // <img src="{{ asset('img/myimage.png') }}" alt="description of myimage">
                    return '<div style="display: flex;"><img src="' . $image . '" width="50px" height="50px" class="img-responsive"></div>';
                })
                ->rawColumns(['action','nom','prix','qte','dispo','img','sku'])
                // ->rawColumns(['action','nom','prix'])
                ->make(true);
        }
        return view('produits.index', [
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
        // dd(auth()->user());
        return view('produits.create')
        //  ->with(compact())
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try{
            $produit_detail['nom']=$request->input('nom');
            $produit_detail['descripions']=$request->input('description');
            $produit_detail['prix']=$request->input('prix');
            $produit_detail['is_dispo']=1;
            // $produit['qte']=$request->input('qte');
            if ($request->hasFile('image')) {
                // $name = $request->file('image')->getClientOriginalName();
            //     $imageName = time() . '.' . $request->image->extension();
            // $request->file('image')->move(public_path('images'), $imageName);
 
            //     // $image = $request->file('image')->store(public_path('images'));

            
            //     $request->image->storeAs('public/images',$imageName);

            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            }
            // Else add a dummy image
            else {
            $fileNameToStore = 'noimage.jpg';
            }

            

            $produit_detail['img']=$fileNameToStore;

            $produit = Article::create($produit_detail);

            $sku = generateProductSku($produit->id);
            $produit->sku = $sku;
            $produit->save();

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
            return redirect('produit')->with('status', $output);
        }
        return redirect('produit')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
           $produit=Article::findOrFail($id);

            return view('produits.show')->with(compact(
                'produit'

            ));
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listProduit (Request $request)
    {   
        
        if ($request->ajax()) {
            $term=$request->get('term');

            if (!empty($term)) {
                // $produits=DB::table('contacts')
                // ->where('nom','toky')->get();
                $produits = Article::where(function ($query) use ($term) {
                    $query->where('nom', 'like', '%' . $term .'%');
                    $query->orWhere('sku', 'like', '%' . $term .'%');
                })->get();
                $results=array();
                if($produits->count()){
                    foreach ($produits as $produit){
                        $device='Ar';
                        $prix = $produit->prix.' '.$device;
                        array_push($results,array(
                            'id' => $produit->id,
                                'nom' => $produit->nom,
                                'sku' => $produit->sku,
                                'prix' => $prix
                        ));

                    }
                };
                return json_encode($results);
            }
            


        }

   
    }

        
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProduitRow (Request $request)
    {   
        
        if ($request->ajax()) {
            $produit_id=$request->get('produit_id');
            $count=$request->get('count');
            $row_index=$request->get('row_index');
            $is_edit=$request->get('is_edit');

            // if($is_edit==0){
                $produit=Article::find($produit_id);
                
                return view('produits.get_produits_row')
                ->with(compact('produit',
                               'row_index'
            ));
               

            // }
            


        }

   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produit=Article::find($id);

        return view('produits.edit')
         ->with(compact('produit'))
        ;
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
        $produit=Article::find($id);

        try{
            $produit_details = $request->only(['nom','description','prix']);

            $produit_details['is_dispo']=1;
            // $produit['qte']=$request->input('qte');
            // $produit_detail['image']=$request->input('image');

            $produit->nom=$produit_details['nom'];
            $produit->description=$produit_details['description'];
            $produit->prix=$produit_details['prix'];
            // $produit->image=$produit_detail['image'];
            $produit->is_dispo=$produit_details['is_dispo'];

            if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            if ($produit->img) {
                Storage::delete('public/images/' . $produit->img);
              }
            }
            // Else add a dummy image
            else {
            $fileNameToStore = 'noimage.jpg';
            }




            // $produit->save();

            $produit->img=$fileNameToStore;
            $sku = generateProductSku($produit->id);
            $produit->sku = $sku;
            $produit->save();

            DB::commit();
            $output = ['success' => 1,
                            'msg' => 'modifier avec succès'
                        ];

        }
        catch(\Exception $e){
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            $output = ['success' => 0,
                            'msg' =>"erreur"
                        ];
            return redirect('produit')->with('status', $output);
        }
        return redirect('produit')->with('status', $output);

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
            $produit=Article::find($id);
            Storage::delete('public/images/' . $produit->img);
            $produit->delete();

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
            return redirect('produit_index')->with('status', $output);
        }
        return redirect('produit')->with('status', $output);
    }

}
