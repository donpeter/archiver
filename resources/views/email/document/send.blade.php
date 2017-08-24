@component('mail::message')
# New Documents
When developing an application that sends email, you probably don't want to actually send emails to live email addresses. Laravel provides several ways to "disable" the actual sending of emails during local development.


<br> 

@foreach($document->files as $file)
  <img src="{{ url('/upload/'.$file->slug)}}" class="thumbnail">
@endforeach

<br>

Regards.<br>

{{ config('app.name') }}
@endcomponent
