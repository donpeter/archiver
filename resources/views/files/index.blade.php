@extends('layouts.app')
@section('title', trans_choice('navbar.organization',1))

@section('pageTitle', trans_choice('navbar.organization',2))

@section('breadcrumb')
  <li><a href="{{route('home')}}">{{trans_choice('navbar.dashboard',1) }}</a></li>
  <li><a href="{{route('archive.index')}}"><span>{{trans_choice('navbar.file',2)}}</span></a></li>
  <li class="active"><span>{{__('common.manage').' ' .trans_choice('navbar.file',1)}}</span></li>
@endsection
@section('content')
  <!-- Row -->
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default card-view ">
        <div class="panel-heading">
          <div class="pull-left">
            <h6 class="panel-title txt-dark">{{__('common.add').' ' .trans_choice('common.file',1)}}</h6>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="col-sm-12 col-xs-12">
              <div class="form-wrap">
                {!! Form::open( ['route' => 'file.store', 'id'=>'addOrgranization','files' => true])!!}
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group{{ $errors->has('ref') ? ' has-error' : '' }}">
                      {!!Form::label('ref', trans_choice('common.ref',1), ['class' => 'control-label mb-10 '])!!}
                      {!!Form::text('ref',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.ref',1), 'required'=>'required'] )!!}
                      {!! $errors->first('ref', '<span class ="help-block">:message</span> ') !!}
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                      {!!Form::label('title', trans_choice('common.title',1), ['class' => 'control-label mb-10 '])!!}
                      {!!Form::text('title',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.title',1), 'required'=>'required'] )!!}
                      {!! $errors->first('title', '<span class ="help-block">:message</span> ') !!}
                    </div> 
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                      {!!Form::label('desc', trans_choice('common.desc',1), ['class' => 'control-label mb-10 '])!!}
                      {!!Form::textarea('desc',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.desc',1), 'required'=>'required'] )!!}
                      {!! $errors->first('desc', '<span class ="help-block">:message</span> ') !!}
                    </div> 
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                      {!!Form::label('files', trans_choice('common.file',1), ['class' => 'control-label mb-10 '])!!}
                      {!!Form::file('files', ['class'=>'form-control', 'required', 'multiple'] )!!}
                      {!! $errors->first('file', '<span class ="help-block">:message</span> ') !!}
                    </div> 
                  </div>
                </div>
                                                                                                                                                   
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-default card-view ">
        <div class="panel-heading">
          <div class="pull-left">
            <h6 class="panel-title txt-dark">{{__('common.manage').' ' .trans_choice('common.file',2)}}</h6>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="col-sm-12 col-xs-12">
              <div class="form-wrap">
                
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                  {!!Form::label('status', trans_choice('common.status',1), ['class' => 'control-label mb-10 '])!!}
                  {!!Form::select('size', ['pending' => 'Pending', 'signed' => 'Signed'], 'pending', ['placeholder' => trans_choice('common.status',1), 'class' => 'form-control'])!!}
                  {!! $errors->first('status', '<span class ="help-block">:message</span> ') !!}
                </div>

                <div class="form-group{{ $errors->has('sender') ? ' has-error' : '' }}">
                  {!!Form::label('sender', trans_choice('common.sender',1), ['class' => 'control-label mb-10 '])!!}
                  {!!Form::select('size', ['pending' => 'Pending', 'signed' => 'Signed'], null, ['placeholder' => trans_choice('common.sender',1), 'class' => 'form-control'])!!}
                  {!! $errors->first('sender', '<span class ="help-block">:message</span> ') !!}
                </div>  

                <div class="form-group{{ $errors->has('reciever') ? ' has-error' : '' }}">
                  {!!Form::label('reciever', trans_choice('common.reciever',1), ['class' => 'control-label mb-10 '])!!}
                  {!!Form::select('size', ['pending' => 'Pending', 'signed' => 'Signed'], null, ['placeholder' => trans_choice('common.reciever',1), 'class' => 'form-control'])!!}
                  {!! $errors->first('reciever', '<span class ="help-block">:message</span> ') !!}
                </div>  

                <div class="form-group{{ $errors->has('prepaired') ? ' has-error' : '' }}">
                  {!!Form::label('prepaired', trans_choice('common.prepaired',1), ['class' => 'control-label mb-10 '])!!}
                  {!!Form::text('prepaired',null, ['class'=>'form-control input-limit-datepicker', 'placeholder'=> trans_choice('common.prepaired',1), 'required'=>'required'] )!!}
                  {!! $errors->first('prepaired', '<span class ="help-block">:message</span> ') !!}
                </div>    

                <div class="form-group{{ $errors->has('signed') ? ' has-error' : '' }}">
                  {!!Form::label('signed', trans_choice('common.signed',1), ['class' => 'control-label mb-10 '])!!}
                  {!!Form::text('signed',null, ['class'=>'form-control input-limit-datepicker', 'placeholder'=> trans_choice('common.signed',1), 'required'=>'required'] )!!}
                  {!! $errors->first('signed', '<span class ="help-block">:message</span> ') !!}
                </div>  

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {!!Form::close()!!} 
    
    
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
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

@endpush
@push('scripts')
    <!-- Sweet-Alert  -->
    <script src="{{asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

    

@endpush