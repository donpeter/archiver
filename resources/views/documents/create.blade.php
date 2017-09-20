@extends('layouts.app')
@section('title', trans_choice('navbar.document',1))

@section('pageTitle', trans_choice('navbar.document',2))

@section('breadcrumb')
  <li><a href="{{route('home')}}">{{trans_choice('navbar.dashboard',1) }}</a></li>
  <li><a href="{{route('document.index')}}"><span>{{trans_choice('navbar.file',2)}}</span></a></li>
  <li class="active"><span>{{__('common.manage').' ' .trans_choice('navbar.file',1)}}</span></li>
@endsection
@section('content')
  <!-- Row -->
  <div class="row" id="app">
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
                {!! Form::open( ['route' => 'document.store', 'id'=>'addDocument','files' => true])!!}
                
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
                      {!!Form::textarea('desc',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.desc',1)] )!!}
                      {!! $errors->first('desc', '<span class ="help-block">:message</span> ') !!}
                    </div> 
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
                      {!!Form::label('files', trans_choice('common.file',1), ['class' => 'control-label mb-10 '])!!}
                      {!!Form::file('files[]', ['class'=>'form-control', 'multiple','id'=>'files'] )!!}
                      {!! $errors->first('files', '<span class ="help-block">:message</span> ') !!}
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
              <button class="btn btn-success btn-block mb-10" type="submit">{{__('upload').' '.trans_choice('common.file',2)}}</button>
              <div class="form-wrap">
                
                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                  {!!Form::label('type', trans_choice('common.type',1), ['class' => 'control-label mb-10 '])!!}
                  {!!Form::select('type', ['incomming' => 'Incomming', 'outgoing' => 'Outgoing'], 'incomming', ['placeholder' => trans_choice('common.type',1), 'class' => 'form-control'])!!}
                  {!! $errors->first('type', '<span class ="help-block">:message</span> ') !!}
                </div>

                @if(Auth::user()->role === 'admin')
                  <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                    {!!Form::label('user_id', trans_choice('common.user',1), ['class' => 'control-label mb-10 '])!!}
                    <select id='user_id' name="user_id" class="form-control" data-style="btn-primary btn-outline" tabindex="-98">
                      @foreach($users as $user)
                        <option data-tokens="{{$user->id }}" value="{{$user->id }}" {{(old('user_id') == $user->id ) ? 'selected="selected"': '' }} >{{$user->name }}</option>
                      @endforeach
                    </select>
                    {!! $errors->first('user_id', '<span class ="help-block">:message</span> ') !!}
                  </div> 
                @endif

                <div class="form-group{{ $errors->has('folder_id') ? ' has-error' : '' }}">
                  {!!Form::label('folder_id', trans_choice('common.folder',1), ['class' => 'control-label mb-10 '])!!}
                  <select id='folder_id' name="folder_id" class="form-control" data-style="btn-primary btn-outline" tabindex="-98">
                    @foreach($folders as $folder)
                      <option data-tokens="{{$folder->id }}" value="{{$folder->id }}" {{(old('folder_id') == $folder->id ) ? 'selected="selected"': '' }} >{{$folder->name }}</option>
                    @endforeach
                  </select>
                  <a href="" class="add-input text-info" data-target="#addFolderModal" data-toggle="modal" >
                    {{__('common.add')}} {{trans_choice('common.folder',1)}}
                  </a>
                  {!! $errors->first('folder_id', '<span class ="help-block">:message</span> ') !!}
                </div> 

                <div class="form-group{{ $errors->has('organization_id') ? ' has-error' : '' }}">
                  {!!Form::label('organization_id', trans_choice('common.organization',1), ['class' => 'control-label mb-10 '])!!}
                  <select id='organization_id' name="organization_id" class="form-control" data-style="btn-primary btn-primary" tabindex="-98">
                    @foreach($organizations as $organization)
                      <option data-tokens="{{$organization->id }}" value="{{$organization->id }}" {{(old('organization_id') == $organization->id ) ? 'selected="selected"': '' }} >{{$organization->name }}</option>
                    @endforeach
                  </select>
                  <a href="" class="add-input text-info" data-target="#addOrganizationModal" data-toggle="modal" >
                    {{__('common.add')}} {{trans_choice('common.organization',1)}}
                  </a>

                  {!! $errors->first('organization_id', '<span class ="help-block">:message</span> ') !!}
                </div>  

                <div class="form-group{{ $errors->has('written_on') ? ' has-error' : '' }}">
                  {!!Form::label('written_on', trans_choice('common.written',1), ['class' => 'control-label mb-10 '])!!}
                  {!!Form::text('written_on',null, ['class'=>'form-control datetimepicker', 'placeholder'=> trans_choice('common.prepaired',1)] )!!}
                  {!! $errors->first('written_on', '<span class ="help-block">:message</span> ') !!}
                </div>    

                <div class="form-group{{ $errors->has('signed_on') ? ' has-error' : '' }}">
                  {!!Form::label('signed_on', trans_choice('common.signed',1), ['class' => 'control-label mb-10 '])!!}
                  {!!Form::text('signed_on',null, ['class'=>'form-control date datetimepicker', 'placeholder'=> trans_choice('common.signed',1)] )!!}
                  {!! $errors->first('signed_on', '<span class ="help-block">:message</span> ') !!}
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

   {{--  Add Organization Modal--}}
  <div class="modal fade" id="addOrganizationModal" tabindex="-1" role="dialog" aria-labelledby="Add new Organization">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title" >{{__('common.add')}} {{trans_choice('common.organization',1)}}</h5>
        </div>
        <div class="modal-body">
          @include('organizations._form',['modal'=>true,'route' =>['organization.store']])
           
        </div>

      </div>
    </div>
  </div>
  {{-- /Add Organizaion Modal --}}

  {{-- Add Folder Modal --}}
  <div class="modal fade" id="addFolderModal" tabindex="-1" role="dialog" aria-labelledby="Add New Folder">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title">{{__('common.add')}} {{trans_choice('common.folder',1)}}</h5>
        </div>
        <div class="modal-body">
          {!! Form::open( ['route' => null,'id'=>'addFolder','method'=>'patch'])!!}
            <div class="form-group{{ $errors->has('ref') ? ' has-error' : '' }}">
              {!!Form::label('ref', __('common.ref'), ['class' => 'control-label mb-10 '])!!}
              {!!Form::text('ref',null, ['class'=>'form-control', 'placeholder'=> __('common.ref').' ( 00-01 )', 'required'=>'required'] )!!}
              {!! $errors->first('ref', '<span class ="help-block">:message</span> ') !!}
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              {!!Form::label('name', trans_choice('common.name',1), ['class' => 'control-label mb-10 '])!!}
              {!!Form::text('name',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.name',1), 'required'=>'required'] )!!}
              {!! $errors->first('name', '<span class ="help-block">:message</span> ') !!}
            </div> 
            <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
              {!!Form::label('desc', trans_choice('common.desc',1), ['class' => 'control-label mb-10 '])!!}
              {!!Form::textarea('desc',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.desc',1), 'rows'=> '4'] )!!}
              {!! $errors->first('desc', '<span class ="help-block">:message</span> ') !!}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {!!Form::submit(__('common.save'), ['class'=>'btn btn-primary'])!!}
        </div>
        {!! Form::close()!!}

      </div>
    </div>
  </div> 
  {{-- /Add Folder Modal --}}
  
@endsection

@push('vendorStyles')
    <link href="{{asset('css/datatable.min.css')}}" rel="stylesheet" type="text/css">
    <link href="//cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('css/document.min.css')}}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">


@endpush
@push('scripts')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="{{asset('js/document.min.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

@endpush