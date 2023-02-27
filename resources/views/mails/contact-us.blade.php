@component('mail::message')
# Message from a {{$firstName . ' ' . $lastName}} (email: {{$email}}) (subject: {{$subject}})

{{$message}}

{{ config('app.name') }}
@endcomponent
