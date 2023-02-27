@php
/** @var $patient \App\Models\Patient */
@endphp
@component('mail::message')

# New Patient Notification

We've detected a new patient who meets the criteria of the following notification:
<ul>
  <li><strong>Name</strong>: {{ $notification->getName() }}</li>
  <li><strong>Gender</strong>: {{ $notification->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
  <li><strong>Age</strong>: {{ $notification->getMinAge() . '-' . $notification->getMaxAge() }}</li>
  <li><strong>Height</strong>: {{ $notification->getMinHeight() . '-' . $notification->getMaxHeight() }} Cm</li>
  <li><strong>Weight</strong>: {{ $notification->getMinWeight() . '-' . $notification->getMaxWeight() }} Kg</li>
  <li><strong>Country</strong>: {{ $notification->getCountryCode() }}</li>
</ul>

Here are the information of the patient:
<ul>
  <li><strong>Patient Number</strong>: {{ $patient->getPatientNumber() }}</li>
  <li><strong>Name</strong>: {{ $patient->getFullName() }}</li>
  <li><strong>Age</strong>: {{ $patient->getAge() }}</li>
  <li><strong>Gender</strong>: {{ $patient->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
  <li><strong>Height</strong>: {{ $patient->getHeight() }} Cm</li>
  <li><strong>Weight</strong>: {{ $patient->getWeight() }} Kg</li>
  <li><strong>Country</strong>: {{ $patient->getCountryCode() }}</li>
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
