<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Contact;
use App\Models\Apropos;
use Illuminate\Support\Facades\DB;
// use PhpParser\Node\Stmt\TryCatch;
use DataTables;
use PDF;

class SellController extends Controller
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
            $data = Transaction::orderBy('transactions.date_transactions','DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $html =
                    '<div class="btn-group"><button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">action<span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-left" role="menu">';
                    $html .= '<li><a href="'. action('App\Http\Controllers\SellController@show', [$row->id]) .'" class="btn-modal view-sell-modal" data-toggle="modal" data-target="#view_modal"><i class="fa fa-eye"></i>show</a></li>';
                    $html .= '<li><a href="'. action('App\Http\Controllers\SellController@edit', [$row->id]) .'" class="edit-sell"><i class="fas fa-edit"></i>edit</a></li>';
                    $html .= '<li><a  href="'. action('App\Http\Controllers\SellController@destroy', [$row->id]) .'" class="delete-sell"><i  class="fa fa-trash"></i>delete</a></li>';
                    $html .= '<li><a target="_blank" href="'. action('App\Http\Controllers\SellController@SellPdf', [$row->id]) .'" class="delete-sell"><i  class="fa fa-trash"></i>pdf</a></li>';
                    // $html .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">edit</a>';
                    $html .= '<li><a href="#" class="print-invoice" data-href="' . action('App\Http\Controllers\SellController@printInvoice', [$row->id]) . '"><i class="fas fa-print" aria-hidden="true"></i> imprimer</a></li>';
                    $html .= '</ul></div>';
                    return $html;
                })
                ->addColumn('no_facture', function($row){
                    $no_facture='<div class="name">' .$row->no_facture.'</div>';
                    return $no_facture;
                })
                ->addColumn('contact', function($row){
                    $contact='<div class="name">' .$row->contact->nom.'</div>';
                    return $contact;
                })
                // ->addColumn('sku', function($row){
                //     $sku='<span>' .$row->sku.'</span>';
                //     return $sku;
                // })
                ->addColumn('date_transactions', function($row){
                    $date=$row->date_transactions;
                    $the_date=date('d-m-Y',strtotime($date));
                    $date_transaction='<div class="name">' .$the_date.'</div>';
                    return $date_transaction;
                })
                ->addColumn('status', function($row){
                    $status=$row->status;
                    if($status == 'payer'){
                    $status='<p class="name" style="color:green;"> payé </p>';
                    }
                    if($status == 'rest'){
                        $status='<p class="name" style="color:red;"> reste </p>';
                        }
                    return $status;
                })
                ->addColumn('prix_total', function($row){
                    $prix_total='<div class="name">' .$row->prix_total.'Ar</div>';
                    return $prix_total;
                })
                ->addColumn('total_payment', function($row){
                    $total_paye='<div class="name">' .$row->total_payment.'Ar</div>';
                    return $total_paye;
                })
                ->addColumn('due', function($row){
                    $due=$row->prix_total - $row->total_payment;
                    if($due < 0){
                    $reste='<div class="name">0.00ar</div>';   
                    }
                    else{
                    $reste='<div class="name">'.$due.'ar</div>';   
                    }
                    
                    return $reste;
                })
                
            
                ->rawColumns(['action','no_facture','contact','date_transactions','status','prix_total','total_payment','due'])
                ->make(true);
        }
        return view('sells.index', [
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
        $sells=Transaction::all();
        $date = new \DateTime('NOW');
        // $newDateFormat2 = date('d/m/Y', strtotime($date));
        $default_datetime=$date->format('d-m-Y');
        //  $carbon = Carbon\Carbon::now();
        //  dd($default_datetime);
        $clients = Contact::all()->pluck('nom', 'id');
        $aprop=Apropos::get();
        $apropos=$aprop->first();
        $transaction = Transaction::find(3);
        return view('sells.create')
         ->with(compact(
            'clients',
            'apropos',
            'transaction',
            'default_datetime',
            'sells'

         ))
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
            if (empty($request->input('client') || $total_amount || $client)){
                return redirect('sell');
                }
            $input['contact_id']=$request->input('client');
            $input['status']=$request->input('status');
            $date=$request->input('date_transaction');
            $the_date = date('Y-m-d H:i:s',strtotime($date));
            $input['date_transactions']=new \DateTime($the_date);
            $input['prix_total']=$request->get('final_total');
            $input['note']=$request->get('note');
            $produits=$request->get('produit');

              //payment
            $input['mode_payment']=$request->get('mode_payment');
            $input['payment']=$request->get('payment');
            
            //add on db
            $sell=createSellTransaction($input);
            $sell_line=createTransactionLine($produits,$sell);
            //no_facture
            $no_facture= generateNoFacture($sell->id);
            $sell->no_facture=$no_facture;
            $sell->save();

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
            return redirect('sell')->with('status', $output);
        }
        return redirect('sell')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
           $sell=Transaction::findOrFail($id);
           $aprop=Apropos::get();
           $apropos=$aprop->first();

            return view('sells.show')->with(compact(
                'sell',
                'apropos'

            ));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sell=Transaction::find($id);
        $the_date = date('d-m-Y',strtotime($sell->date_transactions));
        $sell_lines=$sell->sell_lines;
        // dd($sell_lines);
        $count=$sell_lines->count();
        $clients = Contact::all()->pluck('nom', 'id');

        return view('sells.edit')
         ->with(compact(
            'sell',
            'the_date',
            'sell_lines',
            'clients',
            'count'
         ))
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

        // dd($request);
        try{
            if (empty($request->input('client') || $total_amount || $client)){
                return redirect('sell');
                }
            $input['contact_id']=$request->input('client');
            $input['status']=$request->input('status');
            $date=$request->input('date_transaction');
            $the_date = date('Y-m-d H:i:s',strtotime($date));
            $input['date_transactions']=new \DateTime($the_date);
            $input['prix_total']=$request->get('final_total');
            $input['note']=$request->get('note');
            $produits=$request->get('produit');

              //payment
            $input['mode_payment']=$request->get('mode_payment');
            $input['payment']=$request->get('payment');

        
            
            //add on db
            $sell=updateSellTransaction($input,$id);
            $sell_lines=updateTransactionLine($produits,$id);

          

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
            return redirect('sell')->with('status', $output);
        }
        return redirect('sell')->with('status', $output);

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
            $sell=Transaction::find($id);
            $sell_lines=$sell->sell_lines;
            foreach($sell_lines as $sell_line){
                $sell_line->delete();
            }
            $sell->delete();

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
        return redirect('sell')->with('status', $output);
    }

    public function SellPdf($id) 
    {
        // dd('helo');
        $sell=Transaction::findOrFail($id);
        $apropos=Apropos::get()->first();
        // dd($apropos);
        $pdf = PDF::
        // setOptions(['isRemoteEnabled' => true])
        // ->
        loadView('sells.sell_pdf',  [
            'sell' =>$sell,
            'apropos' =>$apropos
        ]);
        // ->setOptions(['defaultFont' => 'sans-serif']);
        // :setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('reports.invoiceSell')->stream();


        return $pdf->download('sell.pdf');
    }


    
    /**
     * Prints invoice for sell
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function printInvoice(Request $request, $id)
    {
        if (request()->ajax()) {
            try {
                $output = ['success' => 0,
                        'msg' => trans("messages.something_went_wrong")
                        ];

              
            $sell=Transaction::findOrFail($id);

                if (empty($sell)) {
                    return $output;
                }

            $layout =  'sells.classic';
                    $sell=Transaction::findOrFail($id);
                    $aprop=Apropos::get();
                    $apropos=$aprop->first();
        
        
                    $test = view($layout, compact('sell','apropos'))->render();
                
                

                // if (!empty($receipt)) {
                    $output = ['success' => 1, 'receipt' => $test];
                // }
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                
                $output = ['success' => 0,
                        'msg' => trans("messages.something_went_wrong")
                        ];
            }

            return $output;
        }
    }

    
    /**
     * Returns the content for the receipt
     *
     * @param  int  $business_id
     * @param  int  $location_id
     * @param  int  $transaction_id
     * @param string $printer_type = null
     *
     * @return array
     */
    private function receiptContent(
    
        
        $transaction_id
    ) { 
        $output = [
                    // 'is_enabled' => false,
                    // 'print_type' => 'browser',
                    'html_content' => null,
                    // 'printer_config' => [],
                    'data' => []
                ];


        $receipt_details = $this->getReceiptDetails($transaction_id);

            $layout =  'sells.classic';
            $sell=Transaction::findOrFail($transaction_id);
            $aprop=Apropos::get();
            $apropos=$aprop->first();


            $output['html_content'] = view($layout, compact('sell','apropos'))->render();
        // }
        
        return $output;
    }


    
    /**
     * Gives the receipt details in proper format.
     *
     * @param int $transaction_id
     * @param int $location_id
     * @param object $invoice_layout
     * @param array $business_details
     * @param array $receipt_details
     * @param string $receipt_printer_type
     *
     * @return array
     */
    public function getReceiptDetails($transaction_id)
    {
        // $il = $invoice_layout;

        $transaction = Transaction::find($transaction_id);

        // //Invoice info
        $output['invoice_no'] = "no";

        //Additional notes
        $output['footer_text'] = 'footer';
        
                return (object)$output;
    }

}
