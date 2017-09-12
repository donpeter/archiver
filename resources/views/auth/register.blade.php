@extends('layouts.auth.app')
@section('title', 'Sign Up')
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
                <h3 class="text-center txt-dark mb-10">Sign up to Belediyesi Archiver</h3>
                <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
                <div class="alert alert-danger">
                  <span class="glyphicon glyphicon-info-sign"></span>
                  <strong>You can't register yourself contact Admin!</strong>
                </div>
              </div>  
              <div class="form-wrap">
                {!! Form::open()!!}
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!!Form::label('name', 'Full Name', ['class' => 'control-label mb-10 sr-only'])!!}
                    {!!Form::text('name',null, ['class'=>'form-control', 'placeholder'=> 'Full Name', 'required'=>'required'] )!!}
                    {!! $errors->first('name', '<span class ="help-block">:message</span> ') !!}
                  </div>
                  <div class="form-group{{ $errors->has('userename') ? ' has-error' : '' }}">
                    {!!Form::label('username', 'Username', ['class' => 'control-label mb-10 sr-only'])!!}
                    {!!Form::text('username',null, ['class'=>'form-control', 'placeholder'=> 'Username', 'required'=>'required'] )!!}
                    {!! $errors->first('username', '<span class ="help-block">:message</span> ') !!}
                  </div>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!!Form::label('email', 'Email address', ['class' => 'control-label mb-10 sr-only '])!!}
                    {!!Form::email('email',null, ['class'=>'form-control', 'placeholder'=> 'Email Address', 'required'=>'required'] )!!}
                    {!! $errors->first('email', '<span class ="help-block">:message</span> ') !!}
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    {!!Form::label('password', 'Password', ['class' => 'control-label mb-10 sr-only'])!!}
                    {!!Form::password('password',['class'=>'form-control', 'placeholder'=> 'Password', 'required'=>'required'] )!!}
                    {!! $errors->first('password', '<span class ="help-block">:message</span> ') !!}
                  </div>
                  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    {!!Form::label('password_confirmation', 'Comfirm Password', ['class' => 'control-label mb-10 sr-only'])!!}
                    {!!Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=> 'Comfirm Password', 'required'=>'required'] )!!}
                    {!! $errors->first('password_confirmation', '<span class ="help-block">:message</span> ') !!}
                  </div>
                  <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                    <div class="checkbox checkbox-primary pr-10 pull-left">
                      <input id="terms" required="required" type="checkbox">
                      <label for="terms"> I agree to all <a href="#" class="txt-primary">Terms</a></label>
                      {!! $errors->first('terms', '<span class ="help-block">:message</span> ') !!}
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-info btn-rounded" disabled="disabled">sign Up</button>
                  </div>
                {!!Form::close()!!}
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
@endsection

