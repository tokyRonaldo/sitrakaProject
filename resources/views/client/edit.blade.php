@extends('layouts.app')

@section('container')
<div class="containt">
<div class="container-fluid">
<div class="titre">
<h3>Ajouter client</h3>
</div>
{!! Form::open(['url'=> action('App\Http\Controllers\ClientController@update',$client->id ),'method'=>'post','id'=>'editer_produit_form','class'=>'produit_form','files' => true,'enctype' =>'multipart/form-data' ]) !!}
<div class="row">
            <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('surnom', 'surnom:*') !!}
            {!! Form::text('surnom', $client->surnom , ['class' => 'form-control', 'required',
              'placeholder' => 'Mr/Mlle/Mme']); !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('nom', 'nom:*') !!}
            
            {!! Form::text('nom', $client->nom , ['class' => 'form-control', 'required',
              'placeholder' => 'nom']); !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            {!! Form::label('telephone', 'telephone:*') !!}
            
            {!! Form::text('telephone', $client->telephone , ['class' => 'form-control', 'required',
              'placeholder' => 'telephone']); !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('addresse', 'addresse:*') !!}
            
            {!! Form::textarea('addresse', $client->addresse , ['class' => 'form-control', 'required',
              'placeholder' => 'addresse','style' => 'height:100px;']); !!}
        </div>
    </div>
            </div>
   
      <div class="row">
      <div class="col-sm-12 ">
      <button type="submit" class="btn btn-primary submit_product_form float-end" >Valider</button>
      </div>
      </div>
      

{!! Form::close() !!}

            </div>
</div>
@endsection
