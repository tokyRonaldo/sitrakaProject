<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-titre" id="modalTitre">produit name</h4>
		    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  
	    </div>
        <div class="modal-body">
          
<div class="row">
<div class="col-md-4">
<b>facture No:</b>
{{$sell->no_facture}}
<br>
<b>Client:</b><br>
{{$sell->contact->surnom .' '.$sell->contact->nom}}
<br>
{{$sell->contact->number_phone}}
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
<b>Date:</b>
{{
  date('d-m-y', strtotime($sell->date_transactions)) 
}}
<br>
<b>Status payment:</b>
@php
$status=$sell->status;
@endphp
  @if($status == 'payer')
  <span class="name" style="color:green;"> payé </span>
  
  @else
  <span class="name" style="color:red;"> reste </span>
   
   @endif
<br>
<b>Mode payment:</b>
{{$sell->mode_payment}}
</div>
</div>
   <br>
<div class="table-responsive"> 
<table class="table table-bordered">
<thead>
<tr>

<th>#</th>
<th class="text-center">Produits</th>
<th class="text-center">Prix unitaire</th>
<th class="text-center">Qte</th>
<th class="text-center">price</th>
</tr>
</thead>

<tbody>
@foreach ($sell->sell_lines as $sell_line)
<tr>
<td>{{ $loop->iteration }}</td>
<td class="text-center">{{$sell_line->produit->nom}}</td>
<td class="text-center">{{$sell_line->prix_unit}} Ar</td>
<td class="text-center">{{$sell_line->qte}}</td>
<td class="text-center">{{$sell_line->qte * $sell_line->prix_unit}} Ar</td>



</tbody>

</tr>
 @endforeach
</table>
</div>
<br>
<div class="payment">
PAYMENT



 <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="table-responsive">
          <table class="table bg-gray">
            <tr>
              <th>Total: </th>
              <td></td>
              <td><span class="display_currency pull-right" data-currency_symbol="true">{{ $sell->prix_total }} Ar</span></td>
            </tr>
            <tr>
              <th>Total payé:</th>
              <td><b>(-)</b></td>
              <td><div class="pull-right"><span class="display_currency">{{ $sell->total_payment }} Ar</span> </span></div></td>
            </tr>
           
          
            <tr>
              <th>reste:</th>
              <td></td>
              <td>
                <!-- Converting total paid to string for floating point substraction issue -->
                   @if ($sell->total_payment >= $sell->prix_total)
                <span class="display_currency pull-right" data-currency_symbol="true" >{{ 0 }} Ar</span></td>
      @else 
                <span class="display_currency pull-right" data-currency_symbol="true" >{{ $sell->prix_total - $sell->total_paymenmt }} Ar</span></td>
      @endif 
            </tr>
          </table>
        </div>
      </div>
</div>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary no-print"
          aria-label="Print"
            onclick="$(this).closest('div.modal').printThis();">
          <i class="fa fa-print"></i> @lang( 'messages.print' )
        </button> -->
            <button type="button" class="btn btn-default no-print" data-dismiss="modal">close</button>
      </div>
    </div>

</div>
