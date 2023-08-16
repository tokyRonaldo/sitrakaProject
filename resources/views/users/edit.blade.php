@extends('layouts.app')

@section('container')
<div class="containt">
<div class="titre">
<h3>Edit utilisateur</h3>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    <form method="POST" action="{{action('App\Http\Controllers\UserController@update',[$user->id]) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control " name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- <label for="admin" class="col-md-4 col-form-label text-md-end">Roles</label> -->
                            <!-- <div class="col-md-6">roles:</div> -->
                             <label class="col-md-4 col-form-label text-md-end">roles:</label>
                             <div class="col-md-6"></div>
                            <br>
                            <div class="col-md-11">
                            
                            @foreach($roles as $role)
                            <div class="row">
                                @php
                                $val=array();
                                foreach($user->user_roles as $user_role) {
                                    array_push($val,$user_role->role->id);
                                }
                                @endphp
                            <div class="col-md-4"></div>
                                <label for="role{{$role->id}}" class="col-md-6 col-form-label ">
                            <input type="checkbox" name="roles[{{$role->id}}][id]" id="role{{$role->id}}" {{in_array($role->id,$val) ? 'checked' : '' }} value="{{$role->id}}">
                            {{$role->nom}}  </label>
                            <!-- {{ Form::checkbox('admin', 'yes', false) }} -->
                            </div>
                            @endforeach
                            </div>
                            
                           
                            
                            
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
