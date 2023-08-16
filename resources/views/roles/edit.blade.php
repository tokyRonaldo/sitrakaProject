@extends('layouts.app')

@section('container')
<div class="containt">
<div class="container-fluid">
<div class="titre">
<h3>Ajouter client</h3>
</div>
{!! Form::open(['url'=> action('App\Http\Controllers\RoleController@update',$role->id ),'method'=>'post','id'=>'editer_role_form','class'=>'role_form' ]) !!}

<div class="row justify-content-center">
            <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('role', 'Role:*') !!}
            {!! Form::text('role', $role->nom, ['class' => 'form-control', 'required',
              ]); !!}
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
