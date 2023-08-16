<?php

use App\Models\Transaction;
use App\Models\Apropos;
use App\Models\TransactionLine;
use App\Models\Contact;

 function generateProductSku($string)
    {
        return str_pad($string, 4, '0', STR_PAD_LEFT);
    }

    function generateNoFacture($id)
    {
        return str_pad($id, 4, '0', STR_PAD_LEFT);
    }


    function imgLogo()
    {
        $aprop=Apropos::get();
        $apropos=$aprop->first();
        if(!empty($apropos->logo)){

	$path_image='/storage/images/'.$apropos->logo;
        }
        else{
    $path_image='/storage/images/default.pg';
        }
        return $path_image;
    }


    function createSellTransaction($input)
    {
        $sell=Transaction::create([
            'contact_id' => $input['contact_id'],
            'date_transactions' => $input['date_transactions'],
            'total_payment' => $input['payment'],
            'mode_payment' => $input['mode_payment'],
            'status' => $input['status'],
            'note' => $input['note'],
            'prix_total' => $input['prix_total'],
        ]);
        return $sell;
    }

    function updateSellTransaction($input,$id)
    {
        $sell=Transaction::find($id);
        $sell_update=[
            'contact_id' => $input['contact_id'],
            'date_transactions' => $input['date_transactions'],
            'total_payment' => $input['payment'],
            'mode_payment' => $input['mode_payment'],
            'status' => $input['status'],
            'prix_total' => $input['prix_total'],
            'note' => $input['note'],
        ];
      $sell->contact_id = $input['contact_id'];
      $sell->date_transactions = $input['date_transactions'];
      $sell->total_payment = $input['payment'];
      $sell->mode_payment = $input['mode_payment'];
      $sell->status = $input['status'];
      $sell->prix_total = $input['prix_total'];
      $sell->note = $input['note'];
    //   $sell->fill($sell_update);
      $sell->save();
        return $sell;
    }

    function createTransactionLine($produits,$sell)
    {

        foreach($produits as $produit){
            $transaction_line= TransactionLine::create([
                'transaction_id' => $sell->id,
                'article_id' => $produit['produit_id'],
                'qte' => $produit['qte'],
                'prix_unit' => $produit['prix_unit']
                // 'total_amount' => $produit['total_amount'],
            ]);
            return $transaction_line;
        }
    }


    function updateTransactionLine($produits,$id)
    {
        $transaction_lines= TransactionLine::where('transaction_id',$id);
        $arr_edit_id=array();
        foreach($produits as $produit){
            if(!empty($produit['transaction_line_id'])){
                //update
                $sell_line_update= TransactionLine::find($produit['transaction_line_id']);
               
                $sell_line_update->qte=$produit['qte'];
                $sell_line_update->prix_unit=$produit['prix_unit'];
                $sell_line_update->save();

                array_push($arr_edit_id,$produit['transaction_line_id']);

            }

            //create
            // if(empty($produit['transaction_line_id'])){
                else{
                
                $sell_line=[
                    'transaction_id' => $id,
                    'article_id' => $produit['produit_id'],
                    'qte' => $produit['qte'],
                    'prix_unit' => $produit['prix_unit']
                ];
                $tr_line=TransactionLine::create($sell_line);
                array_push($arr_edit_id,$tr_line->id);
            }

               
        }
        //delete
        $tr_line_delete = $transaction_lines->whereNotIn('id',$arr_edit_id);
        $tr_line_delete->delete();
        
          
        return $true;
    }

     function sellTotal(){
        $sell_total=Transaction::select(
            DB::raw('SUM(prix_total) as total_sell'),
            DB::raw("SUM(total_payment) as total_paid"),
            DB::raw('SUM(prix_total - total_payment) as total_due')
        )->first();
        return $sell_total;
    }

    function filter_result($date_start,$date_end){
        $sell_total=Transaction::select(
            DB::raw('SUM(prix_total) as total_sell'),
            DB::raw("SUM(total_payment) as total_paid"),
            DB::raw('SUM(prix_total - total_payment) as total_due')
        )->whereDate('transactions.date_transactions', '>=', $date_start)
        ->whereDate('transactions.date_transactions', '<=', $date_end)
        ->first();
return $sell_total;
    }

    ?>
