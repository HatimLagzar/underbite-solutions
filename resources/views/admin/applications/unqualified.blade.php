@php
  /** @var $applications \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] */
@endphp

@extends('admin.layout.auth-template')
@section('title')
  Applications
@endsection
@section('content')
<div class="applications-page">

  @error('message')
  <div class="alert alert-danger">
    {{ $message }}
  </div>
  @enderror

  @error('emails')
  <div class="alert alert-danger">
    {{ $message }}
  </div>
  @enderror

  <button class="btn btn-dark btn-lg rounded-5 position-fixed d-block shadow-lg"
          type="button"
          id="send-mail-btn"
          data-bs-toggle="modal" data-bs-target="#emailModal"
          style="bottom: 25px;z-index: 12; right: 25px">
    <i class="fa fa-paper-plane me-2"></i>Email Patients
  </button>
  <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header py-0">
          <h1 class="modal-title fs-5" id="emailModalLabel">Send Email to Selected Patients</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="send-mail-form" method="post" action="{{ route('admin.applications.mail') }}">
            @csrf
            <label class="form-label" for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10" class="form-control w-100">Hi dear <<NAME>>,&NewLine;&NewLine;Thank you for submitting your application. We are currently receiving a high volume of applications and our processing is delayed, please wait while we review your application and get back to you with the next step. Your application number is <<APP_ID>>.&NewLine;&NewLine;While we process and review your application you can tell someone about our program who might also find it helpful.&NewLine;&NewLine;Thank you,&NewLine;&NewLine;</textarea>
            <button class="btn btn-sm btn-primary mt-2"><i class="fa fa-paper-plane me-1"></i>Send</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <h1 class="rounded-2 border p-2 text-center fw-bold" style="background-color: #aeaeae;font-size: 18px;">Non-Qualified</h1>
    </div>

    <div class="col-12">
      <x-advanced-patient-search />
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-4">
      <div class="actions-wrapper">
        <span>Actions:</span>
        <div style="display: inline-block">
          <button id="select-all" class="btn btn-sm btn-outline-primary me-1">Select All</button>
          <form id="qualify-mass" method="POST" action="{{ route('admin.applications.qualify') }}" class="d-inline-block me-1">
            @csrf
            <button class="btn btn-sm btn-outline-primary">Qualify</button>
          </form>
          <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-secondary"><i class="fa fa-repeat me-1"></i>Relaod</a>
        </div>
      </div>
    </div>

    <div class="col">
      <x-search-box-name-or-number :route="route('admin.applications.unqualified')" />
    </div>

    <div class="col-3">
      <span>Patients:</span>
      <form action="" method="get" style="display: inline-block">
        {{--        <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-light">Others</a>--}}
        <a href="{{ route('admin.applications.qualified') }}" class="btn btn-sm btn btn-primary">Qualified</a>
        <a href="{{ route('admin.applications.unqualified') }}" class="btn btn-sm btn btn-danger">Non-Qualified</a>
      </form>
    </div>
  </div>

  <div class="row">
    @foreach($applications as $application)
      <div class="col-3 px-1 mb-3">
        <div class="card shadow-sm">
          <div class="card-header  text-bg-secondary py-1">
            <label class="text-sm">
              <input class="select-patient form-check-inline me-1" type="checkbox" name="ids[]"
                     value="{{ $application->getId() }}">
              Select Patient
            </label>
          </div>
          <div class="card-body p-0">
            <button type="button" class="btn p-0 d-block mx-auto mb-2 modal-button-images" data-bs-toggle="modal"
                    data-bs-target="#application-{{$application->getId()}}">
              <img class="img-fluid"
                   src="{{ url('storage/patients_images/' . $application->getImages()->first()->getFileName()) }}"
                   loading="lazy"
                   alt="">
            </button>
            <div class="px-3 py-2">
              <h5 class="text-center">{{ $application->getFullName() }}</h5>
              <ul class="list-unstyled">
                <li><strong>Patient Number</strong>: {{ $application->getPatientNumber() }}</li>
                <li><strong>Age</strong>: {{ $application->getAge() }}</li>
                <li><strong>Gender</strong>: {{ $application->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
                <li><strong>Height</strong>: {{ $application->getHeight() }} cm</li>
                <li><strong>Weight</strong>: {{ $application->getWeight() }} Kg</li>
                <li><strong>Country</strong>: {{ $application->getCountry()->getName() }}</li>
                <li><strong>Email</strong>: <a href="mailto:{{ $application->getEmail() }}">{{ $application->getEmail() }}</a></li>
                <li><strong>Phone</strong>: <a href="tel:{{ $application->getFullPhoneNumberFormat() }}">{{ $application->getFullPhoneNumberFormat() }}</a></li>
                <li><strong>Submitted At</strong>: {{ $application->getCreatedAt()->format('m/d/Y h:i A') }}</li>
              </ul>

              <div class="actions">
                <form action="{{ route('admin.applications.unqualify') }}" method="post"
                      class="d-inline-block">
                  @csrf
                  <input type="hidden" name="ids[]" value="{{ $application->getId() }}">
                  <button class="btn btn-sm btn-danger"><i class="fa fa-close me-1"></i>Non-Qualify</button>
                </form>
                <form action="{{ route('admin.applications.qualify') }}" method="post"
                      class="d-inline-block">
                  @csrf
                  <input type="hidden" name="ids[]" value="{{ $application->getId() }}">
                  <button class="btn btn-sm btn-primary"><i class="fa fa-check me-1"></i>Qualify</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @foreach($applications as $application)
    <div class="modal fade" id="application-{{$application->getId()}}" tabindex="-1"
         aria-labelledby="application-{{$application->getId()}}-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header py-0">
            <div></div>
            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $application->getFullName() }}</h1>
            <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="carousel-application-{{ $application->getId() }}" class="carousel slide mb-3"
                 data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach($application->getImages() as $key => $image)
                  <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ url('storage/patients_images/' . $image->getFileName()) }}" class="d-block w-auto mx-auto"
                         style="height: 350px"
                         loading="lazy"
                         alt="...">
                  </div>
                @endforeach
              </div>
              <button class="carousel-control-prev" type="button"
                      data-bs-target="#carousel-application-{{ $application->getId() }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button"
                      data-bs-target="#carousel-application-{{ $application->getId() }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <ul class="list-unstyled">
              <li><strong>Patient Number</strong>: {{ $application->getPatientNumber() }}</li>
              <li><strong>Age</strong>: {{ $application->getAge() }}</li>
              <li><strong>Gender</strong>: {{ $application->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
              <li><strong>Height</strong>: {{ $application->getHeight() }} cm</li>
              <li><strong>Weight</strong>: {{ $application->getWeight() }} Kg</li>
              <li><strong>Country</strong>: {{ $application->getCountry()->getName() }}</li>
              <li><strong>Email</strong>: <a href="mailto:{{ $application->getEmail() }}">{{ $application->getEmail() }}</a></li>
              <li><strong>Phone</strong>: <a href="tel:{{ $application->getFullPhoneNumberFormat() }}">{{ $application->getFullPhoneNumberFormat() }}</a></li>
              <li><strong>Source</strong>: {{ isset(\App\Models\Patient::SOURCES[$application->getSource()]) ? \App\Models\Patient::SOURCES[$application->getSource()] : 'Unknown' }}</li>
              <li><strong>Submitted At</strong>: {{ $application->getCreatedAt()->format('m/d/Y h:i A') }}</li>
            </ul>

            <form action="{{ route('admin.applications.unqualify') }}" method="post"
                  class="d-inline-block">
              @csrf
              <input type="hidden" name="ids[]" value="{{ $application->getId() }}">
              <button class="btn btn-sm btn-danger"><i class="fa fa-close me-1"></i>Non-Qualify</button>
            </form>
            <form action="{{ route('admin.applications.qualify') }}" method="post"
                  class="d-inline-block">
              @csrf
              <input type="hidden" name="ids[]" value="{{ $application->getId() }}">
              <button class="btn btn-sm btn-primary"><i class="fa fa-check me-1"></i>Qualify</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection
