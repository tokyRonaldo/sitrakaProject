@extends('layouts.app')

@section('container')
<div class="containt">
    @if(empty($apropos))
    <div class='AjoutApropos text-center' style="margin-top:150px;">
    <a href="{{ action('App\Http\Controllers\AboutController@create')}}" class="btn btn-primary btn-lg float-center"><i class="fa fa-plus" aria-hidden="true"></i>Ajouter</a>
    </div>
    @else
    <div class="container-fluid">
    <div class="containtApropos">
    <div class="action float-end">
        <a href="{{action('App\Http\Controllers\AboutController@edit', [$apropos->id]) }}" class="btn btn-primary "><i class="fas fa-edit"></i>edit</a>
        <a  href="{{ action('App\Http\Controllers\AboutController@destroy', [$apropos->id]) }}" class="btn btn-danger"><i  class="fa fa-trash"></i>delete</a>    
    </div>
         @if(!empty($apropos->nom))
         <br>
            <div class="nom">
            <b>Nom: {{$apropos->nom}}</b>
            
            </div>
        @endif
        
        @if(!empty($apropos->logo))
        <div class="logo">
        <br>
        
        <b>Logo:</b>

	        <img style="max-height: 130px; width: auto;" src="{{asset('/storage/images/'.$apropos->logo)}}" class="img img-responsive center-block">
            
        </div>
        <br>
        @endif
        @if(!empty($apropos->description))
            <div class="description">
            <b>Description:</b>
            {{$apropos->description}}
            </div>
            <br>
        @endif
        @if(!empty($apropos->number_phone1))
            <div class="telephone1">
            <b>Telephone1:</b>
            {{$apropos->number_phone1}}
            </div>
            <br>
        @endif
        @if(!empty($apropos->number_phone2))
            <div class="telephone2">
            <b>telephone2:</b>
            {{$apropos->number_phone2}}
            </div>
            <br>
        @endif
        @if(!empty($apropos->email))
            <div class="mail">
            <b>Mail:</b>
            {{$apropos->email}}
            </div>
            <br>
        @endif
        @if(!empty($apropos->facebook))
            <div class="facebook">
            <b>Facebook:</b>
            {{$apropos->facebook}}
            </div>
            <br>
        @endif
        @if(!empty($apropos->nif))
            <div class="nif">
            <b>Nif:</b>
            {{$apropos->nif}}
            </div>
            <br>
        @endif
        @if(!empty($apropos->state))
            <div class="state">
            <b>State:</b>
            {{$apropos->state}}
            </div>
            <br>
        @endif
    </div>
    </div>
    @endif
</div>
@stop
@section('javascript')
<script type="text/javascript">
    // $(function () {
        $(document).ready( function () {
        });
  </script>
@endsection