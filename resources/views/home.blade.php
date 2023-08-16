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
            	<div class="col-md-3 col-sm-6 col-xs-12 col-custom">
            	   <div class="info-box info-box-new-style">
            	        <span class="info-box-icon bg-aqua"></i></span>

            	        <div class="info-box-content-blue">
            	          <span class="info-box-text">total purchasse</span>
            	          <span class="info-box-number total_purchase"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
						 <p class="total-purchasse">0.00 Ar</p> 
						</div>
            	        <!-- /.info-box-content -->
            	   </div>
        	       <!-- /.info-box -->
        	    </div>
        	    <!-- /.col -->
        	    <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
        	       <div class="info-box info-box-new-style">
            	        <span class="info-box-icon bg-aqua">
						</span>

            	        <div class="info-box-content-blue">
            	          <span class="info-box-text">total sell</span>
            	          <span class="info-box-number total_sell"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
            	         <p class="total-sell">{{$sell_total->total_sell ?? 0.00}} Ar</p>
						</div>
            	        <!-- /.info-box-content -->
        	       </div>
        	      <!-- /.info-box -->
        	    </div>
        	    <!-- /.col -->
        	    <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
        	       <div class="info-box info-box-new-style">
            	        <span class="info-box-icon bg-yellow">
            				 
            	        </span>

            	        <div class="info-box-content-yellow">
            	          <span class="info-box-text"> purchase paid</span>
            	          <span class="info-box-number purchase_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
            	         <p class="purchasse-paid">0.00 Ar</p> 
						</div>
        	       </div>
        	    </div>

        	    <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
        	        <div class="info-box info-box-new-style">
        	           <span class="info-box-icon bg-yellow">
        	           </span>

            	        <div class="info-box-content-yellow">
            	          <span class="info-box-text">sell paid</span>
            	          <span class="info-box-number invoice_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
            	         <p class="sell-paid">{{$sell_total->total_paid ?? 0}} Ar</p>
						</div>
        	        </div>

        	    </div>

				 <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
        	       <div class="info-box info-box-new-style">
            	        <span class="info-box-icon bg-yellow">

            	        </span>

            	        <div class="info-box-content-red">
						<i class="fa fa-exclamation"></i>
            	          <span class="info-box-text">purchase due</span>
            	          <span class="info-box-number purchase_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
					 <p class="purchasse-due">0.00 Ar</p>

						</div>
        	       </div>
        	    </div>

        	    <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
        	        <div class="info-box info-box-new-style">
        	           <span class="info-box-icon bg-yellow">

        	           </span>

            	        <div class="info-box-content-red">
						<i class="fa fa-exclamation"></i>
            	          <span class="info-box-text">sell due</span>
            	          <span class="info-box-number invoice_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>

						<p class="sell-due">{{$sell_total->total_due ?? 0.00}} Ar</p>
						</div>
        	        </div>

        	    </div>
        	    </div>
        	    </div>
        	    <br>

</div>
{{-- {# {{ render_chart(chart, {'class': 'my-chart'}) }}  --}}
@endsection
