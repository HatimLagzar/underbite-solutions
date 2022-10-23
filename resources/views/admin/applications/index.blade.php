@php
  /** @var $applications \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] */
@endphp

@extends('admin.layout.auth-template')
@section('title')
  Applications
@endsection
@section('content')
  <div class="row mb-3">
    <div class="col">
      <h2>Applications</h2>
    </div>
  </div>
  <div class="row">
    @foreach($applications as $application)
      <div class="col-3 mb-3">
        <div class="card shadow-sm">
          <div class="card-body">
            <button type="button" class="btn p-0 d-block mx-auto mb-2" data-bs-toggle="modal" data-bs-target="#application-{{$application->getId()}}">
              <img class="img-fluid"
                   src="{{ url('storage/patients_images/' . $application->getImages()->first()->getFileName()) }}" alt="">
            </button>
            <h5 class="text-center">{{ $application->getFullName() }}</h5>
            <ul class="list-unstyled">
              <li>Age: {{ $application->getAge() }}</li>
              <li>Gender: {{ $application->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
              <li>Height: {{ $application->getHeight() }} cm</li>
              <li>Weight: {{ $application->getWeight() }} Kg</li>
              <li>Country: {{ $application->getCountry()->getNiceName() }}</li>
              <li>Contact: <a href="mailto:{{ $application->getEmail() }}">{{ $application->getEmail() }}</a></li>
              <li>Qualified: {{ $application->isQualified() ? 'Qualified' : 'Non-Qualified' }}</li>
            </ul>

            <form action="{{ route('admin.applications.unqualify', ['id' => $application->getId()]) }}" method="post" class="d-inline-block">
              @csrf
              <button class="btn btn-sm btn-danger"><i class="fa fa-close me-1"></i>Non-Qualify</button>
            </form>
            <form action="{{ route('admin.applications.qualify', ['id' => $application->getId()]) }}" method="post" class="d-inline-block">
              @csrf
              <button class="btn btn-sm btn-primary"><i class="fa fa-check me-1"></i>Qualify</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @foreach($applications as $application)
    <div class="modal fade" id="application-{{$application->getId()}}" tabindex="-1" aria-labelledby="application-{{$application->getId()}}-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $application->getFullName() }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="carousel-application-{{ $application->getId() }}" class="carousel slide mb-3" data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach($application->getImages() as $key => $image)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                  <img src="{{ url('storage/patients_images/' . $image->getFileName()) }}" class="d-block w-100" alt="...">
                </div>
                @endforeach
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carousel-application-{{ $application->getId() }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carousel-application-{{ $application->getId() }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <h5 class="text-center">{{ $application->getFullName() }}</h5>
            <ul class="list-unstyled">
              <li>Age: {{ $application->getAge() }}</li>
              <li>Gender: {{ $application->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
              <li>Height: {{ $application->getHeight() }} cm</li>
              <li>Weight: {{ $application->getWeight() }} Kg</li>
              <li>Country: {{ $application->getCountry()->getNiceName() }}</li>
              <li>Contact: <a href="mailto:{{ $application->getEmail() }}">{{ $application->getEmail() }}</a></li>
              <li>Qualified: {{ $application->isQualified() ? 'Qualified' : 'Non-Qualified' }}</li>
            </ul>

            <form action="{{ route('admin.applications.unqualify', ['id' => $application->getId()]) }}" method="post" class="d-inline-block">
              @csrf
              <button class="btn btn-sm btn-danger"><i class="fa fa-close me-1"></i>Non-Qualify</button>
            </form>
            <form action="{{ route('admin.applications.qualify', ['id' => $application->getId()]) }}" method="post" class="d-inline-block">
              @csrf
              <button class="btn btn-sm btn-primary"><i class="fa fa-check me-1"></i>Qualify</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@endsection