<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- <meta charset="utf-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        
      
          <script src="{{ public_path('js/popper.min.js') }}" type="text/javascript"></script>
          <script src="{{ public_path('js/bootstrap.min.js') }}" type="text/javascript"></script>
     
          <script src="{{ public_path('js/app.js') }}" defer></script>


      <!-- Styles -->
    <link rel="stylesheet" href="{{ public_path('css/bootstap.min.css') }}">
  
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
          <!-- @livewireStyles -->

      
      
</head>
<body>

<div class="container-fluid">
<div class="row">
	<!-- Logo -->
	<table class="">
		<tr>
		<td style="width:100px;">
	@if(!empty($apropos->logo))
  @php
      $img=$apropos->logo;
      $path=base_path('public/storage/images/'.$apropos->logo);
      $type=pathinfo($path,PATHINFO_EXTENSION);
      $data=file_get_contents($path);
      $image='data:image/'. $type . ';base64,' .base64_encode($data);
      @endphp

		<img style="max-height: 60px; width: auto;" src='{{$image}}'  class="img img-responsive center-block">
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
		<br/>
		@endif	

		<!-- Address -->
		@if(!empty($apropos->addresse))
				<small class="text-center">
				{!! $apropos->addresse !!}
				</small>
				<br/>
		@endif


        @if(!empty($apropos->number_phone1) || !empty($apropos->number_phone2))
		<b>Mobile:</b>	{{ isset($apropos->number_phone1) ? $apropos->number_phone1 : ''}} {{ isset($apropos->number_phone2) ? ','.$apropos->number_phone2 : ''}}
    <br/>
		@endif	
		
		<!-- Title of receipt -->
			<h3 class="text-center">
			Facture
			</h3>
      <br/>
</td>
	<td style="width: 100px;">
	</td>
	</tr>
	</table>

	<!-- business information here -->
		
</div>
      


<table class="table table-bordered table-responsive-lg ">
<tbody>
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
<td class="text-right" style="text-align:right;">
<div class="">
<b>Date:</b>
{{
  date('d-m-y', strtotime($sell->date_transactions)) 
}}
    
</div>
</td>

</tbody>

</tr>
</table>

   <br>
<div class="table-responsive"> 
<table class="table table-bordered table-responsive-lg ">
<thead>
<tr>

<th>#</th>
<th class="text-center">Produits</th>
<th class="text-center">Img</th>
<th class="text-center">Prix unitaire</th>
<th class="text-center">Qte</th>
<th class="text-center">prix total</th>
</tr>
</thead>

<tbody>
@foreach ($sell->sell_lines as $sell_line)
<tr>
<td>{{ $loop->iteration }}</td>
<td class="text-center">{{$sell_line->produit->nom}}</td>

<td class="text-center">@if(!empty($sell_line->produit->img))
@php
      $img=$apropos->logo;
      $path=base_path('public/storage/images/'.$apropos->logo);
      $type=pathinfo($path,PATHINFO_EXTENSION);
      $data=file_get_contents($path);
      $image='data:image/'. $type . ';base64,' .base64_encode($data);
      @endphp

<img style="max-height: 60px; width: auto;" src="{{$image}}" class="img img-responsive center-block">
@endif
</td>
<td class="text-center">{{$sell_line->prix_unit}} Ar</td>
<td class="text-center">{{$sell_line->qte}}</td>
<td class="text-center">{{number_format($sell_line->qte * $sell_line->prix_unit , 2)}} Ar</td>



</tbody>

</tr>
 @endforeach
</table>
</div>
<br>


<div class="col-md-6 col-sm-6 col-xs-6">
        <div class="table-responsive">
          <table class="table bg-gray table-responsive-lg ">
            <tr>
              <th>Total: </th>
              <td></td>
              <td style="text-align:right"><span  class="display_currency pull-right" data-currency_symbol="true">{{ $sell->prix_total }} Ar</span></td>
            </tr>
            <tr>
              <th>Total payé:</th>
              <td><b>(-)</b></td>
              <td><div style="text-align:right" class="pull-right"><span class="display_currency">{{ $sell->total_payment }} Ar</span> </span></div></td>
            </tr>
           
          
            <tr>
              <th>reste:</th>
              <td></td>
              <td style="text-align:right">
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


<!-- </div> -->

</body>
</html>