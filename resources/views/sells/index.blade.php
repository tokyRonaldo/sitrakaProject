@extends('layouts.app')

@section('container')
<div class="containt">
<div class="header ">
    <div class="row d-flex">
<div class="title col-sm-6 col-md-6 col-xs-12">
<h1>Ventes</h1>
</div>
<div class="ajouter col-sm-6 col-md-6 col-xs-12">
    <a href="{{ action('App\Http\Controllers\SellController@create')}}" class="btn btn-primary float-end"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter</a>
</div>
</div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class= "col-sm-12 col-md-12 col-xs-12">

        
    <table class="table table-bordered yajra-datatable col-sm-12 col-md-12 col-xs-12">
        <thead>
            <tr>
                <th>action</th>
                <th >Facture No</th>
                <th>Client</th>
                <th>Prix total</th>
                <th>Total payé</th>
                <th>Reste</th>
                <th>status</th>
                <th>Date</th>
                

            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

<div id="view_modal" class="modal view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
    </div>
    </div>

</div>
      <!-- This will be printed -->
      <!-- <section class="invoice print_section" id="receipt_section">
                </section> -->
                
</div>
@stop
@section('javascript')
<script type="module">
    $(document).ready( function () {

        $(document).on('click', 'a.print-invoice', function(e) {
        e.preventDefault();
        var href = $(this).data('href');

        $.ajax({
            method: 'GET',
            url: href,
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success == 1 && result.receipt != '') {
                    // alert(result.receipt);                  
                    // __currency_convert_recursively($('#receipt_section'));
                    __print_receipt('receipt_section',result.receipt);

                } else {
                    // toastr.error(result.msg);
                    alert(result.msg)
                }
            },
        });
    });


    function __print_receipt(section_id = null,html_content) {
    // if (section_id) {
    //     // var imgs = document.getElementById(section_id).getElementsByTagName("img");
    //     var imgs=document.images;
    // } else {
    //     var imgs = document.images;
    // }
    
    var getFullContent = document.body.innerHTML;
                    document.body.innerHTML=html_content; 
        setTimeout(function() {
                    // var getFullContent = document.body.innerHTML;
                    // document.body.innerHTML=html_content;
                    // $(win).load(function(){
                        window.print();

            setTimeout(function() {
                document.body.innerHTML = getFullContent;
            }, 50);
            
        }, 1500);
}

      var table = $('.yajra-datatable').DataTable({
       processing: true,
          serverSide: true,
          ajax: "/sell",
          columns: [
              {
                  data: 'action',
                  name: 'action',
                   orderable: false,
                  searchable: true
              },
              {data: 'no_facture', name: 'no_facture'},
              {data: 'contact', name: 'contact'},
              {data: 'prix_total', name: 'prix_total'},
              {data: 'total_payment', name: 'total_payment'},
              {data: 'due', name: 'due'},
              {data: 'status', name: 'status'},
              {data: 'date_transactions', name: 'date_transactions'},
              
              
          ]
      
      });

      $(document).on('click','.view-sell-modal',function(){
        // let id = $(this).data('id');
        var href = $(this).attr('href');

        $.ajax({
                url:href,
                type:'get',
                // data:{'id':id, '_token': token},
                success: function(data) {
                console.log(data)
                $('#view_modal').html(data);
                }
                });

      });
    

  var form_contact = $('form.client_modal_form');
    $('form.client_modal_form')
       .submit(function (e) {
        e.preventDefault();
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
      
        
    })
    .validate({

        rules: {
            // client: {
            //     required: true
            // },
            nom: {
                required: true
            }
        
        },
        messages: {
            // client: {
            //     remote: 'required',
            // },
            nom: {
                // remote: LANG.required,
                 remote: 'required',
            }
           
        },
      
      submitHandler: function (form) {
        
        var form = $("form.client_modal_form");
        var url = form.attr('action');
        
        form.find('button[type="submit"]').attr('disabled', true);
        $.ajax({
            method: "POST",
            url: url,
            dataType: 'json',
            data: $(form).serialize(),
            success: function(data){
                console.log(data.client_id);
                var id=data.client_id;
                // alert(id);
                var d=parseFloat(id);
                // $('.client_modal').modal('hide');
                $('#transaction_client').val(d);
                // alert($('#transaction_client').val());
                if( data.success){
                    // toastr.success(data.msg);
                   
                } else {
                    // toastr.error(data.msg);
                }
                
            }
        });
        return true;
      }
    });

    });
  </script>
@endsection
