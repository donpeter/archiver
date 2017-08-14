@extends('layouts.app')
@section('title', trans_choice('navbar.document',1))

@section('pageTitle', __('common.manage').' ' .trans_choice('navbar.document',2))

@section('breadcrumb')
  <li><a href="{{route('home')}}">{{trans_choice('navbar.dashboard',1) }}</a></li>
  <li><a href="{{route('document.index')}}"><span>{{trans_choice('navbar.document',2)}}</span></a></li>
  <li class="active"><span>{{__('common.manage').' ' .trans_choice('navbar.document',1)}}</span></li>
@endsection
@section('content')
  <!-- Row -->
  <div class="row" id="app">
    <div class="col-md-9">
      <div class="panel panel-default card-view ">
        <div class="panel-heading">
          <div class="pull-left">
            <h6 class="panel-title txt-dark">{{upfirst(__('common.list').trans_choice('navbar.document',2))}}</h6>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-wrap mt-20">
              <div class="table-responsive">
                <document-list></document-list>
                  
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
                <button class="btn btn-success btn-block mb-10" type="button" @click="onFilter">{{__('filter').' '.trans_choice('common.file',2)}}</button>
                <div class="form-wrap">

                  
                  <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    {!!Form::label('type', trans_choice('common.type',1), ['class' => 'control-label mb-10 '])!!}
                    {!!Form::select('type', ['incomming' => 'Incomming', 'outgoing' => 'Outgoing'], 'incomming', ['placeholder' => trans_choice('common.type',1), 'class' => 'form-control'])!!}
                    {!! $errors->first('type', '<span class ="help-block">:message</span> ') !!}
                  </div>

                  <div class="form-group{{ $errors->has('archive') ? ' has-error' : '' }}">
                    {!!Form::label('archive', trans_choice('common.archive',1), ['class' => 'control-label mb-10 '])!!}
                    {!!Form::select('archive', ['incomming' => 'Lefke Belediyesi', 'outgoing' => 'Outgoing'], 'incomming', ['placeholder' => trans_choice('common.archive',1), 'class' => 'form-control'])!!}
                    {!! $errors->first('archive', '<span class ="help-block">:message</span> ') !!}
                  </div>


                  <div class="form-group{{ $errors->has('sender') ? ' has-error' : '' }}">
                    {!!Form::label('sender', trans_choice('common.organization',1), ['class' => 'control-label mb-10 '])!!}
                    <select id='sender' name="sender" class="form-control" data-style="btn-primary btn-outline" tabindex="-98">
                      @foreach($organizations as $organization)
                        <option data-tokens="{{$organization->id }}" value="{{$organization->id }}" {{(old('sender') == $organization->id ) ? 'selected="selected"': '' }} >{{$organization->name }}</option>
                      @endforeach
                    </select>
                    {!! $errors->first('sender', '<span class ="help-block">:message</span> ') !!}
                  </div> 

                  <div class="form-group{{ $errors->has('receiver') ? ' has-error' : '' }}">
                    {!!Form::label('receiver', trans_choice('common.organization',1), ['class' => 'control-label mb-10 '])!!}
                    <select id='receiver' name="receiver" class="form-control" data-style="btn-primary btn-primary" tabindex="-98">
                      @foreach($organizations as $organization)
                        <option data-tokens="{{$organization->id }}" value="{{$organization->id }}" {{(old('receiver') == $organization->id ) ? 'selected="selected"': '' }} >{{$organization->name }}</option>
                      @endforeach
                    </select>
                    {!! $errors->first('receiver', '<span class ="help-block">:message</span> ') !!}
                  </div>  

                  <div class="form-group{{ $errors->has('prepaired_on') ? ' has-error' : '' }}">
                    {!!Form::label('prepaired_on', trans_choice('common.prepaired',1), ['class' => 'control-label mb-10 '])!!}
                    {!!Form::text('prepaired_on',null, ['class'=>'form-control datetimepicker', 'placeholder'=> trans_choice('common.prepaired',1)] )!!}
                    {!! $errors->first('prepaired_on', '<span class ="help-block">:message</span> ') !!}
                  </div>    

                  <div class="form-group{{ $errors->has('signed_on') ? ' has-error' : '' }}">
                    {!!Form::label('signed_on', trans_choice('common.signed',1), ['class' => 'control-label mb-10 '])!!}
                    <input placeholder="Signed" name="signed_on" type="text" id="signed_on" class="form-control date datetimepicker" v-model="signedDate">
                    {!! $errors->first('signed_on', '<span class ="help-block">:message</span> ') !!}
                  </div>  

                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <!-- /Row -->
  
@endsection


@push('vendorStyles')
    <link href="{{asset('css/datatable.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/lightbox.min.css')}}" rel="stylesheet" type="text/css">
    <link href="//cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('css/document.min.css')}}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">


@endpush
@push('scripts')
  <script type="text/javascript" src="{{asset('js/bundle.min.js')}}"></script>
{{--   <script type="text/javascript" src="{{asset('js/document.min.js')}}"></script>
 --}}  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script>

@endpush