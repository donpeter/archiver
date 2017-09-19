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
                    <tr role="row" >
                      <th class="sorting">
                        {{__('common.ref')}}
                      </th>
                      
                      <th class="sorting" style="width: 20%;" >
                        {{__('common.title')}}
                      </th>
                      <th class="sorting" >
                        {{trans_choice('common.organization', 1)}}
                      </th>
                      <th class="sorting">
                       {{ trans_choice('common.folder', 1)}}
                      </th>
                      <th class="sorting" >
                        {{__('common.date')}}
                      </th>
                      <th class="sorting">
                        {{trans_choice('common.user', 1)}}
                      </th>
                      <th class="sorting" style="width: 5%;">
                        {{__('common.type')}}
                      </th>
                      <th class="sorting" style="width: 11%;">
                        {{__('common.action')}}
                      </th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr role="row">
                      <th class="sorting"  data-name="refernce" style="width: 15%;">
                        {{__('common.ref')}}
                      </th>
                      <th class="sorting" data-name='title' >
                        {{__('common.title')}}
                      </th>
                      <th class="sorting" data-name='organization'>
                        {{trans_choice('common.organization', 1)}}
                      </th>
                      <th class="sorting" data-name='folder'>
                       {{ trans_choice('common.folder', 1)}}
                      </th>
                      <th class="sorting" data-name='date' style= 'width: 10%'>
                        {{__('common.date')}}
                      </th>
                      <th class="sorting" ata-name='user'>
                        {{trans_choice('common.user', 1)}}
                      </th>
                      <th class="sorting" data-name='type'>
                        {{__('common.type')}}
                      </th>
                      <th class="sorting" ata-name='action' style="width: 11%;">
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
                      <td tabindex="1" class="dateTable">{{$document->written_on}}</td>
                      <td tabindex="1">{{$document->user->name}}</td>
                      <td tabindex="1" class="sorting_1">
                        @if($document->type == 'incomming')
                          <i class="fa fa-paper-plane text-success" title="Incomming" data-target="tooltip" data-toggle="tooltip" data-original-title="Incomming"></i>
                        @else
                          <i class="fa fa-paper-plane fa-rotate-180 text-info" title="Outgoing" data-target="tooltip" data-toggle="tooltip" data-original-title="Outgoing"></i>
                        @endif
                        <span class="sr-only">{{$document->type}}</span>
                      </td>
                      <td tabindex="1">
                        <a href="javascript:void(0)" class="text-inverse pr-5 sa-view" title="view" data-target="tooltip" data-toggle="tooltip" data-original-title="View"   >
                        <i class="zmdi zmdi-eye txt-success"></i>
                        </a>
                        @can('update',$document)
                        <a href="javascript:void(0)" class="text-inverse pr-5 sa-edit" title="edit" data-target="tooltip" data-toggle="tooltip" data-original-title="Edit" >
                        <i class="zmdi zmdi-edit txt-warning"></i>
                        </a>
                        @endcan

                        @can('delete',$document)
                        <a href="javascript:void(0)"  class="text-inverse sa-warning" data-toggle="tooltip"  data-original-title="Delete">
                        <i class="zmdi zmdi-delete txt-danger"></i>
                        </a>
                        @endcan
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
                <div class="form-wrap" id="dataTableFilters">

                  
                  <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    {!!Form::label('type', trans_choice('common.type',1), ['class' => 'control-label mb-10 '])!!}
                    {!!Form::select('type', ['incomming' => 'Incomming', 'outgoing' => 'Outgoing'], 'incomming', ['placeholder' => trans_choice('common.type',1), 'class' => 'form-control'])!!}
                    {!! $errors->first('type', '<span class ="help-block">:message</span> ') !!}
                  </div>

                  <div class="form-group">
                    {!!Form::label('user', trans_choice('common.folder',1), ['class' => 'control-label mb-10 '])!!}
                    <select id='folder' name="folder" class="form-control" data-style="btn-primary btn-outline" tabindex="-98">
                      @foreach($folders as $folder)
                        <option data-tokens="{{$folder->name }}" value="{{$folder->name }}" >{{$folder->name }}</option>
                      @endforeach
                    </select>
                  </div> 
                  <div class="form-group">
                    {!!Form::label('organization', trans_choice('common.organization',1), ['class' => 'control-label mb-10 '])!!}
                    <select id='organization' name="organization" class="form-control">
                      @foreach($organizations as $organization)
                        <option data-tokens="{{$organization->name }}" value="{{$organization->name }}">{{$organization->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <button class="btn btn-info btn-block mb-10" id="resetFilters">{{__('common.reset').' '.__('common.filter')}}</button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <!-- /Row -->

  <!-- Document view modal content -->
  <div class="modal fade " id="viewDocumentModal" tabindex="-1" role="dialog" aria-labelledby="View Document" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="title">{{trans_choice('common.folder', 2)}}: <span id="docFolder" ></span> </h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-8">
              <h5 class="text-success inline mr-10">{{__('common.ref')}}:</h5> <span id="docRef"></span><br />
              <h5 class="text-success inline mr-10">{{__('common.title')}}:</h5> <span id="docTitle"></span><br />
              <h5 class="text-success inline mr-10">{{trans_choice('common.desc',1)}} </h5><br />
              <p id="docDesc"></p>
            </div>
            <div class="col-sm-4">
              <h5 class="text-success inline mr-10">{{trans_choice('common.user', 1)}}: </h5><span id="docUser"></span><br> 
              <h5 class="text-success inline mr-10" id="target">{{__('common.to')}}: </h5><span id="docTarget"></span><br>
              <h5 class="text-success inline mr-10">Written Date: </h5><span id="docWritten"></span><br>
              <h5 class="text-success inline mr-10">Approved Date: </h5><span id="docSigned"></span><br>
            </div>
          </div>
          <div class="row mt-30" id="docImages" >
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success text-left ml-10" id="emailDocument">Email</button>
          <button type="button" class="btn btn-danger text-left" data-dismiss="modal" >Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /Document view modal content -->
  <!-- Edit M3odal -->
  <div class="modal fade " id="editDocumentModal" tabindex="-1" role="dialog" aria-labelledby="Edit Document" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h6 class="modal-title" id="title">{{trans_choice('common.folder', 2)}}: <span id="docFolder" ></span> </h6>
        </div>
        <div class="modal-body">
          <div class="row">
            @include('documents._form',compact('organizations','folders'))

          </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger text-left" data-dismiss="modal" >Cancel</button>
          <button type="submit" class="btn btn-info text-left ml-10"  >{{__('common.save')}}</button>
          {!!Form::close()!!} 
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /Edit modal -->

  <!-- Email M3odal -->
  <div class="modal fade" id="emailDocumentModal" aria-hidden="true" role="dialog" aria-labelledby="Email Document" tabindex="-1"  style="display: none;">
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
  <!-- /Email modal -->
  
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