@extends('layouts.app')

@section('container')
<div class="containt">
<div class="container-fluid">
<h3>Creer facture</h3>
</div>
<div class="container-fluid">
{!! Form::open(['url'=> action('App\Http\Controllers\SellController@store'),'method'=>'post','id'=>'creer_facture_form','class'=>'facture_form','files' => true,'enctype' =>'multipart/form-data' ]) !!}
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('client', 'client:*') !!}
            <div class="input-group">
            {!! Form::select('client', 
							$clients, null, ['class' => 'form-control mousetrap', 'id' => 'transaction_client','placeholder' => 'entrer client',  'required']); !!}
              <span class="input-group-btn">
                
								<a href="{{action('App\Http\Controllers\ClientController@createModal')}}" class="btn btn-default btn-modal bg-white btn-flat add_new_client" data-toggle="modal" data-target="#client_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></a>
							</span>
        </div></div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('status', 'status:*') !!}
            {!! Form::select('status', 
							['reste'=>'non payé','payer'=>'payé'], 'reste', ['class' => 'form-control mousetrap', 'id' => 'status_payment', 'required']); !!}
             
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('date_transaction', 'date:*') !!}
            <div class="input-group date" id="datetimepicker">
							<span class="input-group-addon">
								<i style="margin-right:1px;" class="fa fa-calendar fa-2x"></i>
							</span >
              {{ Form::text( 'date_transaction', $default_datetime, ['class'=>'form-control date','id'=>'date_transaction']) }}
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
            {!! Form::text('produits', null, ['class' => 'form-control','id' => 'search_produits', 'required','placeholder' => 'search produits',
              ]); !!}
        </div>
        </div>
        </div>

        <div class="d-flex justify-content-center" style="min-height: 0">
        <div class="col-sm-10 stpl_parcel_div">
				<input type="hidden" name="edit_dropshipping_lines" id="edit_sell_lines" value="0">
				<input type="hidden" id="produit_row_index" value="0">
				<input type="hidden" id="count" value="0">
				<input type="hidden" id="total_amount" name="final_total" value="0">
				<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped table-responsive" id="stpl_table">
						<thead>
						<tr>
							<th class="text-center" style="width: 120px;">sku</th>
							<th class="text-center" style="width: 250px;">produit</th>
							<th class="text-center" style="width: 120px;">qte</th>
							<th class="text-center" style="width: 180px;">prix unitaire</th>
							 <!-- <th class="text-center" style="width: 150px;">caracteristique</th>  -->
							<th class="text-center" style="width: 180px;">total</th>
							<th class="text-center" ><i class="fas fa-times" aria-hidden="true"></i></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
							
						<tr class="text-center">
							<td colspan="5"></td>
							
							<td><div class="pull-right"><b>Total amount:</b> <span id="total_amount_transaction">0.00</span>Ar</div>
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
    <textarea name="note" id="note" class="form-control" style="height:100px;" ></textarea>
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
							['cache'=>'cache','banque'=>'banque'], 'cache', ['class' => 'form-control', 'id' => 'mode_payment', 'required']); !!}
                </div>
                </div>
                </div>

                <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                <label for="payment">payé:</label>

                <!-- <input type="number" name="payment" value="0.00" id="payment_amount" class="form-contro payment input_payment" required /> -->
                {!! Form::number('payment', 0.00, array('class' => 'form-control input_payment','id' => 'payment_amount','required')) !!}
                </div>

                </div>

            </div>     
    </div>
        <div class="row">
			<div class="col-sm-12">
				<div class="float-end"><strong>reste:</strong> <span class="balance_due">0.00</span>Ar</div>
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

    $(document).on('click','.add_new_client',function(e){
        // let id = $(this).data('id');
        var href = $(this).attr('href');

        $.ajax({
                url:href,
                type:'get',
                // data:{'id':id, '_token': token},
                success: function(data) {
                // console.log(data)
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

    if ($('#search_produits').length > 0) {
    var val=$('#search_produits').val();
        // alert(val);

    $('#search_produits')
            .autocomplete({
                source: function (request, response) {
                    $.getJSON(
                        '/produit/list-produits',
                        {
                            // customer_id: $('#selected_customer').val(),
                            term: request.term
                        },
                        response,
                        // console.log(response)
                    );
                },
                minLength: 2,
                response: function (event, ui) {
                    if (ui.content.length == 0) {
                        // swal('no_products_found');
                        return('pas de produit');
                    }
                // alert('hello1');
                },
                select: function (event, ui) {
                transaction_parcel_row(ui.item.id);
                },
            })
            .autocomplete('instance')._renderItem = function (ul, item) {
                // alert('hello2');
                var produit_id = parseInt(item.id);
                var sku = parseInt(item.sku);
                var prix = item.prix;
                var disable_id=produit_id;
                var disabled_id=parseInt(disable_id);
                // var product = item.products;
                var nom = item.nom != null ? item.nom : '';
               
                var string = '<div>' + nom;
                string += ' (' + sku + ')' + '<br> ' + prix + '</div>';
                // alert(string);
                if (arr_of_ids.includes(disabled_id)) {
                    // alert('arrofids');
                    return $('<li class="ui-state-disabled">')
                        .append(string)
                        .appendTo(ul);
                } else {
                    // alert('notarrofids');
                    return $('<li>')
                        .append(string)
                        .appendTo(ul);
                }
            }
           
        }
    
//    .autocomplete('instance')._renderItem = function (ul, item) {
//                 console.log(item);
//                 var medicament_id = parseInt(item.medicament_id);
//                 var disable_id=medicament_id;
//                 var disabled_id=parseInt(disable_id);
//                 // var product = item.products;
//                 var name = item.name != null ? item.name : '';
//                 require('jquery-ui/ui/widgets/autocomplete.js');
//                 var string = '<div>' + name + '</div>';
//                 // string += ' (' + sku + ')' + '<br> ' + price + '</div>';
//                 if (arr_of_ids.includes(disabled_id)) {
//                     return $('<li class="ui-state-disabled">')
//                         .append(string)
//                         .appendTo(ul);
//                 } else {
//                     return $('<li>')
//                         .append(string)
//                         .appendTo(ul);
//                 }
//             }
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
                update_table_total();
               
                update_price();
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
        // alert('hello');
        $(this)
            .parents('tr')
            .remove();
            update_table_total();
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
    $('input#payment_amount').val(table_total);
    // update_status_payment();
  
}


function update_status_payment(){
            var total_amount=parseFloat($('input#total_amount').val());
            var t_amount=total_amount.toFixed(2);
            var total_paid=parseFloat($('input#payment_amount').val());
            var t_paid=total_paid.toFixed(2);
            // alert(t_amount);
            // alert(t_paid);
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
            if(reste >= 0){
                $('span.balance_due').text(reste.toFixed(2));
            }
            else{
                $('span.balance_due').text(0.00);
            }
        }

// $('.modal .submit_client_form').on('click',function(){
//     alert('hello');
// });
// $(document).getElementByClass('add_new_client').on('cick',function(){
//     alert('helo');
// });

// $('#client_modal').on('show.bs.modal', function(e) {
 
//  var id = $(e.relatedTarget).data('id');
//  var txt = $(this).find('input[id="txt"]');

//  $(this).find('button[id="valider"]').click(function() {
// //    alert(id);
//    alert('hello');
//   });
 
// });
// $( "#client_modal" ).dialog({
//  open: function( event, ui ) {
//     //  var boxInput=$("#befor-box").find('input[name="email"]').val(); //get the value..
//      $("#client_modal").find('input[name="nom"]').val('test'); //set the valu

//  }
//});

// $(".dialog_modal").dialog({
//     open:function(event,ui){
//         var modal_nom =('')
//     }
// })
// var modal= document.querySelector('#client_modal');
// var form=modal.querySelector('form');
// form.addEventListener('submit',function(event){
//     alert('hello');
//     event.preventDefault();

// });
    });
//     var button= document.querySelector('#client_modal #valider');
// button.click(function(){
//     alert('hello');
// });

  </script>
@endsection
