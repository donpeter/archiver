{!! Form::open( ['route' => 'document.store', 'id'=>'addOrgranization'])!!}

  <div class="form-group{{ $errors->has('ref') ? ' has-error' : '' }}">
    {!!Form::label('ref', trans_choice('common.ref',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('ref',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.ref',1), 'required'=>'required'] )!!}
    {!! $errors->first('ref', '<span class ="help-block">:message</span> ') !!}
  </div>

  <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!!Form::label('title', trans_choice('common.title',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('title',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.title',1), 'required'=>'required'] )!!}
    {!! $errors->first('title', '<span class ="help-block">:message</span> ') !!}
  </div>  

  <div class="form-group{{ $errors->has('sender') ? ' has-error' : '' }}">
    {!!Form::label('sender', trans_choice('common.sender',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('sender',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.sender',1), 'required'=>'required'] )!!}
    {!! $errors->first('sender', '<span class ="help-block">:message</span> ') !!}
  </div>  

  <div class="form-group{{ $errors->has('reciever') ? ' has-error' : '' }}">
    {!!Form::label('reciever', trans_choice('common.reciever',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('reciever',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.reciever',1), 'required'=>'required'] )!!}
    {!! $errors->first('reciever', '<span class ="help-block">:message</span> ') !!}
  </div>  

  <div class="form-group{{ $errors->has('prepaired') ? ' has-error' : '' }}">
    {!!Form::label('prepaired', trans_choice('common.prepaired',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('prepaired',null, ['class'=>'form-control input-limit-datepicker', 'placeholder'=> trans_choice('common.prepaired',1), 'required'=>'required'] )!!}
    {!! $errors->first('prepaired', '<span class ="help-block">:message</span> ') !!}
  </div>    

  <div class="form-group{{ $errors->has('signed') ? ' has-error' : '' }}">
    {!!Form::label('signed', trans_choice('common.signed',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('signed',null, ['class'=>'form-control input-limit-datepicker', 'placeholder'=> trans_choice('common.signed',1), 'required'=>'required'] )!!}
    {!! $errors->first('signed', '<span class ="help-block">:message</span> ') !!}
  </div>  

  <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    {!!Form::label('status', trans_choice('common.status',1), ['class' => 'control-label mb-10 '])!!}
    {!!Form::text('status',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.status',1), 'required'=>'required'] )!!}
    {!! $errors->first('status', '<span class ="help-block">:message</span> ') !!}
  </div>

{!!Form::close()!!} 