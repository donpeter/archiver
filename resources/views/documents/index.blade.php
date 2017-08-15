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
             @include('flash::message')
            <div class="table-wrap mt-20">
              <div class="table-responsive">
                <table id="documents" class="table table-hover display mb-30 dataTable no-footer" style="cursor: pointer;" role="grid">
                  <thead>
                    <tr role="row">
                      <th class="sorting">
                        {{__('common.ref')}}
                      </th>
                      <th class="sorting" >
                        {{__('common.title')}}
                      </th>
                      <th class="sorting" >
                        {{__('common.from')}}
                      </th>
                      <th class="sorting">
                       {{ __('common.to')}}
                      </th>
                      <th class="sorting">
                        {{__('common.date')}}
                      </th>
                      <th class="sorting" style="width: 10%;">
                        {{__('common.action')}}
                      </th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr role="row">
                      <th class="sorting">
                        {{__('common.ref')}}
                      </th>
                      <th class="sorting" >
                        {{__('common.title')}}
                      </th>
                      <th class="sorting" >
                        {{__('common.from')}}
                      </th>
                      <th class="sorting">
                       {{ __('common.to')}}
                      </th>
                      <th class="sorting">
                        {{__('common.date')}}
                      </th>
                      <th class="sorting" style="width: 10%;">
                        {{__('common.action')}}
                      </th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($documents as $document)
                    <tr role="row" class="odd" data-id="{{$document->id}}">
                      <td tabindex="1" class="sorting_1">{{$document->ref}}</td>
                      <td tabindex="1">{{$document->title}}</td>
                      <td tabindex="1">{{$document->from}} </td>
                      <td tabindex="1">{{$document->to}}</td>
                      <td tabindex="1" class="dateTable">{{$document->created_at}}</td>
                      <td tabindex="1">
                        <a href="javascript:void(0)" class="text-inverse pr-5 sa-view" title="view" data-target="tooltip" data-toggle="tooltip" data-original-title="View"   >
                        <i class="zmdi zmdi-eye txt-success"></i>
                        </a>
                        <a href="javascript:void(0)" class="text-inverse pr-5" title="edit" data-target="tooltip" data-toggle="tooltip" data-original-title="Edit" >
                        <i class="zmdi zmdi-edit txt-warning"></i>
                        </a>
                        <a href="javascript:void(0)"  class="text-inverse sa-warning" data-toggle="tooltip"  data-original-title="Delete">
                        <i class="zmdi zmdi-delete txt-danger"></i>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>      
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
                <a class="btn btn-success btn-block mb-10" href="/document/create" >{{__('common.addNew').' '.trans_choice('common.document',1)}}</a>
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

  <!-- Document modal content -->
  <div class="modal fade bs-example-modal-lg" id="viewDocument" tabindex="-1" role="dialog" aria-labelledby="View Document" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h6 class="modal-title" id="title"> View Docment </h6>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-8">
              <h6>{{__('common.ref')}} : 123-456-678</h6>
              <h6 class="mb-15">{{__('common.title')}} : My Document</h6>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus eos deserunt molestiae, consequuntur veritatis animi necessitatibus, veniam unde aliquam architecto libero aspernatur provident dolore excepturi, omnis fugit quo dicta pariatur.
              </p>
            </div>
            <div class="col-sm-4">
              <h6 class="inline">User: </h6> Peter <br> 
              <h6 class="inline">Recipant: </h6> Another Organization <br>
              <h6 class="inline">Received Date:</h6> 25th, Aug 2017 <br> 
              <h6 class="inline">Approved Date:</h6> 25th, Sep 2017 <br>
            </div>
          </div>
          <div class="row mt-30" >
            <div class="col-md-4 single-img "  >
              <div class="img-preview">
                <a  href="/upload/files/08-17/11.jpg" data-lightbox="My file Name" data-title="My file Name">
                  <img  src="/upload/files/08-17/11.jpg" class="img-thumbnail" alt="My file alt" max-height="250">
                  <i class="zmdi zmdi-aspect-ratio-alt zmdi-hc-3x mdc-text-light-blue"></i>
                </a>
              </div>
            </div>
            <div class="col-md-4 single-img "  >
              <div class="img-preview">
                <a  href="/upload/files/08-17/latest_1.png" data-lightbox="My file Name" data-title="My file Name">
                  <img  src="/upload/files/08-17/latest_1.png" class="img-thumbnail" alt="My file alt" max-height="250">
                  <i class="zmdi zmdi-aspect-ratio-alt zmdi-hc-3x mdc-text-light-blue"></i>
                </a>
              </div>
            </div>
            <div class="col-md-4 single-img "  >
              <div class="img-preview">
                <a  href="/upload/files/08-17/latest_2.png" data-lightbox="My file Name" data-title="My file Name">
                  <img  src="/upload/files/08-17/latest_2.png" class="img-thumbnail" alt="My file alt" max-height="250">
                  <i class="zmdi zmdi-aspect-ratio-alt zmdi-hc-3x mdc-text-light-blue"></i>
                </a>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info text-left ml-10" data-dismiss="modal">Edit</button>
          <button type="button" class="btn btn-danger text-left" data-dismiss="modal" >Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="{{asset('js/document.min.js')}}"></script>
<!--   <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
 -->
@endpush