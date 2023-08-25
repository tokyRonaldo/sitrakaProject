<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Apropos;
use DataTables;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
            $data = Apropos::first();
           
        return view('apropos.index', [
             'apropos' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apropos.create', [
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
        $data = Apropos::first();
        if(empty($data)){
            try{
                $apropos_detail['nom']=$request->input('nom');
                $apropos_detail['logo']=$request->input('logo');
                $apropos_detail['nif']=$request->input('nif');
                $apropos_detail['state']=$request->input('state');
                $apropos_detail['number_phone1']=$request->input('number_phone1');
                $apropos_detail['number_phone2']=$request->input('number_phone2');
                $apropos_detail['email']=$request->input('email');
                $apropos_detail['facebook']=$request->input('facebook');
                $apropos_detail['description']=$request->input('description');

                if ($request->hasFile('logo')) {
    
                $filenameWithExt = $request->file('logo')->getClientOriginalName ();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $request->file('logo')->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                // Upload Image
                $path = $request->file('logo')->storeAs('public/images', $fileNameToStore);
                }
                else {
                $fileNameToStore = 'noimage.jpg';
                }
    
                
    
                $apropos_detail['logo']=$fileNameToStore;

                $apropos=Apropos::create($apropos_detail);

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
        
        
            return redirect('apropos')->with('status', $output);
        }
        return redirect('apropos');
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
        $apropos=Apropos::find($id);
        return view('apropos.edit', [
             'apropos' => $apropos
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
        $apropos=Apropos::find($id);
        try{
            $apropos_detail['nom']=$request->input('nom');
            $apropos_detail['logo']=$request->input('logo');
            $apropos_detail['nif']=$request->input('nif');
            $apropos_detail['state']=$request->input('state');
            $apropos_detail['number_phone1']=$request->input('number_phone1');
            $apropos_detail['number_phone2']=$request->input('number_phone2');
            $apropos_detail['email']=$request->input('email');
            $apropos_detail['facebook']=$request->input('facebook');
            $apropos_detail['description']=$request->input('description');
            if ($request->hasFile('logo')) {
    
                $filenameWithExt = $request->file('logo')->getClientOriginalName ();
                // Get Filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just Extension
                $extension = $request->file('logo')->getClientOriginalExtension();
                // Filename To store
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                // Upload Image
                $path = $request->file('logo')->storeAs('public/images', $fileNameToStore);
                }
                else {
                $fileNameToStore = 'noimage.jpg';
                }
    
                $apropos_detail['logo']=$fileNameToStore;

            $apropos=$apropos->update($apropos_detail);
            
            // $apropos->save();

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
        return redirect('apropos')->with('status', $output);
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
            $apropos=Apropos::find($id);
            $apropos->delete();

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
            return redirect('apropos')->with('status', $output);
        }
        return redirect('apropos')->with('status', $output);
    }

}
