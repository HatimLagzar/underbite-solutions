@php
/** @var $patient \App\Models\Patient */
@endphp
@component('mail::message')

# New Patient Notification

We've detected a new patient who meets the criteria of the following notification:
<ul>
  <li>Name: {{ $notification->getName() }}</li>
  <li>Gender: {{ $notification->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
  <li>Age: {{ $notification->getMinAge() . '-' . $notification->getMaxAge() }}</li>
  <li>Height: {{ $notification->getMinHeight() . '-' . $notification->getMaxHeight() }} Cm</li>
  <li>Weight: {{ $notification->getMinWeight() . '-' . $notification->getMaxWeight() }} Kg</li>
  <li>Country: {{ $notification->getCountryCode() }}</li>
</ul>

Here are the information of the patient:
<ul>
  <li>Name: {{ $patient->getFullName() }}</li>
  <li>Age: {{ $patient->getAge() }}</li>
  <li>Gender: {{ $patient->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
  <li>Height: {{ $patient->getHeight() }} Cm</li>
  <li>Weight: {{ $patient->getWeight() }} Kg</li>
  <li>Country: {{ $patient->getCountryCode() }}</li>
</ul>

<ul style="padding: 0; margin: 0 auto; display: block; text-align: center;">
  @foreach($patient->images()->get() as $image)
    <li style="display: inline-block; list-style-type: none; margin-right: 10px;"><img width="100" src="{{ url('storage/patients_images/' . $image->getFileName()) }}"></li>
  @endforeach
</ul>

<br>
<br>

{{ config('app.name') }}
@endcomponent
