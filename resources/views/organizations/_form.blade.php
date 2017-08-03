{!! Form::open( ['route' => $route, 'id'=>'addOrgranization'])!!}
  @if($modal)
    {!!Form::hidden('_method', 'patch')!!} 
    {!!Form::hidden('id', 'id',['id'=>'id'])!!}
  @endif
                  
  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!!Form::label('name', trans_choice('common.name',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('name',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.name',1).' ( 00-01 )', 'required'=>'required'] )!!}
    {!! $errors->first('name', '<span class ="help-block">:message</span> ') !!}
  </div>

  <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
    {!!Form::label('desc', trans_choice('common.desc',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::textarea('desc',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.desc',1),'rows'=> '5'] )!!}
    {!! $errors->first('desc', '<span class ="help-block">:message</span> ') !!}
  </div>
  <div class="form-group{{ $errors->has('archive_id') ? ' has-error' : '' }}">
    {!!Form::label('archive_id', trans_choice('common.archive',1), ['class' => 'control-label mb-10 '])!!}
    <select id='archive_id' name="archive_id" class="selectpicker form-control" data-style="btn-primary btn-outline" tabindex="-98">
      @foreach($archives as $archive)
        <option data-tokens="{{$archive->id }}" value="{{$archive->id }}" {{(old('archive_id') == $archive->id ) ? 'selected="selected"': '' }} >{{$archive->name }}</option>
      @endforeach
    </select>
    {!! $errors->first('archive_id', '<span class ="help-block">:message</span> ') !!}
  </div>

  <div class="form-group{{ $errors->has('license') ? ' has-error' : '' }}">
    {!!Form::label('license', trans_choice('common.license',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('license',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.license',1)] )!!}
    {!! $errors->first('license', '<span class ="help-block">:message</span> ') !!}
  </div>


  <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
    {!!Form::label('location', trans_choice('common.location',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::textarea('location',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.location',1), 'rows'=> '4']  )!!}
    {!! $errors->first('location', '<span class ="help-block">:message</span> ') !!}
  </div> 

  <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
    {!!Form::label('country', trans_choice('common.country',1), ['class' => 'control-label mb-10 '])!!}
    <select id='country' name="country" class="selectpicker form-control" data-style="btn-primary btn-outline" tabindex="-98">
      <option data-tokens="K.K.T.C" value="K.K.T.C" selected="selected">Kibris (KKTC)</option>
      <option data-tokens="Turkey" value="Turkey">Turkey (Türkiye)</option>
      <option data-tokens="Others" value="Others">Others (Diğerleri)</option>
    </select>
    {!! $errors->first('country', '<span class ="help-block">:message</span> ') !!}
  </div>

  
    @if($modal)
    </div>
      <div class="form-group modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">{{__('common.cancel')}}</button>
    @else
      <div class="form-group">
    @endif
    {!!Form::submit('Add', ['class'=>'btn btn-success pull-right'])!!}
  </div> 

{!! Form::close()!!}