@extends('layouts.app')
@section('title', trans_choice('navbar.organization',1))

@section('pageTitle', trans_choice('navbar.organization',2))

@section('breadcrumb')
  <li><a href="{{route('home')}}">{{trans_choice('navbar.dashboard',1) }}</a></li>
  <li><a href="{{route('archive.index')}}"><span>{{trans_choice('navbar.organization',2)}}</span></a></li>
  <li class="active"><span>{{__('common.add').' ' .trans_choice('navbar.organization',1)}}</span></li>
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
                  @include('organizations._form',['modal'=>false,'route' =>['organization.create']])
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      @include('organizations._list',['editable'=>true])  
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
    <!-- Sweet-Alert  -->
    <script src="{{asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script src="//unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{asset('js/organization.min.js')}}"></script>
    

@endpush