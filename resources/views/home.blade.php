
@extends('layouts.app')

@section('title', __('navbar.dashboard'))
@section('pageTitle', trans_choice('navbar.dashboard',1))

@section('breadcrumb')
  <li><a href="{{route('home')}}">{{trans_choice('navbar.dashboard',1) }}</a></li>
@endsection
@section('content')
    <!-- Row -->
    <div class="row mt-0">
      <a href="{{route('user.index')}}">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box bg-red">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                        <span class="txt-light block counter"><span class="counter-anim">{{$userCount}}</span></span>
                        <span class="weight-500 uppercase-font txt-light block font-13">{{trans_choice('common.user', 2)}}</span>
                      </div>
                      <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                        <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                      </div>
                    </div>	
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a> 
      <a href="{{route('document.index')}}">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box bg-green">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                        <span class="txt-light block counter"><span class="counter-anim">{{$documentCount}}</span></span>
                        <span class="weight-500 uppercase-font txt-light block">{{trans_choice('common.document',2)}}</span>
                      </div>
                      <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                        <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                      </div>
                    </div>	
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <a href="{{route('folder.index')}}">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box bg-yellow">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                        <span class="txt-light block counter"><span class="counter-anim">{{$folderCount}}</span></span>
                        <span class="weight-500 uppercase-font txt-light block">{{trans_choice('common.folder',2) }}</span>
                      </div>
                      <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                        <i class="icon-folder-alt txt-light data-right-rep-icon"></i>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <a href="{{route('organization.index')}}">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                <div class="sm-data-box bg-blue">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                        <span class="txt-light block counter"><span class="counter-anim">{{$organizationCount}}</span></span>
                        <span class="weight-500 uppercase-font txt-light block">{{trans_choice('common.organization',2)}}</span>
                      </div>
                      <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                        <i class="pe-7s-culture txt-light data-right-rep-icon"></i>
                      </div>
                    </div>	
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Row -->
    <div class="row">
        <div class="col-lg-5 col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div id="weather_1" class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <div class="dropdown inline-block">
                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle border-none pa-0 font-16" type="button"><span></span><i class="zmdi  zmdi-chevron-down ml-15"></i></button>
                            <ul class="dropdown-menu bullet dropdown-menu-left"  role="menu">
                                <li role="presentation"><a href="javascript:void(0)" role="menuitem" onclick="getWeatherForcast('Lefke')"><i class="icon wb-reply" aria-hidden="true"></i>Lefke</a></li>
                                <li role="presentation"><a href="javascript:void(0)" role="menuitem" onclick="getWeatherForcast('Lefkoşa ')"><i class="icon wb-reply" aria-hidden="true"></i>Lefkosa</a></li>
                                <li role="presentation"><a href="javascript:void(0)" role="menuitem" onclick="getWeatherForcast('Güzelyurt ')"><i class="icon wb-reply" aria-hidden="true"></i>Guzelyurt</a></li>
                                <li role="presentation"><a href="javascript:void(0)" role="menuitem" onclick="getWeatherForcast('Girne')"><i class="icon wb-share" aria-hidden="true"></i>Girne</a></li>
                                <li role="presentation"><a href="javascript:void(0)" role="menuitem" onclick="getWeatherForcast('Magusa')"><i class="icon wb-trash" aria-hidden="true"></i>Magusa</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <h6 class="block nowday"></h6>
                        <span class="block nowdate"></span>
                        <div class="weather weatherapp mt-15"></div>
                    </div>
                </div>
             </div>
                </div>
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                      <div class="panel-heading">
                        <div class="pull-left">
                          <h6 class="panel-title txt-dark">{{__('common.folders')}}</h6>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                      <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                          <div class="table-wrap mt-20">
                            <div class="table-responsive">
                              <table id="folders" class="table table-hover display mb-30 dataTable no-footer" style="cursor: pointer;" role="grid" aria-describedby="edit_datable_info">
                                <thead>
                                  <tr role="row">
                                    <th class="sorting_asc" tabindex="0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="{{trans('common.ref')}}: {{trans('common.sort')}}" style="width: 166px;">{{trans('common.ref')}}
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-label="{{trans_choice('common.name',1)}}: {{trans('common.sort')}}" style="width: 289px;">{{trans_choice('common.name',1)}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-label="{{trans_choice('common.desc',1)}}: {{trans_choice('common.sort',1)}}" style="width: 250px;">{{trans_choice('common.desc',1)}}:
                                    </th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="{{trans('common.ref')}}: {{trans('common.sort')}}" style="width: 166px;">{{trans('common.ref')}}
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-label="{{trans_choice('common.name',1)}}: {{trans('common.sort')}}" style="width: 289px;">{{trans_choice('common.name',1)}}
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-label="{{trans_choice('common.desc',1)}}: {{trans_choice('common.sort',1)}}" style="width: 250px;">{{trans_choice('common.desc',1)}}
                                    </th>
                                  </tr>   
                                </tfoot>
                                <tbody>
                                  @foreach($folders as $key => $folder) 
                                    <tr role="row" class="odd">
                                      <td tabindex="1" class="sorting_1">{{$folder->ref}}</td>
                                      <td tabindex="1">{{$folder->name}}</td>
                                      <td tabindex="1">{{$folder->desc}}</td>
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
            </div>
         </div>
        <div class="col-lg-7 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div id="weather_2" class="panel panel-default card-view pa-0 weather-info">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="row ma-0">
                                    <div class="col-xs-6 pa-0">
                                        <div class="left-block-wrap pa-30">
                                            <p class="block nowday"></p>
                                            <span class="block nowdate"></span>
                                            <div class="left-block  mt-15"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 pa-0">
                                        <div class="right-block-wrap pa-30">
                                            <div class="right-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div id="weather_3" class="panel panel-default card-view pa-0 weather-warning">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="row ma-0">
                                    <div class="col-xs-6 pa-0">
                                        <div class="left-block-wrap pa-30">
                                            <p class="block nowday"></p>
                                            <span class="block nowdate"></span>
                                            <div class="left-block  mt-15"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 pa-0">
                                        <div class="right-block-wrap pa-30">
                                            <div class="right-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div id="weather_4" class="panel panel-default card-view pa-0 weather-danger">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="row ma-0">
                                    <div class="col-xs-6 pa-0">
                                        <div class="left-block-wrap pa-30">
                                            <p class="block nowday"></p>
                                            <span class="block nowdate"></span>
                                            <div class="left-block  mt-15"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 pa-0">
                                        <div class="right-block-wrap pa-30">
                                            <div class="right-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div id="weather_5" class="panel panel-default card-view pa-0 weather-success">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="row ma-0">
                                    <div class="col-xs-6 pa-0">
                                        <div class="left-block-wrap pa-30">
                                            <p class="block nowday"></p>
                                            <span class="block nowdate"></span>
                                            <div class="left-block  mt-15"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 pa-0">
                                        <div class="right-block-wrap pa-30">
                                            <div class="right-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
              <div class="panel panel-default card-view">
                <div class="panel-heading">
                  <div class="pull-left">
                    <h6 class="panel-title txt-dark">{{__('common.documents')}}</h6>
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
                            <tr role="row" style="width: 15%;">
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
                              <th class="sorting" style="width: 8%;">
                                {{__('common.type')}}
                              </th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr role="row">
                              <th class="sorting" style="width: 15%;">
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

                              <th class="sorting" style="width: 8%;">
                                {{__('common.type')}}
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
                              <td tabindex="1" class="sorting_1">
                                @if($document->type == 'incomming')
                                  <i class="fa fa-paper-plane text-success" title="Incomming" data-target="tooltip" data-toggle="tooltip" data-original-title="Incomming"></i>
                                @else
                                  <i class="fa fa-paper-plane fa-rotate-180 text-info" title="Outgoing" data-target="tooltip" data-toggle="tooltip" data-original-title="Outgoing"></i>
                                @endif
                                <span class="sr-only">{{$document->type}}</span>
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
        </div>
    </div>
    <!-- /Row -->
@endsection

@push('vendorStyles')
    <link href="{{asset('css/datatable.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
    <script src="js/datatable.min.js"></script>
   <!-- simpleWeather JavaScript -->
    <script src="vendors/bower_components/moment/min/moment.min.js"></script>
    <script src="vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
    
    <!-- Progressbar Animation JavaScript -->
    <script src="vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="dist/js/dashboard.js"></script>



@endpush
