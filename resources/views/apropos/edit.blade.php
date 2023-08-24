@extends('layouts.app')

@section('container')
<div class="containt">
<div class="container-fluid">
<div class="titre">
<h3>Editer apropos</h3>
</div>
{!! Form::open(['url'=> action('App\Http\Controllers\AboutController@update',$apropos->id ),'method'=>'post','id'=>'editer_apropos_form','class'=>'apropos_form','files' => true,'enctype' =>'multipart/form-data' ]) !!}
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('nom', 'nom:*') !!}
            {!! Form::text('nom', $apropos->nom, ['class' => 'form-control', 'required',
              'placeholder' => 'nom']); !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('nif', 'nif:*') !!}
            
            {!! Form::text('nif', $apropos->nif, ['class' => 'form-control', 'required',
              'placeholder' => 'nif']); !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('state', 'state:*') !!}
            {!! Form::text('state', $apropos->state, ['class' => 'form-control', 'required',
              'placeholder' => 'state']); !!}
        </div>
    </div>
    

    

    </div>
    
    <br>
   
    <div class="row">
 
    <div class="col-sm-3">
    <div class="form-group">
            {!! Form::label('number_phone1', 'tel1:*') !!}
            {!! Form::text('number_phone1', $apropos->number_phone1, ['class' => 'form-control', 'required',
              'placeholder' => 'number phone2']); !!}
        </div>
    </div>
    <div class="col-sm-3">
    <div class="form-group">
            {!! Form::label('number_phone2', 'tel2:*') !!}
            {!! Form::text('number_phone2', $apropos->number_phone2, ['class' => 'form-control', 
              'placeholder' => 'number phone1']); !!}
        </div>
        </div>

        <div class="col-sm-3">
    <div class="form-group">
            {!! Form::label('email', 'mail:*') !!}
            {!! Form::email('email', $apropos->email, ['class' => 'form-control', 'required',
              'placeholder' => 'mail']); !!}
        </div>
        </div>

        <div class="col-sm-3">
    <div class="form-group">
            {!! Form::label('facebook', 'facebook:*') !!}
            {!! Form::text('facebook', $apropos->facebook, ['class' => 'form-control',
              'placeholder' => 'facebook']); !!}
        </div>
    </div>
   
   

   

      </div>
      
      <br>

      <div class="row">
 
       
        <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('description', 'description:') !!}
            {!! Form::textarea('description', $apropos->description, ['class' => 'form-control',
              'placeholder' => 'description']); !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
          {!! Form::label('logo', 'logo:') !!}
          <br>
          <!-- <input type="file" class="form-control" name="image" /> -->
          {!! Form::file('logo', ['id' => 'upload_logo','required', 'accept' => 'image/*']); !!}

        </div>

      </div>

    
   

      </div>
 
   
      <div class="row">
      <div class="col-sm-12 ">
      <button type="submit" class="btn btn-primary submit_product_form float-end" >Ajouter</button>
      </div>
      </div>
      

{!! Form::close() !!}

            </div>
</div>
@endsection
