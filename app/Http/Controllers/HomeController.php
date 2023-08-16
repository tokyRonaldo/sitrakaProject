<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

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
        

        // dd($sell->total_paid);
        return view('home')->with(compact(
            'sell_total',
            'date_start',
            'date_end'

         ))
        ;
    }
}
