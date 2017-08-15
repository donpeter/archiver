@extends('layouts.auth.app')
@section('title', 'Login')

@section('content')
    
      <!-- Main Content -->
      <div class="page-wrapper pa-0 ma-0 auth-page">
        <div class="container-fluid">
          <!-- Row -->
          <div class="table-struct full-width full-height">
            <div class="table-cell vertical-align-middle auth-form-wrap">
              <div class="auth-form  ml-auto mr-auto no-float">
                <div class="row">
                  <div class="col-sm-12 col-xs-12">
                    <div class="mb-30">
                      <h3 class="text-center txt-dark mb-10">Sign in to Belediyesi Archive</h3>
                      <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
                    </div>  
                    <div class="form-wrap">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="zmdi zmdi-alert-circle-o pr-15 pull-left"></i>Invailid Username / Password
                        </div>
                    @endif
                      {!! Form::open()!!}
                        <div class="form-group{{ $errors->any() ? ' has-error' : '' }}">
                          {!!Form::label('username', 'Username', ['class' => 'control-label mb-10 sr-only'])!!}
                          {!!Form::text('username',null, ['class'=>'form-control', 'placeholder'=> 'Username', 'required'=>'required'] )!!}
                        </div>
                        <div class="form-group{{ $errors->any() ? ' has-error' : '' }}">
                          {!!Form::label('password', 'Password', ['class' => 'pull-left control-label mb-10 sr-only'])!!}
                          
                          {!!Form::password('password',['class'=>'form-control', 'placeholder'=> 'Password', 'required'=>'required'] )!!}
                        </div>
                        <div class="form-group">
                          <div class="checkbox checkbox-primary pr-10 pull-left">
                            <input  name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : ''}}>
                            <label for="remember"> Keep me logged in</label>
                          </div>
                        </div>
                        <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="{{route('password.request')}}">forgot password ?</a>
                        <div class="clearfix"></div>
                        <div class="form-group text-center">
                          <button type="submit" class="btn btn-info btn-rounded">sign in</button>
                        </div>
                      {!! Form::open()!!}
                    </div>
                  </div>  
                </div>
              </div>
            </div>
          </div>
          <!-- /Row --> 
        </div>
        
      </div>
      <!-- /Main Content -->
    
    </div>
    <!-- /#wrapper -->
@endsection
    
