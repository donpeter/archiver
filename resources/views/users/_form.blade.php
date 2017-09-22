{!! Form::open( ['route' => $route, 'id'=>'addUser'])!!}
  @if($modal)
    {!!Form::hidden('_method', 'patch')!!} 
  @endif
                  
  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!!Form::label('name', trans_choice('common.name',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('name',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.name',1), 'required'=>'required'] )!!}
    {!! $errors->first('name', '<span class ="help-block">:message</span> ') !!}
  </div>

  @unless($modal)
  <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
    {!!Form::label('username', trans_choice('common.username',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('username',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.username',1), 'rows'=> '4']  )!!}
    {!! $errors->first('username', '<span class ="help-block">:message</span> ') !!}
  </div>
  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    {!!Form::label('email', trans_choice('common.email',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('email',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.email',1)] )!!}
    {!! $errors->first('email', '<span class ="help-block">:message</span> ') !!}
  </div>
  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!!Form::label('password', trans_choice('common.password',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::password('password', ['class'=>'form-control', 'placeholder'=> trans_choice('common.password',1)] )!!}
    {!! $errors->first('password', '<span class ="help-block">:message</span> ') !!}
  </div>
  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    {!!Form::label('password_confirmation', __('common.verify').' '.__('common.password'), ['class' => 'control-label mb-10 '])!!}
    {!!Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=> __('common.verify').' '.__('common.password'), 'required'=>'required'] )!!}
    {!! $errors->first('password_confirmation', '<span class ="help-block">:message</span> ') !!}
  </div>

  @endunless

  
  @if($modal)
  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    {!!Form::label('password', trans_choice('common.password',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::password('password', ['class'=>'form-control', 'placeholder'=> trans_choice('common.password',1)] )!!}
    {!! $errors->first('password', '<span class ="help-block">:message</span> ') !!}
  </div>
  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    {!!Form::label('password_confirmation', __('common.verify').' '.__('common.password'), ['class' => 'control-label mb-10 '])!!}
    {!!Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=> __('common.verify').' '.__('common.password')] )!!}
    {!! $errors->first('password_confirmation', '<span class ="help-block">:message</span> ') !!}
  </div>
  @endif


  
  <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
    {!!Form::label('role', trans_choice('common.role',1), ['class' => 'control-label mb-10 '])!!}
    <select id='role' name="role" class="selectpicker form-control" data-style="btn-primary btn-outline" tabindex="-98">
      <option data-tokens="user" value="user" selected="selected">{{trans_choice('common.user',1)}}</option>
      <option data-tokens="staff" value="staff">{{__('common.staff')}}</option>
      <option data-tokens="admin" value="admin">{{__('common.admin')}}</option>
    </select>
    {!! $errors->first('role', '<span class ="help-block">:message</span> ') !!}
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