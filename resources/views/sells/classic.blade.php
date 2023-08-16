<!-- business information here -->

<div class="row">
<!-- Logo -->
	<table class="">
		<tr>
		<td style="width:100px;">
	@if(!empty($apropos->logo))

	<img style="max-height: 60px; width: auto;" src="{{asset('/storage/images/'.$apropos->logo)}}" class="img img-responsive center-block">
	@endif
	</td>
	<td class="text-center">
	<!-- Header text -->
	@if(!empty($apropos->nom))
		<div class="col-xs-12">
			<h1>{!! $apropos->nom !!}</h1>
		</div>
	@endif

		@if(!empty($apropos->nif) && !empty($apropos->state))
		<b>Nif:</b>{!! $apropos->nif !!},<b>Stat:</b>{!! $apropos->state !!}
		@endif	


		<!-- Address -->
		@if(!empty($apropos->addresse))
				<small class="text-center">
				{!! $apropos->addresse !!}
				</small>
		@endif


		@if(!empty($apropos->number_phone1) || !empty($apropos->number_phone2))
		<br/><b>Mobile:</b>	{{ isset($apropos->number_phone1) ? $apropos->number_phone1 : ''}} {{ isset($apropos->number_phone2) ? ','.$apropos->number_phone2 : ''}}
		@endif	
		
		<!-- Title of receipt -->
			<h3 class="text-center">
			invoice
			</h3>

</td>
	<td style="width:100px;">
	</td>
	</tr>
	</table>

	<!-- business information here -->
		
</div>
      

<table class="table table-responsive-lg ">

<tr>
<td>
<div class="col-md-4">
    
<b>facture No:</b>
{{$sell->no_facture}}
<br>
<b>Client:</b><br>
{{$sell->contact->surnom .' '.$sell->contact->nom}}
<br>
{{$sell->contact->number_phone}}
</div>
</td>
<td style="text-align:right;">
<b>Date:</b>
{{
  date('d-m-y', strtotime($sell->date_transactions)) 
}}
</td>


</tr>
</table>
<!-- 
<p >
<span style="bg-color:red;" class="pull-left text-center">
<b>facture No:</b>
{{$sell->no_facture}}
<br>
<b>Client:</b><br>
{{$sell->contact->surnom .' '.$sell->contact->nom}}
<br>
{{$sell->contact->number_phone}}
<br>
</span>
<span class="pull-right text-right">
<b>Date:</b>
{{
  date('d-m-y', strtotime($sell->date_transactions)) 
}}
</span>
</p> -->

<br>
	

<div class="table-responsive"> 
<table class="table table-bordered">
<thead>
<tr>

<th>#</th>
<th class="text-center">Produits</th>
<th class="text-center">Img</th>
<th class="text-center">Prix unitaire</th>
<th class="text-center">Qte</th>
<th class="text-center">Prix total</th>
</tr>
</thead>

<tbody>
@foreach ($sell->sell_lines as $sell_line)
<tr>
<td>{{ $loop->iteration }}</td>
<td class="text-center">{{$sell_line->produit->nom}}</td>
<td class="text-center">
@if(!empty($sell_line->produit->img))
@php $product_img=$sell_line->produit->img; @endphp
<img style="max-height: 60px; width: auto;" src="{{$sell_line->produit->getImageUrl()}}" class="img img-responsive center-block">
img
@endif
</td>
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


<div class="row">
	<div class="col-xs-12">
		<br/>
		@php
			$p_width = 40;
		@endphp
	
	</div> 
</div>

<div class="row">
	<div class="col-md-12"><hr/></div>
	<div class="col-xs-6">

		
	</div>

	<div class="col-xs-6">
        <div class="table-responsive">
        </div>
    </div>

