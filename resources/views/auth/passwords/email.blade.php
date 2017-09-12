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
                    <button type="submit" class="btn btn-info btn-rounded">sign Up</button>
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

@section('preview')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
