@extends('layouts.app')

@section('title', trans_choice('archive.title',1))

@section('pageTitle', trans_choice('archive.title',2))

@section('breadcrumb')
  <li><a href="{{route('home')}}">{{trans_choice('navbar.dashboard',1) }}</a></li>
  <li><a href="{{route('archive.index')}}"><span>{{trans_choice('archive.title',2)}}</span></a></li>
  <li class="active"><span>{{__('common.add').' ' .trans_choice('archive.title',1)}}</span></li>
@endsection


@section('content')
  <!-- Row -->
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default card-view ">
        <div class="panel-heading">
          <div class="pull-left">
            <h6 class="panel-title txt-dark">{{__('common.add').' ' .trans_choice('archive.title',1)}}</h6>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="col-sm-12 col-xs-12">
              <div class="form-wrap">
                  {!! Form::open( ['route' => ['archive.store']])!!}
                        {!!Form::token()!!}
                        <div class="form-group{{ $errors->has('ref') ? ' has-error' : '' }}">
                          {!!Form::label('ref', __('common.ref'), ['class' => 'control-label mb-10 '])!!}
                          {!!Form::text('ref',null, ['class'=>'form-control', 'placeholder'=> __('common.ref').' ( 00-01 )', 'required'=>'required'] )!!}
                          {!! $errors->first('ref', '<span class ="help-block">:message</span> ') !!}
                        </div>
                        <div class="form-group{{ $errors->any('name') ? ' has-error' : '' }}">
                          {!!Form::label('name', trans_choice('common.name',1), ['class' => 'control-label mb-10 '])!!}
                          {!!Form::text('name',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.name',1), 'required'=>'required'] )!!}
                          {!! $errors->first('name', '<span class ="help-block">:message</span> ') !!}
                        </div> 
                        <div class="form-group{{ $errors->any('desc') ? ' has-error' : '' }}">
                          {!!Form::label('desc', trans_choice('common.desc',1), ['class' => 'control-label mb-10 '])!!}
                          {!!Form::textarea('desc',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.desc',1)] )!!}
                          {!! $errors->first('desc', '<span class ="help-block">:message</span> ') !!}
                        </div>
                        <div class="form-group">
                          {!!Form::submit('Add', ['class'=>'btn btn-info btn-rounded pull-right'])!!}
                        </div> 

                  {!! Form::close()!!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      @include('archives._list',['editable'=>true])  
    </div> 
  </div>
  <!-- /Row -->
  
@endsection

@push('scripts')

@endpush

@push('vendorStyles')
    <link href="{{asset('css/datatable.min.css')}}" rel="stylesheet" type="text/css">

    <!--alerts CSS -->
    <link href="{{asset('vendors/bower_components/sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css">
@endpush
@push('scripts')
    <!-- Sweet-Alert  -->
    <script src="{{asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{asset('js/archive.js')}}"></script>

@endpush