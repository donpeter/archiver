@extends('layouts.app')
@section('title', trans_choice('navbar.user',1).' '.__('common.profile'))

@section('pageTitle', trans_choice('navbar.user',2))

@section('breadcrumb')
  <li><a href="{{route('home')}}">{{trans_choice('navbar.dashboard',1) }}</a></li>
  <li><a href="{{route('folder.index')}}"><span>{{trans_choice('navbar.user',2)}}</span></a></li>
  <li><span>{{__('common.profile')}}</span></li>
  <li class="active"><span>{{Auth::user()->name}}</span></li>
@endsection
@section('content')
  <!-- Row -->
  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default card-view ">
        <div class="panel-heading">
          <div class="pull-left">
            <h6 class="panel-title txt-dark">{{__('common.edit').' ' .trans_choice('common.profile',1)}}</h6>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="col-sm-12 col-xs-12">
              <div class="form-wrap">
                 {!! Form::model(Auth::user(), ['route' => ['user.update', Auth::user()->id]]) !!}
                   {{ method_field('PATCH') }}
                   <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                     {!!Form::label('name', trans_choice('common.name',1), ['class' => 'control-label mb-10 '])!!}
                     {!!Form::text('name',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.name',1), 'required'=>'required'] )!!}
                     {!! $errors->first('name', '<span class ="help-block">:message</span> ') !!}
                   </div>

                   <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                     {!!Form::label('username', trans_choice('common.username',1), ['class' => 'control-label mb-10 '])!!}
                     {!!Form::text('username',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.username',1), 'rows'=> '4']  )!!}
                     {!! $errors->first('username', '<span class ="help-block">:message</span> ') !!}
                   </div>

                   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                     {!!Form::label('password', trans_choice('common.password',1), ['class' => 'control-label mb-10 '])!!}
                     {!!Form::password('password', ['class'=>'form-control', 'placeholder'=> trans_choice('common.password',1)] )!!}
                     {!! $errors->first('password', '<span class ="help-block">:message</span> ') !!}
                   </div>
                   <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                     {!!Form::label('password_confirmation', __('common.verify').' '.__('common.password'), ['class' => 'control-label mb-10'])!!}
                     {!!Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=> __('common.verify').' '.__('common.password')] )!!}
                     {!! $errors->first('password_confirmation', '<span class ="help-block">:message</span> ') !!}
                   </div>

                   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                     {!!Form::label('email', trans_choice('common.email',1), ['class' => 'control-label mb-10 '])!!}
                     {!!Form::text('email',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.email',1)] )!!}
                     {!! $errors->first('email', '<span class ="help-block">:message</span> ') !!}
                   </div>
                    
                    <div class="form-group">
                      {!!Form::submit(__('common.save'), ['class'=>'btn btn-success pull-right'])!!}
                    </div> 
                 {!! Form::close()!!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="panel panel-default card-view">
        <div class="panel-heading">
          <div class="pull-left">
            <h6 class="panel-title txt-dark">{{__('common.profile').' '.__('common.summary')}}</h6>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <h5 class="text-success inline mr-10 ">{{trans_choice('common.name',1)}}:</h5> <span> 
              {{Auth::user()->name }}</span><br /><br />
            <h5 class="text-success inline mr-10 ">{{__('common.username')}}:</h5> <span>
             {{Auth::user()->username }}</span><br /><br />
            <h5 class="text-success inline mr-10 ">{{__('common.email')}}:</h5> <span>
             {{Auth::user()->email }}</span><br /><br />
            <h5 class="text-success inline mr-10 ">{{__('common.role')}}:</h5> <span>
             {{Auth::user()->role }}</span><br /><br />

             <a class="btn btn-info text-right" href="{{route('user.documents',['user' => Auth::user()->id ])}}">{{__('common.myDocument')}}</a>
          </div>
        </div>
      </div>  
    </div>
  <!-- /Row -->
  
@endsection


@push('vendorStyles')
    <link href="{{asset('css/datatable.min.css')}}" rel="stylesheet" type="text/css">
    <link href="//cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('css/countrySelect.min.css')}}" rel="stylesheet" type="text/css">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--alerts CSS -->
    <link href="{{asset('vendors/bower_components/sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css">
@endpush
@push('scripts')
<script src="{{asset('js/user.min.js')}}"></script>
@endpush