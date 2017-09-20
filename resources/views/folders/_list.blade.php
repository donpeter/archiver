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
          <table id="folders" class="table table-hover display mb-30 dataTable no-footer" style="cursor: pointer;" role="grid" aria-describedby="edit_datable_info">
            <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="{{trans('common.ref')}}: {{trans('common.sort')}}" style="width: 166px;">{{trans('common.ref')}}
                </th>
                <th class="sorting" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-label="{{trans_choice('common.name',1)}}: {{trans('common.sort')}}" style="width: 289px;">{{trans_choice('common.name',1)}}</th>
                <th class="sorting" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-label="{{trans_choice('common.desc',1)}}: {{trans_choice('common.sort',1)}}" style="width: 250px;">{{trans_choice('common.desc',1)}}:
                </th>
              @if($editable)
                <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 68px;">Action</th>
              @endif
              </tr>
            </thead>
            <tfoot>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="{{trans('common.ref')}}: {{trans('common.sort')}}" style="width: 166px;">{{trans('common.ref')}}
                </th>
                <th class="sorting" tabindex="0" aria-controls="edit_datable" rowspan="1" colspan="1" aria-label="{{trans_choice('common.name',1)}}: {{trans('common.sort')}}" style="width: 289px;">{{trans_choice('common.name',1)}}</th>
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
              @if($editable)
                <td tabindex="1">
                  <a href="{{$folder->ref}}" class="text-inverse pr-5 sa-view" title="view" data-target="tooltip" data-toggle="tooltip" data-original-title="View"   >
                  <i class="zmdi zmdi-eye txt-success"></i>
                  </a>
                  @if(!$trash)
                    @can('update',$folder)
                      <a href="" class="text-inverse pr-10" title="edit" data-id="{{$folder->id}}" data-target="#editModal" data-toggle="modal" data-original-title="Edit" data-ref="{{$folder->ref}}" data-name="{{$folder->name}}" data-desc="{{$folder->desc}}">
                      <i class="zmdi zmdi-edit txt-warning"></i>
                      </a>
                    @endcan

                    @can('delete',$folder)
                      <a href="" class="text-inverse sa-warning" title="" data-id="{{$folder->id}}" data-ref="{{$folder->ref}}" data-name="{{$folder->name}}" data-toggle="tooltip" data-original-title="Delete">
                      <i class="zmdi zmdi-delete txt-danger"></i>
                      </a>
                    @endcan
                  @else
                    @can('restore',$folder)
                      <a href=""  class="text-inverse sa-restore" data-toggle="tooltip"  data-original-title="{{__('common.restore')}}">
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
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="editModalLabel">{{__('common.edit')}} {{trans_choice('folder.title',1)}}</h5>
      </div>
      <div class="modal-body">
        {!! Form::open( ['route' => null,'id'=>'editForm','method'=>'patch'])!!}
          <input type="text" name="ref" id="ref" hidden="hidden">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!!Form::label('name', trans_choice('common.name',1), ['class' => 'control-label mb-10 '])!!}
            {!!Form::text('name',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.name',1), 'required'=>'required'] )!!}
            {!! $errors->first('name', '<span class ="help-block">:message</span> ') !!}
          </div> 
          <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
            {!!Form::label('desc', trans_choice('common.desc',1), ['class' => 'control-label mb-10 '])!!}
            {!!Form::textarea('desc',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.desc',1)] )!!}
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