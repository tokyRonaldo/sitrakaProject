

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid d-flex ">
    @php
      $img_path= imgLogo();
      @endphp
    <img width="46" height="50" style="margin-right: 5px;" src="{{ asset($img_path) }}"/>
    @if(!empty($apropos))
    <H3>{{$apropos->nom}}</H3>
    @else
    <H3>nom</H3>
    @endif
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="nav navbar-nav ">
          <li style="margin-right:20px;" class="nav-item">
             
            {{-- {{ 'now'|date('d-m-Y') }} --}}
            @php
            $date = new \DateTime('NOW');
        $default_datetime=$date->format('d-m-Y');
            @endphp
            <p>{{$default_datetime}}</p>
      
          </li>
        @if(isset($count_user))
            @if($count_user == 0)
                <li class="nav-item">
                    <a class="btn-primary" href="{{ url('register') }}">Register</a>
                </li>
            @endif
        @endif
          
        </ul>

      </div>
    </div>
  </nav>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('authenticate') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

