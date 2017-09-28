{!! Form::open( ['route' => $route, 'id'=>'addOrgranization', 'name' => 'createOrganization'])!!}
  @if($modal)
    {!!Form::hidden('_method', 'patch')!!} 
  @endif
                  
  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!!Form::label('name', trans_choice('common.name',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('name',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.name',1).' ( Lefek Belediyesi )', 'required'=>'required'] )!!}
    {!! $errors->first('name', '<span class ="help-block">:message</span> ') !!}
  </div>
  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!!Form::label('email', trans_choice('common.email',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('email',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.email',1)] )!!}
    {!! $errors->first('email', '<span class ="help-block">:message</span> ') !!}
  </div>
  
  <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
    {!!Form::label('location', trans_choice('common.location',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::textarea('location',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.location',1), 'rows'=> '4']  )!!}
    {!! $errors->first('location', '<span class ="help-block">:message</span> ') !!}
  </div> 

  <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
    {!!Form::label('country', trans_choice('common.country',1), ['class' => 'control-label mb-10 '])!!}
    <select id='country' name="country" class="selectpicker form-control" data-style="btn-primary btn-outline" tabindex="-98">
      <option data-tokens="K.K.T.C" value="K.K.T.C" selected="selected">Kıbrıs (K.K.T.C)</option>
      <option data-tokens="Turkey" value="Turkey">Turkey (Türkiye)</option>
      <option data-tokens="Others" value="Others">Others (Diğerleri)</option>
    </select>
    {!! $errors->first('country', '<span class ="help-block">:message</span> ') !!}
  </div>

  
    @if($modal)
      <div class="form-group modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">{{__('common.cancel')}}</button>
        {!!Form::submit(__('common.save'), ['class'=>'btn btn-success pull-right'])!!}
    @else
      <div class="form-group">
        {!!Form::submit(__('common.add'), ['class'=>'btn btn-success pull-right'])!!}
    @endif
  </div> 

{!! Form::close()!!}