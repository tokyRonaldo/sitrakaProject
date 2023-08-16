{{-- @extends('layouts.app')

@section('sidebar') --}}
      
<div class="sidebar" style="background-color:#337ab7;margin-left: 0; padding-left: 0;border-radius:2px;position: fixed; left: 0;top: 66px;height: 100%;overflow: auto; ">
    {{-- {% if is_granted('ROLE_ADMIN') %} --}}
      <a class="active" href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
      <a href="{{route('user_index')}}"  class=""><i class="fa fas fa-arrow-circle-up" aria-hidden="true"></i>Utilisateurs</a>
      <a href="{{route('role_index')}}"  class=""><i class="fa fas fa-arrow-circle-up" aria-hidden="true"></i>Roles</a>

        {{-- {% endif %} --}}
        <a href="{{route('client_index')}}"  class=""><i class="fa fas fa-address-book" aria-hidden="true"></i>Clients</a>
                <a href="{{route('produit_index')}}"  class=""><i class="fa-solid fa-tablets" aria-hidden="true"></i>Produits</a>
        {{-- {% if is_granted('ROLE_ADMIN') %} --}}

         {{-- {% endif %} --}}
        <a href="{{route('sell_index')}}"  class=""><i class="fa fas fa-arrow-circle-up" aria-hidden="true"></i>ventes</a>
        {{-- {% if is_granted('ROLE_ADMIN') %} --}}
        {{-- {% endif %} --}}
    </div>
{{-- @endsection --}}
