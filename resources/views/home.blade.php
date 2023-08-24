@extends('layouts.app')

@section('container')
<div class="containt">
 <div class="header">
   <div class="row d-flex">
   <div class="col-sm-6 col-md-6 col-xs-12">
    <h1>Dashboard</h1>
    </div>
<div class="col-md-6 col-sm-6 col-xs-12">
{{-- {# <input class="form-control float-end" id="search_med" type="search" value="{{term}}" placeholder="Search" aria-label="Search" style="width:150px;"> #} --}}
 <div class="d-flex float-end">
 {{-- filter by date:  --}}
<br>
<div class="form-group">
<div class="input-group">
<span class="calendar" ><i class="fas fa-calendar fa-2xl fa-fw"></i></span>

<input type="text" id='daterangepicker' style="margin-left:-8px;" class="form-control" name="daterange" value="{{$date_start }} - {{$date_end}}" />
</div>
</div>
</div>
</div>
</div>
</div>
<br>

    {{-- value="{{medicament.datePeremp|date('Y-m-d') }}"  --}}
   <div class="container-fluid">
   <div class="row ">
            	
        	    <div class="col-md-4 col-sm-4 col-xs-12 col-custom text-center">
        	       <div class="info-box info-box-new-style">
            	        <span class="info-box-icon bg-aqua">
						</span>

            	        <div class="info-box-content-blue">
            	          <span class="info-box-text">Vente totale</span>
            	          <span class="info-box-number total_sell"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
            	         <p class="total-sell">{{$sell_total->total_sell ?? 0.00}} Ar</p>
						</div>
            	        <!-- /.info-box-content -->
        	       </div>
        	      <!-- /.info-box -->
        	    </div>
        	    <!-- /.col -->

        	    <div class="col-md-4 col-sm-4 col-xs-12 col-custom text-center">
        	        <div class="info-box info-box-new-style">
        	           <span class="info-box-icon bg-yellow">
        	           </span>

            	        <div class="info-box-content-yellow">
            	          <span class="info-box-text">Vente payé</span>
            	          <span class="info-box-number invoice_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
            	         <p class="sell-paid">{{$sell_total->total_paid ?? 0}} Ar</p>
						</div>
        	        </div>

        	    </div>


        	    <div class="col-md-4 col-sm-4 col-xs-12 col-custom text-center">
        	        <div class="info-box info-box-new-style">
        	           <span class="info-box-icon bg-yellow">

        	           </span>

            	        <div class="info-box-content-red">
						<i class="fa fa-exclamation"></i>
            	          <span class="info-box-text">Reste</span>
            	          <span class="info-box-number invoice_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>

						<p class="sell-due">{{$sell_total->total_due ?? 0.00}} Ar</p>
						</div>
        	        </div>

        	    </div>
        	    </div>
        	    </div>
        	    <br>
        	    <Hr>
				@if(!empty($produits))
				<H1 class="text-center">Produits</H1>
					<div class="some_product ">
				@foreach($produits as $produit)
				<div class="row justify-content-center ">
				<div class="col-8">
				<div class="" style="background-image: url('{{ asset('/storage/images/'.$produit->img) }}');width: 100%;height: 400px;background-size: cover; background-position: center;background-repeat: no-repeat;">
				<!-- <div class="row justify-content-center ">	 -->
				<div class="product_detail text-center" style="padding-top:100px;">
						{{ $produit->nom }}
						<br>
						{{ $produit->prix }}
					</div>
				</div>
				<!-- </div> -->
			</div>
				</div>
				<br>
				@endforeach
			</div>

        	    <Hr>
				@endif
		<div class="containt-apropos ">
		<div class="container-fluid">
		<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
        @if(!empty($apropos->number_phone1))
            <div class="telephone1">
            <b>Telephone1:</b>
            {{$apropos->number_phone1}}
            </div>
            <br>
        @endif
        @if(!empty($apropos->number_phone2))
            <div class="telephone2">
            <b>telephone2:</b>
            {{$apropos->number_phone2}}
            </div>
            <br>
        @endif
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
        @if(!empty($apropos->email))
            <div class="mail">
            <b>Mail:</b>
            {{$apropos->email}}
            </div>
            <br>
        @endif
		
		
        @if(!empty($apropos->facebook))
            <div class="facebook">
            <b>Facebook:</b>
            {{$apropos->facebook}}
            </div>
            <br>
        @endif
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
        @if(!empty($apropos->nif))
            <div class="nif">
            <b>Nif:</b>
            {{$apropos->nif}}
            </div>
            <br>
        @endif
        @if(!empty($apropos->state))
            <div class="state">
            <b>State:</b>
            {{$apropos->state}}
            </div>
            <br>
        @endif
		</div>
		</div>
		</div>
		</div>

</div>
{{-- {# {{ render_chart(chart, {'class': 'my-chart'}) }}  --}}
@endsection
