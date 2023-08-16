

<nav class="navbar navbar-expand-lg fixed-top" style="background-color:#e0e0d1;">
    <div class="container-fluid d-flex ">
      @php
      $img_path= imgLogo();
      @endphp
    <img width="46" height="50" style="margin-right: 5px;" src="{{ asset($img_path) }}"/>
      <H3>TOKYPHARM</H3>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="nav navbar-nav ">
          <li style="margin-right:20px;" class="nav-item">
             
            
            @php
            $date = new \DateTime('NOW');
        $default_datetime=$date->format('d-m-Y');
            @endphp
            <p>{{$default_datetime}}</p>
      
          </li>
          <li class="nav-item">
             <a class="btn-primary" href="{{ url('logout') }}">Logout</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
