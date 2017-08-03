@extends('layouts.app')

@section('title', trans_choice('archive.title',1))

@section('content')
  <div class="row">
    <div class="col-sm-12">
      @include('archives._list',['editable' => false])  
    </div>  
  </div>  
  
@endsection

@push('scripts')
    <script src="{{asset('js/datatable.js')}}"></script>
@endpush

@push('vendorStyles')
    <link href="{{asset('css/datatable.min.css')}}" rel="stylesheet" type="text/css">
@endpush