@php
  /** @var $applications \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] */
@endphp

@extends('admin.layout.auth-template')
@section('title')
  Applications
@endsection
@section('content')

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
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="emailModalLabel">Send Email to Selected Patients</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="send-mail-form" method="post" action="{{ route('admin.applications.mail') }}">
            @csrf
            <label class="form-label" for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10" class="form-control w-100">{{ __('Hi, Congrats! You have been qualified.') }}</textarea>
            <button class="btn btn-sm btn-primary mt-2"><i class="fa fa-paper-plane me-1"></i>Send</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-9">
      <div class="card">
        <div class="card-header">
          Advanced Filters
        </div>
        <div class="card-body">
          <form action="" class="">
            <div class="form-group d-inline-block me-1">
              <h6>Age</h6>
              <label class="text-sm">
                From <input name="min_age" type="number" min="0" max="200"
                            class="form-control form-control-sm w-auto d-inline-block"
                            value="{{ request()->get('min_age') }}">
              </label>
              <label class="text-sm">
                To <input name="max_age" type="number" min="0" max="200"
                          class="form-control form-control-sm w-auto d-inline-block"
                          value="{{ request()->get('max_age') }}">
              </label>
            </div>

            <div class="form-group d-inline-block me-1">
              <h6>Height (cm)</h6>
              <label class="text-sm">
                From <input name="min_height" type="number" min="0" max="300"
                            class="form-control form-control-sm w-auto d-inline-block"
                            value="{{ request()->get('min_height') }}">
              </label>
              <label class="text-sm">
                To <input name="max_height" type="number" min="0" max="300"
                          class="form-control form-control-sm w-auto d-inline-block"
                          value="{{ request()->get('max_height') }}">
              </label>
            </div>

            <div class="form-group d-inline-block me-1">
              <h6>Weight (kg)</h6>
              <label class="text-sm">
                From <input name="min_weight" type="number" min="0" max="300"
                            class="form-control form-control-sm w-auto d-inline-block"
                            value="{{ request()->get('min_weight') }}">
              </label>
              <label class="text-sm">
                To <input name="max_weight" type="number" min="0" max="300"
                          class="form-control form-control-sm w-auto d-inline-block"
                          value="{{ request()->get('max_weight') }}">
              </label>
            </div>

            <div class="form-group d-inline-block me-1">
              <label>
                Gender
                <select name="gender" id="gender" class="form-select form-select-sm w-auto d-inline-block">
                  <option value>All</option>
                  <option value="1" {{ request()->get('gender') === '1' ? 'selected' : '' }}>Male</option>
                  <option value="2" {{ request()->get('gender') === '2' ? 'selected' : '' }}>Female</option>
                </select>
              </label>
            </div>
            <div class="form-group d-inline-block w-25 me-1 mt-2">
              <label for="country">Country</label>
              <select name="country" id="country" class="form-select form-select-sm w-50 d-inline-block">
                <option value>All</option>
                @foreach(\App\Models\Country::all() as $country)
                  <option
                      value="{{ $country->getCode() }}" {{ request()->get('country') === $country->getCode() ? 'selected' : '' }}>{{ $country->getName() }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group d-inline-block w-25 me-1 mt-2">
              <label for="continent">Continent</label>
              <select name="continent" id="continent" class="form-select form-select-sm w-50 d-inline-block">
                <option value>All</option>
                @foreach(\App\Models\Continent::all() as $continent)
                  <option
                      value="{{ $continent->getCode() }}" {{ request()->get('continent') === $continent->getCode() ? 'selected' : '' }}>{{ $continent->getName() }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group d-inline-block me-1 mt-2">
              <button class="btn btn-sm btn-primary"><i class="fa fa-search me-1"></i>Filter</button>
              <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-secondary"><i
                    class="fa fa-eraser me-1"></i>Clear</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-3">
      <h5>Quick Filters</h5>
      <form action="" method="get">
        <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-light">All</a>
        <a href="{{ route('admin.applications.qualified') }}" class="btn btn-sm btn btn-primary">Qualified</a>
        <a href="{{ route('admin.applications.unqualified') }}" class="btn btn-sm btn btn-primary">Non-Qualified</a>
      </form>
    </div>
  </div>

  <div class="actions-wrapper mb-3">
    <h6>Actions</h6>
    <div class="btn-group" role="group" aria-label="Basic outlined example">
      <form id="qualify-mass" method="POST" action="{{ route('admin.applications.qualify') }}" class="d-inline-block me-1">
        @csrf
        <button class="btn btn-sm btn-outline-primary">Qualify</button>
      </form>
      <form id="unqualify-mass" method="POST" action="{{ route('admin.applications.unqualify') }}" class="d-inline-block">
        @csrf
        <button class="btn btn-sm btn-outline-primary">Unqualify</button>
      </form>
    </div>
  </div>

  <div class="row">
    @foreach($applications as $application)
      <div class="col-3 mb-3">
        <div class="card shadow-sm">
          <div class="card-header">
            <label class="text-sm">
              <input class="select-patient form-check-inline me-1" type="checkbox" name="ids[]"
                     value="{{ $application->getId() }}">
              Select Patient
            </label>
          </div>
          <div class="card-body">
            <button type="button" class="btn p-0 d-block mx-auto mb-2" data-bs-toggle="modal"
                    data-bs-target="#application-{{$application->getId()}}">
              <img class="img-fluid"
                   src="{{ url('storage/patients_images/' . $application->getImages()->first()->getFileName()) }}"
                   alt="">
            </button>
            <h5 class="text-center">{{ $application->getFullName() }}</h5>
            <ul class="list-unstyled">
              <li>Age: {{ $application->getAge() }}</li>
              <li>Gender: {{ $application->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
              <li>Height: {{ $application->getHeight() }} cm</li>
              <li>Weight: {{ $application->getWeight() }} Kg</li>
              <li>Country: {{ $application->getCountry()->getName() }}</li>
              <li>Contact: <a href="mailto:{{ $application->getEmail() }}">{{ $application->getEmail() }}</a></li>
              <li>Status: {{ $application->isQualified() ? 'Qualified' : 'Non-Qualified' }}</li>
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
    @endforeach
  </div>
  @foreach($applications as $application)
    <div class="modal fade" id="application-{{$application->getId()}}" tabindex="-1"
         aria-labelledby="application-{{$application->getId()}}-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $application->getFullName() }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="carousel-application-{{ $application->getId() }}" class="carousel slide mb-3"
                 data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach($application->getImages() as $key => $image)
                  <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    <img src="{{ url('storage/patients_images/' . $image->getFileName()) }}" class="d-block w-100"
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
            <h5 class="text-center">{{ $application->getFullName() }}</h5>
            <ul class="list-unstyled">
              <li>Age: {{ $application->getAge() }}</li>
              <li>Gender: {{ $application->getGender() === \App\Models\Patient::MALE_GENDER ? 'Male' : 'Female' }}</li>
              <li>Height: {{ $application->getHeight() }} cm</li>
              <li>Weight: {{ $application->getWeight() }} Kg</li>
              <li>Country: {{ $application->getCountry()->getName() }}</li>
              <li>Contact: <a href="mailto:{{ $application->getEmail() }}">{{ $application->getEmail() }}</a></li>
              <li>Status: {{ $application->isQualified() ? 'Qualified' : 'Non-Qualified' }}</li>
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
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@endsection