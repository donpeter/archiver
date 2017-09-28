<div class="panel panel-default card-view">
  <div class="panel-heading">
    <div class="pull-left">
      @if($trash)
        <h6 class="panel-title txt-dark">{{__('common.trash').' '.__('common.users')}}</h6>
      @else
        <h6 class="panel-title txt-dark">{{__('common.manage').' '.__('common.users')}}</h6>
      @endif
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="panel-wrapper collapse in">
    <div class="panel-body">
      <div class="table-wrap mt-20">
        <div class="table-responsive">
          <table id="users" class="table table-hover display mb-30 dataTable no-footer" style="cursor: pointer;" role="grid">
            <thead>
              <tr role="row">
                <th class="sorting">
                  {{trans_choice('common.name',1)}}
                </th>
                <th class="sorting" >
                  {{trans_choice('common.username',1)}}
                </th>
                <th class="sorting" >
                  {{trans_choice('common.email',1)}}
                </th>
                <th class="sorting">
                  {{trans_choice('common.role',1)}}
                </th>
                <th class="sorting" style="width: 10%;">{{__('common.action')}}</th>
              </tr>
            </thead>
            <tfoot>
              <tr role="row">
                <th class="sorting">
                  {{trans_choice('common.name',1)}}
                </th>
                <th class="sorting" >
                  {{trans_choice('common.username',1)}}
                </th>
                <th class="sorting" >
                  {{trans_choice('common.email',1)}}
                </th>
                <th class="sorting">
                  {{trans_choice('common.role',1)}}
                </th>
                <th class="sorting" style="width: 10%;">{{__('common.action')}}</th>
              </tr>
            </tfoot>
            <tbody>
            @foreach($users as $user) 
            <tr role="row" class="odd">
              <td tabindex="1" class="sorting_1">{{$user->name}}</td>
              <td tabindex="1">{{$user->username}}</td>
              <td tabindex="1">{{$user->email}}</td>
              <td tabindex="1">{{$user->role}}</td>
            @if($editable)
              <td tabindex="1">
                @if(!$trash)
                <a href="{{route('user.documents', ['user' => $user->id])}}" class="text-inverse pr-5" data-toggle="tooltip" data-original-title="{{__('common.view')}}">
                <i class="zmdi zmdi-eye txt-success"></i>
                </a>
                @can('update',$user)
                  <a href="javascript:void(0)" class="text-inverse pr-5" title="{{__('common.edit')}}" data-target="#editModal" data-toggle="modal" data-original-title="{{__('common.edit')}}" data-id="{{$user->id}}" >
                  <i class="zmdi zmdi-edit txt-warning"></i>
                  </a>
                @endcan
                @can('delete',$user)
                  <a href="javascript:void(0)" class="text-inverse sa-delete" data-id="{{$user->id}}" data-toggle="tooltip" data-original-title="{{__('common.delete')}}">
                  <i class="zmdi zmdi-delete txt-danger"></i>
                  </a>
                @endcan
                @else

                  @can('restore',$user)
                    <a href="javascript:void(0)"  class="text-inverse sa-restore" data-id="{{$user->id}}" data-toggle="tooltip"  data-original-title="{{__('common.restore')}}">
                    <i class="zmdi zmdi-undo text-warning zmdi-hc-lg"></i>
                    </a>
                  @endcan
                @endif
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
              @include('users._form',['modal'=>true,'route' =>['user.update',1]])
               
            </div>

          </div>
        </div>
      </div>
    @endif  
</div>