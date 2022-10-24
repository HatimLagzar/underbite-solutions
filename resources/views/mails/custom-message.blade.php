@component('mail::message')

{{$message}}

{{__('Best regards')}},<br>
{{ config('app.name') }}
@endcomponent
