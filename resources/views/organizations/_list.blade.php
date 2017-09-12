<div class="panel panel-default card-view">
  <div class="panel-heading">
    <div class="pull-left">
      <h6 class="panel-title txt-dark">{{__('common.edit').' '.trans_choice('folder.title',1)}}</h6>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="panel-wrapper collapse in">
    <div class="panel-body">
      <p class="text-muted">{{trans('folder.subtitle')}}</p>
      <div class="table-wrap mt-20">
        <div class="table-responsive">
          <table id="organizations" class="table table-hover display mb-30 dataTable no-footer" style="cursor: pointer;" role="grid">
            <thead>
              <tr role="row">
                <th class="sorting">
                  {{trans_choice('common.name',1)}}
                </th>
                <th class="sorting" >
                  {{trans_choice('common.email',1)}}
                </th>
                <th class="sorting" >
                  {{trans_choice('common.location',1)}}
                </th>
                <th class="sorting">
                  {{trans_choice('common.country',1)}}
                </th>
              @if($editable)
                <th class="sorting" style="width: 10%;">Action</th>
              @endif
              </tr>
            </thead>
            <tfoot>
              <tr role="row">
                <th class="sorting_asc" >
                  {{trans_choice('common.name',1)}}
                </th>

                <th class="sorting" >
                  {{trans_choice('common.email',1)}}
                </th>

                <th class="sorting">
                  {{trans_choice('common.location',1)}}
                </th>

                <th class="sorting">
                  {{trans_choice('common.country',1)}}
                </th>

                <th class="sorting">
                  {{trans_choice('common.action',1)}}
                </th>
                
            </tfoot>
            <tbody>
            @foreach($organizations as $key => $organization) 
            <tr role="row" class="odd">
              <td tabindex="1" class="sorting_1">{{$organization->name}}</td>
              <td tabindex="1">{{$organization->email}}</td>
              <td tabindex="1">{{$organization->location}}</td>
              <td tabindex="1">{{$organization->country}}</td>
            @if($editable)
              <td tabindex="1">
                <a href="organization/{{$organization->id}}" class="text-inverse pr-5" data-toggle="tooltip" data-original-title="{{__('common.view')}}">
                <i class="zmdi zmdi-eye txt-success"></i>
                </a>
                @can('update',$organization)
                <a href="javascript:void(0)" class="text-inverse pr-5" title="{{__('common.edit')}}" data-target="#editModal" data-toggle="modal" data-original-title="{{__('common.edit')}}" 
                data-id="{{$organization->id}}" 
                data-name="{{$organization->name}}" 
                data-email="{{$organization->email}}"  
                data-location="{{$organization->location}}" 
                data-country="{{$organization->country}}">
                <i class="zmdi zmdi-edit txt-warning"></i>
                </a>
                @endcan

                @can('delete', $organization)
                <a href="javascript:void(0)" class="text-inverse sa-warning" data-id="{{$organization->id}}"
                data-name="{{$organization->name}}" data-toggle="tooltip" data-original-title="{{__('common.delete')}}">
                <i class="zmdi zmdi-delete txt-danger"></i>
                </a>
                @endcan
              </td>
            @endif
            </tr>
            @endforeach
            </tbody>
          </table>
            
          </div>
      </div>
    </div>
    @if($editable)
      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h5 class="modal-title" id="editModalLabel">{{__('common.edit')}} {{trans_choice('folder.title',1)}}</h5>
            </div>
            <div class="modal-body">
              @include('organizations._form',['modal'=>true,'route' =>['organization.update',1]])
               
            </div>

          </div>
        </div>
      </div>
    @endif  
</div>