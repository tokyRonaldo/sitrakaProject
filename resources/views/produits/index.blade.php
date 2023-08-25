@extends('layouts.app')

@section('container')
<div class="containt">
<div class="header">
  <div class="row d-flex">
<div class="title col-sm-6 col-xs-12 col-md-6">
<h1>Produits</h1>
</div>
@if(isset($roles))
            @if(in_array('admin',$roles) || in_array('superAdmin',$roles))
<div class="ajouter col-sm-6 col-xs-12 col-md-6">
    <a href="{{ action('App\Http\Controllers\ProduitController@create')}}" class="btn btn-primary float-end"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter</a>
</div>
@endif
@endif
</div>
</div>

<div class="container-fluid">
  <div class="row">
<div class="col-sm-12 col-xs-12 col-md-12">
    <table class="table table-bordered yajra-datatable col-sm-12 col-xs-12 col-md-12">
        <thead>
            <tr>
                <th width="10%">img</th>
                <th>action</th>
                <th>Sku</th>
                <th>Nom</th>
                <th>prix</th>
                <th>dispo</th>
                

            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</div>
</div>

<div id="view_modal" class="modal view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
    </div>
@stop
@section('javascript')
<script type="text/javascript">
        $(document).ready( function () {
      var table = $('.yajra-datatable').DataTable({
       processing: true,
          serverSide: true,
          ajax: "/produit",
        //   ajax: "{{ route('produit_index') }}",
          columns: [
            {data: 'img', name: 'img'},
              {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searchable: true
              },
              {data: 'sku', name: 'sku'},
              {data: 'nom', name: 'nom'},
              {data: 'prix', name: 'prix'},
              {data: 'dispo', name: 'dispo'},
              
              
          ]
      
      });

      $(document).on('click','.view-product-modal',function(){
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
    

    });
  </script>
@endsection
