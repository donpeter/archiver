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
                        {{trans_choice('common.organization', 1)}}
                      </th>
                      <th class="sorting">
                       {{ trans_choice('common.folder', 1)}}
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
                        {{trans_choice('common.organization', 1)}}
                      </th>
                      <th class="sorting">
                       {{ trans_choice('common.folder', 1)}}
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
                      <td tabindex="1">{{$document->organization->name }} </td>
                      <td tabindex="1">{{$document->folder->name}}</td>
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
          <h6 class="modal-title" id="title">{{trans_choice('common.folder', 2)}}: <span id="docFolder" ></span> </h6>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-8">
              <h6>{{__('common.ref')}} : <span id="docRef"></span></h6>
              <h6 class="mb-15">{{__('common.title')}} : <span id="docTitle"></span></h6>
              <p id="docDesc"></p>
            </div>
            <div class="col-sm-4">
              <h6 class="inline">{{trans_choice('common.user', 1)}}: </h6><span id="docUser"></span><br> 
              <h6 class="inline" id="target">{{__('common.to')}}: </h6><span id="docTarget"></span><br>
              <h6 class="inline">Received Date: </h6><span id="docRecieved"></span><br> 
              <h6 class="inline">Written Date: </h6><span id="docWritten"></span><br>
              <h6 class="inline">Approved Date: </h6><span id="docSigned"></span><br>
            </div>
          </div>
          <div class="row mt-30" id="docImages" >
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success text-left ml-10" id="emailDocument">Email</button>
          <button type="button" class="btn btn-info text-left ml-10" >Edit</button>
          <button type="button" class="btn btn-danger text-left" data-dismiss="modal" >Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- Email M3odal -->
  <div aria-hidden="true" role="dialog" tabindex="-1" id="emailDocumentModal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 class="modal-title">Compose</h4>
        </div>
        <div class="modal-body">
          <form role="form" class="form-horizontal" id="emailForm">
            {{csrf_field()}}
            <div class="form-group">
              <label class="col-lg-2 control-label" >To</label>
              <div class="col-lg-10">
                <input type="text" placeholder="" id="to" class="form-control" required="required">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Cc / Bcc</label>
              <div class="col-lg-10">
                <input type="text" placeholder="" id="cc" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Subject</label>
              <div class="col-lg-10">
                <input type="text" placeholder="" id="emailSubject" class="form-control"  required="required">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Message</label>
              <div class="col-lg-10">
                <textarea class="textarea_editor form-control" rows="5" placeholder="Enter text ..." id="emailMessage"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
              
                <button class="btn btn-success" type="submit" >Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  
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