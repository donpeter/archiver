@component('mail::message')
# New Documents


<br> 

@foreach($document->files as $file)
  <img src="{{ url('/upload/'.$file->slug)}}" class="thumbnail">
@endforeach

<br>

Regards.<br>

{{ config('app.name') }}
@endcomponent
