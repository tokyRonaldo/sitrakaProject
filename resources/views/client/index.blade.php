@extends('layouts.app')

@section('container')
<div class="containt">
<div class="header ">
    <div class="row d-flex">
<div class="title col-sm-6 col-md-6 col-xs-6">
<h1>Client</h1>
</div>
<div class="ajouter col-sm-6 col-md-6 col-xs-6">
    <a href="{{ action('App\Http\Controllers\ClientController@create')}}" class="btn btn-primary float-end"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter</a>
</div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class= "col-sm-12 col-md-12 col-xs-12">

        
    <table class="table table-bordered yajra-datatable col-sm-12 col-md-12 col-xs-12">
        <thead>
            <tr>
                <th>Action</th>
                <th >surnom</th>
                <th>Nom</th>
                <th>Telephone</th>
                <th>Adresse</th>
                

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
<script type="text/javascript">
    // $(function () {
        $(document).ready( function () {
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "/client",
        //   ajax: "{{ route('client_index') }}",
          columns: [

              

              {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searchable: true
              },
              {data: 'surnom', name: 'surnom'},
              {data: 'nom', name: 'nom'},
              {data: 'number_phone', name: 'number_phone'},
              {data: 'adresse', name: 'adresse'},
          ]
      });

    });
  </script>
@endsection
