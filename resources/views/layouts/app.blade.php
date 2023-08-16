<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
    <style>
            /* h1{ display: inline;} */
            /* #container { width: 500px; margin: 0 auto; } */
            /* img { float: right;} */
            /* .section { border: 2px solid white;
             border-radius: 3px; margin: 10px 0; padding: 5px;} */

             .lkbLoggo{
    width: 9.182cm !important;
    height: 2.721cm !important;
    margin-top: 0.199cm !important;
    background-image: url("/images/chaise pivotante_1675499639.jpg") !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
}
        </style>
    <!-- Scripts -->
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
     
   <!-- <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>  -->
   
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
  <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
    <!-- <script src="node_modules/popper.js/dist/umd/popper.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

<!-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->


    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
     <!-- <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">  -->
     <!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">  -->
    <!-- <link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" /> -->
 
  <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

    <!-- Styles -->
   

        <!-- Scripts -->
        
        <script src="{{ asset('js/jquery-3.6.3.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>
         
          <script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/jquery.validate.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/all.min.js') }}" type="text/javascript"></script>
          <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

          <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
          <script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
          
          <script src="{{ asset('js/app.js') }}" defer></script>


      <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
          <!-- @livewireStyles -->
      
      
</head>
<body>
    <div id="app">
      <div style="width: 100px;">
        @include('layouts.partials.navbar')
</div>
        <div class="container-fluid" style="">
        <div class="row">
            <div class="col-md-1 col-lg-1 col-xs-1 col-sm-1">
                 @include('layouts.partials.sidebar')
            </div>
            <div style="background-color:white;"  class="col-lg-11 col-md-11 col-xs-11 col-sm-11" >

            @yield('container')

            </div>
        </div>

        </div>
       @include('layouts.partials.footer')

    
<section class="invoice print_section" id="receipt_section">
                </section>

</div>
    <!-- <section class="invoice print_section" id="receipt_section">
                </section> -->
@yield('javascript')
</body>
</html>
