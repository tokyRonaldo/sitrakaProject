<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Apropos;
use App\Models\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $roles = session('roles');   //au cas Ou on a besoin de tout les roles
        // dd($roles);
        $date=new \DateTime();
        $sell_total=sellTotal();
        $date_start = $date->format('m-d-Y');
        $date_end = $date->format('m-d-Y');
        $input_start=$request->input('start');
        $input_end=$request->input('end');
        if(!empty($input_start) && !empty($input_end)){
            
            $sell_total=filter_result($input_start,$input_end);
            $date_start = $input_start;
        $date_end = $input_end;
        }
        
        $apropos = Apropos::first();
           
        $produits = Article::latest()->take(3)->get();
        // dd($sell->total_paid);
        return view('home')->with(compact(
            'sell_total',
            'date_start',
            'date_end',
            'produits',
            'apropos'

         ))
        ;
    }
}
