@extends('layouts.app')

@section('container')
<div class="containt">
<div class="container-fluid">
<div class="titre">
<h3>Creer facture</h3>
</div>
{!! Form::open([ 'action'=>['App\Http\Controllers\SellController@update', $sell->id ],'method'=>'post','id'=>'edit_facture_form','class'=>'facture_form','files' => true,'enctype' =>'multipart/form-data' ]) !!}
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('client', 'client:*') !!}
            {!! Form::select('client', 
							$clients, $sell->contact_id, ['class' => 'form-control mousetrap', 'id' => 'transaction_client','placeholder' => 'entrer client',  'required']); !!}
              <span class="input-group-btn">
                
								<a href="{{action('App\Http\Controllers\ClientController@createModal')}}" class="btn btn-default btn-modal bg-white btn-flat add_new_client" data-toggle="modal" data-target="#client_modal">add<i class="fa fa-plus-circle text-primary fa-lg"></i></a>
							</span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('status', 'status:*') !!}
            {!! Form::select('status', 
							['reste'=>'non payé','payer'=>'payé'], $sell->status, ['class' => 'form-control mousetrap', 'id' => 'status_payment', 'required']); !!}
              <span class="input-group-btn">
								<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
							</span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('date_transaction', 'date:*') !!}
            <div class="input-group date" id="datetimepicker">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
              {{ Form::text( 'date_transaction', $the_date, ['class'=>'form-control date','id'=>'date_transaction']) }}
              <!-- <input type="datetime-local" name="date_transaction" id="date_transaction" class="form-control date"  value="02/02/2015"> -->
            </div>
        </div>
    </div>
    </div>
    <br>
    <div class="row">
        <H2>Produits</H2>
      <div class="d-flex justify-content-center">
        <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('produits', 'produits:*') !!}
            <br>
            {!! Form::text('produits', null, ['class' => 'form-control','id' => 'search_produits', 'required',
              'placeholder' => 'search_produits']); !!}
        </div>
        </div>
        </div>

        <div class="d-flex justify-content-center" style="min-height: 0">
        <div class="col-sm-12 stpl_parcel_div">
				<input type="hidden" name="edit_dropshipping_lines" id="edit_sell_lines" value="1">
				<input type="hidden" id="produit_row_index" value="{{$count}}">
				<input type="hidden" id="count" value="0">
				<input type="hidden" id="total_amount" name="final_total" value="{{$sell->prix_total}}">
				<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped table-responsive" id="stpl_table">
						<thead>
						<tr>
						<th class="text-center" style="width: 120px;">sku</th>
							<th class="text-center" style="width: 200px;">produit</th>
							<th class="text-center" style="width: 120px;">qte</th>
							<th class="text-center" style="width: 180px;">prix unitaire</th>
							 <!-- <th class="text-center" style="width: 150px;">caracteristique</th>  -->
							<th class="text-center" style="width: 180px;">total</th>
							<th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
						</tr>
						</thead>
						<tbody>
                        @foreach($sell_lines as $sell_line)
                        @php
                        $i=0;
                        @endphp
                        <tr class="produit_row">
    <td class="text-center">
        {{$sell_line->produit->sku}}
    </td>
    <td class="text-center">
            <div>{{$sell_line->produit->nom}}</div>
    </td>
    <input type="hidden" class="produit_id" value="{{$sell_line->produit->id}}" name="produit[{{$i}}][produit_id]"/>
    <input type="hidden" class="transaction_line_id" value="{{$sell_line->id}}" name="produit[{{$i}}][transaction_line_id]"/>
    <td class="text-center">
        <input type="number" name="produit[{{$i}}][qte]" class="form-control qte_produit input_price" style="text-align: center;" value="{{$sell_line->qte}}">
    </td>
    <td class="text-center">
        <input type="number" name="produit[{{$i}}][prix_unit]" class="form-control prix_unit_produit input_price"  style="text-align: center;" value="{{$sell_line->prix_unit}}">
    </td>

    <td class="text-center">
        <input type="text" readonly name="produit[{{$i}}][total_amount]" class="form-control prix_produit_row" style="text-align: right;" value="{{$sell_line->prix_unit * $sell_line->qte}}">
    </td>
    <td class="text-center">
        <i class="fa fa-trash remove_produit_row cursor-pointer" aria-hidden="true"></i>
    </td>
</tr>
@php
$i++;
@endphp
@endforeach
						</tbody>
						<tfoot>
							
						<tr class="text-center">
							<td colspan="5"></td>
							
							<td><div class="pull-right"><b>Total amount:</b> <span id="total_amount_transaction">0.00Ar</span></div>
							</td>
						</tr>
						</tfoot>
					</table>
				</div>
				</div>

			</div>
			</div>

            <br>
            
            <div class="row">
            <div class="col-sm-6">
            <div class="form-group ">
 <label for="note">Note:</label>
    <textarea name="note" id="note" class="form-control" value="{{$sell->note}}" style="height:100px;" ></textarea>
</div>
</div>
</div>
            <br>
           
                <div id="payment">
                <H2>
                Payment
                </H2>
                
                <div class="row">
                <div class="col-sm-4">
                <div class="form-group">
                {!! Form::label('mode_payment', 'mode payment:*') !!}
                {!! Form::select('mode_payment', 
							[0=>'cache',1=>'banque'], 'cache', ['class' => 'form-control', 'id' => 'mode_payment', 'required']); !!}
                </div>
                </div>
                </div>

                <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                <label for="payment">payé:</label>

                <!-- <input type="number" name="payment" value="{{$sell->payment}}" id="payment_amount" class="form-control" required /> -->
                {!! Form::number('payment', $sell->total_payment, array('class' => 'form-control input_payment','id' => 'payment_amount','required')) !!}

                </div>

                </div>

            </div>     
    </div>
        <div class="row">
			<div class="col-sm-12">
				<div class="float-end"><strong>reste:</strong> <span class="balance_due">0.00Ar</span></div>
			</div>
		</div>
        <br>

      <div class="row">
      <div class="col-sm-12 ">
      <button type="submit" class="btn btn-primary submit_product_form float-end" >Ajouter</button>
      </div>
      </div>
      

{!! Form::close() !!}

                </div>
<div id="client_modal" class="modal client_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
    </div>

@stop
@section('javascript')
<script type="text/javascript">
        $(document).ready( function () {
            var arr_of_ids = [];
            
    //disabled input type 
    	$('#status_payment').prop('disabled',true);
			$('form').bind('submit', function () {
				$('#status_payment').prop('disabled', false);
         });

         $('#mode_payment').prop('disabled',true);
			$('form').bind('submit', function () {
				$('#mode_payment').prop('disabled', false);
         });


       
            
    //datetimepicker
    // $('.date').datetimepicker();
    $( "#date_transaction" ).datepicker();


    
    //get transaction client
    // $('#transaction_client').select2({
    //     ajax: {
    //         url: '/contacts/customers',
    //         dataType: 'json',
    //         delay: 250,
    //         data: function (params) {
    //             return {
    //                 q: params.term, // search term
    //                 page: params.page,
    //             };
    //         },
    //         processResults: function (data) {
    //             return {
    //                 results: data,
    //             };
    //         },
    //     },
    //     templateResult: function (data) {
    //         var template = '';
    //         if (data.supplier_business_name) {
    //             template += data.supplier_business_name + "<br>";
    //         }
    //         template += data.text + "<br>" + LANG.mobile + ": " + data.mobile;

    //         if (typeof (data.total_rp) != "undefined") {
    //             var rp = data.total_rp ? data.total_rp : 0;
    //             template += "<br><i class='fa fa-gift text-success'></i> " + rp;
    //         }

    //         return template;
    //     },
    //     minimumInputLength: 1,
    //     language: {
    //         inputTooShort: function (A) {
    //             var length = A.minimum - A.input.length;
    //             return __translate('please_enter_characters', {length: length});
    //         }
    //     },
    //     escapeMarkup: function (markup) {
    //         return markup;
    //     },
    // });

    // $('#transaction_client').on('select2:select', function (e) {
    //     var data = e.params.data;
    //     var id = data.id;
    //     $('#selected_customer').val(id);
    // });
    $('#transaction_client').select2();

    disable_selected();
    update_price();
    update_table_total();
    update_reste();

    $(document).on('click','.add_new_client',function(e){
        // let id = $(this).data('id');
        var href = $(this).attr('href');

        $.ajax({
                url:href,
                type:'get',
                // data:{'id':id, '_token': token},
                success: function(data) {
                console.log(data)
                $('#client_modal').html(data);
                }
                });

      });

    
    //   $(document).on('click','.submit_client_form',function(e){
    //     alert('click');
    //     e.preventDefault();
    //   var href = $(this).attr('href');
    //   var form_contact = $('form.client_modal_form').attr('action');
    //   alert(form_contact);

    //     $.ajax({
    //             url:form_contact,
    //             type:'post',
    //             // data:{'id':id, '_token': token},
    //             success: function(data) {
    //             console.log(data)
    //             $('#transaction_client').val(data['client_id']);
    //             }
    //             });
    // //   modal.hide();

    // //   });
    //   return false;
      
    //   });

    //   var form_contact = $('form.client_modal_form');
    // $('.client_modal_form')
    //    .submit(function (e) {
    //     e.preventDefault();
    //     alert('submit');
    //    }) 
    //    .validate({
    //     rules: {
    //         // client: {
    //         //     required: true
    //         // },
    //         nom: {
    //             required: true
    //         }
        
    //     },
    //     messages: {
    //         // client: {
    //         //     remote: 'required',
    //         // },
    //         nom: {
    //             // remote: LANG.required,
    //              remote: 'required',
    //         }
           
    //     },
    //      submitHandler: function (form_contact) { // for demo
            
    //         form_contact.submit();
    // }
      
        
    // });


    //search_product

    // if ($('#search_produits').length > 0) {
    //     // alert('hello');

    $('#search_produits')
            .autocomplete({
                source: function (request, response) {
                    $.getJSON(
                        '/produit/list-produits',
                        {
                            // customer_id: $('#selected_customer').val(),
                            term: request.term
                        },
                        response
                    );
                },
                minLength: 2,
                response: function (event, ui) {
                    if (ui.content.length == 0) {
                        // swal('no_products_found');
                        return('pas de produit');
                    }
                
                },
                select: function (event, ui) {
                transaction_parcel_row(ui.item.id);
                },
            })
            .autocomplete('instance')._renderItem = function (ul, item) {
                var produit_id = parseInt(item.id);
                var sku = parseInt(item.sku);
                var prix = item.prix;
                var disable_id=produit_id;
                var disabled_id=parseInt(disable_id);
                // var product = item.products;
                var nom = item.nom != null ? item.nom : '';
               
                var string = '<div>' + nom;
                string += ' (' + sku + ')' + '<br> ' + prix + '</div>';
                if (arr_of_ids.includes(disabled_id)) {
                    return $('<li class="ui-state-disabled">')
                        .append(string)
                        .appendTo(ul);
                } else {
                    return $('<li>')
                        .append(string)
                        .appendTo(ul);
                }
            }
           
        // }
    

    function transaction_parcel_row(produit_id) {
        var row_index = parseInt($('#produit_row_index').val());
        var count = parseInt($('#count').val());
        var is_edit=parseInt($('#edit_sell_lines').val());

        $.ajax({
            method: 'GET',
            // url: '/dropshipping/get-product-row',
            url: '/produit/get-produit-row',
            data: {row_index: row_index, produit_id: produit_id, is_edit: is_edit, count: count},
            dataType: 'html',
            success: function (result) {
                // console.log("success");
                $('table#stpl_table tbody').append(result);
                
               
                update_price();
                update_table_total();
                update_payment();
                update_reste();
               disable_selected();
               update_status_payment();
               
    
                $('#produit_row_index').val(row_index + 1);
            }
        });
    }


    $(document).on('change','.input_price',function(){
    //    var tr= $(this).closest('tr');
    update_price();
    update_table_total();
    update_payment();
    update_reste();
    update_status_payment();
  
    });

    $(document).on('change','.input_payment',function(){
    //    var tr= $(this).closest('tr');
    update_reste();
    update_status_payment();
  
    });
 

      //Remove row on click on remove row
      $('table#stpl_table').on('click', '.remove_produit_row', function() {
        $(this)
            .parents('tr')
            .remove();
            update_table_total();
            udpate_payment();
    update_reste();
    update_status_payment();
    disable_selected();
    });

    // les fonctions

    function disable_selected(){
        $('table#stpl_table tbody tr').each(function (e) {
            var produit_id = $(this).find('input.produit_id').val();
            // var variation_id = __read_number($(this).find('input.variation_id'));
            // var disable_id=''+product_id+variation_id;
            var disabled_id=parseInt(produit_id)
            if (disabled_id === undefined || arr_of_ids.indexOf(disabled_id) !== -1) {
                return;
            }
            arr_of_ids.push(disabled_id);
            // var tr_obj = $(this);
            // final_total(tr_obj);
       
        });
        
        
    }



    function update_price(){
        $('table#stpl_table tbody').find('.produit_row').each(function(e){
            var tr=$(this);
            
       var qte=parseFloat(tr.find('.qte_produit').val());
   

       var prix_unit=parseFloat(tr.find('.prix_unit_produit').val());


    if(tr.find('.qte_produit').val()==''){
        var qte=parseFloat(0);
        tr.find('.qte_produit').val(qte);
    }
 


    if(tr.find('.prix_unit_produit').val()==''){
        var prix_unit=parseFloat(0.00);
        tr.find('.prix_unit_produit').val(prix_unit);
    }
  
        //   var the_total=$(this).find('input.product_price_total').val();
        // var this_total = parseFloat(the_total);
        var prix=qte*prix_unit;

       var total=prix.toFixed(2);
    //    .toFixed(2);
       tr.find('.prix_produit_row').val(total);
     
        });
    }


    function update_table_total() {
    var table_total = 0;
    $('table#stpl_table tbody tr').each(function () {
        var the_total=$(this).find('input.prix_produit_row').val();
        var this_total = parseFloat(the_total);
        // console.log(this_total.toFixed(2));
        // var the_total= this_total.toFixed(2);
        if (this_total) {
            table_total += this_total;
        }
    });
    $('input#total_amount').val(table_total.toFixed(2));
    $('span#total_amount_transaction').text(table_total.toFixed(2));
    // $('input#payment_amount').val(table_total);
  
}

function update_payment(){
    var table_total = 0;
    $('table#stpl_table tbody tr').each(function () {
        var the_total=$(this).find('input.prix_produit_row').val();
        var this_total = parseFloat(the_total);
        // console.log(this_total.toFixed(2));
        // var the_total= this_total.toFixed(2);
        if (this_total) {
            table_total += this_total;
        }
    });
    
    $('input#payment_amount').val(table_total);
}


function update_status_payment(){
            var total_amount=parseFloat($('input#total_amount').val());
            var t_amount=total_amount.toFixed(2);
            var total_paid=parseFloat($('input#payment_amount').val());
            var t_paid=total_paid.toFixed(2);
            alert(t_amount);
            alert(t_paid);
            if( t_paid >= t_amount ){
                // alert ('paid');
                $("#status_payment").val('payer');
                // alert('paye');
            }
            else{
                // alert('due')
                $("#status_payment").val('reste'); 
                // alert('non paye');
            }
      
        } 


        function update_reste(){
            var total_amount= $('input#total_amount').val();
            var p_total_amount=parseFloat(total_amount);

            var payment=$('input#payment_amount').val();
            var p_payment=parseFloat(payment);

            var reste=p_total_amount - p_payment;
console.log(reste);
            if(reste >= 0){
                $('span.balance_due').text(reste.toFixed(2));
            }
            else{
                $('span.balance_due').text(0.00);
            }
        }


    });
  </script>
@endsection
