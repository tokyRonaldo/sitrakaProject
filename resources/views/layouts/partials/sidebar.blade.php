
@section('sidebar') --}}
@php
use Illuminate\Support\Facades\Request;
@endphp
      
<div class="sidebar" style="background-color:#337ab7;margin-left: 0; padding-left: 0;border-radius:2px;position: fixed; left: 0;top: 66px;height: 100%;overflow: auto; ">
      <a class="@if(Request::route()->getName() === 'home') active @endif" href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
      @if(isset($roles))
            @if(in_array('admin',$roles) || in_array('superAdmin',$roles))
            <a href="{{route('user_index')}}"  class="@if(Request::route()->getName() === 'user_index') active @endif"><i class="fa fas fa-arrow-circle-up" aria-hidden="true"></i>Utilisateurs</a>
            <a href="{{route('role_index')}}"  class="@if(Request::route()->getName() === 'role_index') active @endif"><i class="fa fas fa-arrow-circle-up" aria-hidden="true"></i>Roles</a>
            @endif
        @endif
      
        <a href="{{route('client_index')}}"  class="@if(Request::route()->getName() === 'client_index') active @endif"><i class="fa fas fa-address-book" aria-hidden="true"></i>Clients</a>
                <a href="{{route('produit_index')}}"  class="@if(Request::route()->getName() === 'role_index') active @endif"><i class="fa-solid fa-tablets" aria-hidden="true"></i>Produits</a>

        <a href="{{route('sell_index')}}"  class="@if(Request::route()->getName() === 'sell_index') active @endif"><i class="fa fas fa-arrow-circle-up" aria-hidden="true"></i>ventes</a>
        @if(isset($roles))
            @if(in_array('superAdmin',$roles))
            <a href="{{route('apropos')}}"  class="@if(Request::route()->getName() === 'apropos') active @endif"><i class="fas fa-info-circle" aria-hidden="true"></i>Apropos</a>
            @endif
        @endif
        
    </div>
