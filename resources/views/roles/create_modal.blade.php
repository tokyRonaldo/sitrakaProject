<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    {!! Form::open(['url'=> action('App\Http\Controllers\ClientController@store'),'method'=>'post','id'=>'ajouter_client_modal_form','class'=>'client_modal_form','files' => true,'enctype' =>'multipart/form-data' ]) !!}
        <div class="modal-header">
        <h4 class="modal-titre" id="modalTitre">produit name</h4>
		    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  
	    </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('surnom', 'surnom:*') !!}
            {!! Form::text('surnom', null, ['class' => 'form-control', 'required',
              'placeholder' => 'Mr/Mlle/Mme']); !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('nom', 'nom:*') !!}
            
            {!! Form::text('nom', null, ['class' => 'form-control', 'required',
              'placeholder' => 'nom']); !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('telephone', 'telephone:*') !!}
            
            {!! Form::text('telephone', null, ['class' => 'form-control', 'required',
              'placeholder' => 'telephone']); !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('addresse', 'addresse:*') !!}
            
            {!! Form::textarea('addresse', null, ['class' => 'form-control', 'required',
              'placeholder' => 'addresse','style' => 'height:100px;']); !!}
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
        <button type="submit" class="btn btn-primary submit_client_form " >Ajouter</button>
            <button type="button" class="btn btn-default no-print" data-dismiss="modal">close</button>
      </div>
      {!! Form::close() !!}
    </div>

</div>


<script type="text/javascript">
          $(document).ready(function(){
    //           $("form#shipper_add_form").validate({
      
    //   submitHandler: function (form) {
        
    //     var form = $("form#shipper_add_form");
    //     var url = form.attr('action');
        
    //     form.find('button[type="submit"]').attr('disabled', true);
    //     $.ajax({
    //         method: "POST",
    //         url: url,
    //         dataType: 'json',
    //         data: $(form).serialize(),
    //         success: function(data){
    //             $('.shipper_modal').modal('hide');
    //             if( data.success){
    //                 toastr.success(data.msg);
                   
    //             } else {
    //                 toastr.error(data.msg);
    //             }
    //         }
    //     });
    //     return true;
    //   }
    // });



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
                alert(id);
                var d=parseFloat(id);
                // $('.client_modal').modal('hide');
                $('#transaction_client').val(d);
                alert($('#transaction_client').val());
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