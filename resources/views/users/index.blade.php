@extends('layouts.app')
@section('title', trans_choice('navbar.user',1))

@section('pageTitle', trans_choice('navbar.user',2))

@section('breadcrumb')
  <li><a href="{{route('home')}}">{{trans_choice('navbar.dashboard',1) }}</a></li>
  <li><a href="{{route('folder.index')}}"><span>{{trans_choice('navbar.user',2)}}</span></a></li>
  <li class="active"><span>{{__('common.add').' ' .trans_choice('navbar.user',1)}}</span></li>
@endsection
@section('content')
  <!-- Row -->
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default card-view ">
        <div class="panel-heading">
          <div class="pull-left">
            <h6 class="panel-title txt-dark">{{__('common.add').' ' .trans_choice('folder.title',1)}}</h6>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="col-sm-12 col-xs-12">
              <div class="form-wrap">
                  @include('users._form',['modal'=>false,'route' =>['user.store']])
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      @include('users._list',['editable'=>true])  
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