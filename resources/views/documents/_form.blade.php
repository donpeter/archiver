
<div class="col-md-9">
  <div class="form-wrap">
    {!! Form::open( ['action' => ['DocumentController@update',1], 'id'=>'updateDocument','files' => true, 'method' => 'PUT'])!!}
      {{ csrf_field() }}

    
    <div class="row">
      <div class="col-md-4">
        <div class="form-group{{ $errors->has('ref') ? ' has-error' : '' }}">
          {!!Form::label('ref', trans_choice('common.ref',1), ['class' => 'control-label mb-10 '])!!}
          {!!Form::text('ref',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.ref',1), 'required'=>'required'] )!!}
          {!! $errors->first('ref', '<span class ="help-block">:message</span> ') !!}
        </div>
      </div>
      <div class="col-md-8">
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          {!!Form::label('title', trans_choice('common.title',1), ['class' => 'control-label mb-10 '])!!}
          {!!Form::text('title',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.title',1), 'required'=>'required'] )!!}
          {!! $errors->first('title', '<span class ="help-block">:message</span> ') !!}
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
          {!!Form::label('desc', trans_choice('common.desc',1), ['class' => 'control-label mb-10 '])!!}
          {!!Form::textarea('desc',null, ['class'=>'form-control', 'placeholder'=> trans_choice('common.desc',1)] )!!}
          {!! $errors->first('desc', '<span class ="help-block">:message</span> ') !!}
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="row mt-30" id="editDocImages" >
        </div>
        <br />
        <div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
          {!!Form::label('files', trans_choice('common.file',1), ['class' => 'control-label mb-10 '])!!}
          {!!Form::file('files[]', ['class'=>'form-control', 'multiple','id'=>'files'] )!!}
          {!! $errors->first('files', '<span class ="help-block">:message</span> ') !!}
        </div> 
      </div>
    </div>
                                                                                                                                       
  </div>
</div>
<div class="col-md-3">
    <div class="form-wrap">
      
      <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
        {!!Form::label('type', trans_choice('common.type',1), ['class' => 'control-label mb-10 '])!!}
        {!!Form::select('type', ['incomming' => 'Incomming', 'outgoing' => 'Outgoing'], 'incomming', ['placeholder' => trans_choice('common.type',1), 'class' => 'form-control'])!!}
        {!! $errors->first('type', '<span class ="help-block">:message</span> ') !!}
      </div>

      @if(Auth::user()->role === 'admin')
        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
          {!!Form::label('user_id', trans_choice('common.user',1), ['class' => 'control-label mb-10 '])!!}
          <select id='user_id' name="user_id" class="form-control" data-style="btn-primary btn-outline" tabindex="-98">
            @foreach($users as $user)
              <option data-tokens="{{$user->id }}" value="{{$user->id }}" {{(old('user_id') == $user->id ) ? 'selected="selected"': '' }} >{{$user->name }}</option>
            @endforeach
          </select>
          {!! $errors->first('user_id', '<span class ="help-block">:message</span> ') !!}
        </div> 
      @endif

      <div class="form-group{{ $errors->has('folder_id') ? ' has-error' : '' }}">
        {!!Form::label('folder_id', trans_choice('common.folder',1), ['class' => 'control-label mb-10 '])!!}
        <select  name="folder_id" class="form-control" data-style="btn-primary btn-outline" tabindex="-98">
          @foreach($folders as $folder)
            <option data-tokens="{{$folder->id }}" value="{{$folder->id }}" {{(old('folder_id') == $folder->id ) ? 'selected="selected"': '' }} >{{$folder->name }}</option>
          @endforeach
        </select>
        {!! $errors->first('folder_id', '<span class ="help-block">:message</span> ') !!}
      </div> 

      <div class="form-group{{ $errors->has('organization_id') ? ' has-error' : '' }}">
        {!!Form::label('organization_id', trans_choice('common.organization',1), ['class' => 'control-label mb-10 '])!!}
        <select id='organization_id' name="organization_id" class="form-control" data-style="btn-primary btn-primary" tabindex="-98">
          @foreach($organizations as $organization)
            <option data-tokens="{{$organization->id }}" value="{{$organization->id }}" {{(old('organization_id') == $organization->id ) ? 'selected="selected"': '' }} >{{$organization->name }}</option>
          @endforeach
        </select>
        {!! $errors->first('organization_id', '<span class ="help-block">:message</span> ') !!}
      </div>  

      <div class="form-group{{ $errors->has('written_on') ? ' has-error' : '' }}">
        {!!Form::label('written_on', trans_choice('common.written',1), ['class' => 'control-label mb-10 '])!!}
        {!!Form::text('written_on',null, ['class'=>'form-control datetimepicker', 'placeholder'=> trans_choice('common.prepaired',1)] )!!}
        {!! $errors->first('written_on', '<span class ="help-block">:message</span> ') !!}
      </div>    

      <div class="form-group{{ $errors->has('signed_on') ? ' has-error' : '' }}">
        {!!Form::label('signed_on', trans_choice('common.signed',1), ['class' => 'control-label mb-10 '])!!}
        {!!Form::text('signed_on',null, ['class'=>'form-control date datetimepicker', 'placeholder'=> trans_choice('common.signed',1)] )!!}
        {!! $errors->first('signed_on', '<span class ="help-block">:message</span> ') !!}
      </div>  

    </div>
</div>