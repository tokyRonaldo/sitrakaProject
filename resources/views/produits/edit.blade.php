@extends('layouts.app')

@section('container')
<div class="containt">
<div class="container-fluid">
<div class="titre">
<h3>Ajouter produit</h3>
</div>
{!! Form::open([ 'action'=>['App\Http\Controllers\ProduitController@update', $produit->id ],'method'=>'post','id'=>'edit_produit_form','class'=>'produit_form','files' => true,'enctype' =>'multipart/form-data']) !!}
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('nom', 'nom:*') !!}
            {!! Form::text('nom', $produit->nom, ['class' => 'form-control', 'required']); !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('prix', 'prix:*') !!}
            
            {!! Form::text('prix', $produit->prix, ['class' => 'form-control', 'required']); !!}
        </div>
    </div>
    <!-- <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('qte', 'qte:*') !!}
            {!! Form::number('qte', null, ['class' => 'form-control', 'required',
              'placeholder' => 'qte']); !!}
        </div>
    </div> -->

    <div class="col-sm-5">
        <div class="form-group">
          {!! Form::label('image', 'image:') !!}
          <br>
          {!! Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*']); !!}

        </div>

      </div>

    </div>
    
    <br>
   
    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('description', 'description:') !!}
            {!! Form::textarea('description', $produit->description, ['class' => 'form-control']); !!}
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
