@php
  /** @var $countries \App\Models\Country[] */
  /** @var $notification \App\Models\Notification[] */
@endphp
@extends('admin.layout.auth-template')
@section('title')
  Edit Notification
@endsection
@section('content')
  <section class="my-3">
    @foreach($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <h2>Edit Notification</h2>
    <form action="{{ route('admin.notifications.update', ['notification' => $notification]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group mb-3">
        <label for="nameInput" class="form-label">Name</label>
        <input id="nameInput"
               name="name"
               class="form-control"
               placeholder="Give this notification a name"
               value="{{ $notification->getName() }}"
               required>
      </div>

      <div class="form-group mb-3">
        <label class="form-label" for="ageInput">Age</label>
        <div class="row">
          <div class="col-6">
            <input id="ageInput" name="min_age" type="number" min="1" max="150"
                   class="form-control"
                   placeholder="Minimum"
                   value="{{ old('min_age') ?: $notification->getMinAge() }}">
          </div>
          <div class="col-6">
            <input id="ageMaxInput" name="max_age" type="number" min="1" max="150"
                   class="form-control"
                   placeholder="Maximum"
                   value="{{ old('max_age') ?: $notification->getMaxAge() }}">
          </div>
        </div>
      </div>

      <div class="form-group mb-3">
        <label class="form-label" for="heightInput">Height (Cm)</label>
        <div class="row">
          <div class="col-6">
            <input id="heightInput" name="min_height" type="number" min="0" max="250"
                   class="form-control"
                   placeholder="Minimum"
                   value="{{ old('min_height') ?: $notification->getMinHeight() }}">
          </div>
          <div class="col-6">
            <input id="heightMaxInput" name="max_height" type="number" min="0" max="250"
                   class="form-control"
                   placeholder="Maximum"
                   value="{{ old('max_height') ?: $notification->getMaxHeight() }}">
          </div>
        </div>
      </div>

      <div class="form-group mb-3">
        <label class="form-label" for="weightInput">Weight (Kg)</label>
        <div class="row">
          <div class="col-6">
            <input id="weightInput" name="min_weight" type="number" min="0" max="300"
                   class="form-control"
                   placeholder="Minimum"
                   value="{{ old('min_weight') ?: $notification->getMinWeight() }}">
          </div>
          <div class="col-6">
            <input id="weightMaxInput" name="max_weight" type="number" min="0" max="300"
                   class="form-control"
                   placeholder="Maximum"
                   value="{{ old('max_weight') ?: $notification->getMaxWeight() }}">
          </div>
        </div>
      </div>

      <div class="form-group mb-3">
        <label for="genderInput" class="form-label">Gender</label>
        <select name="gender" id="genderInput" class="form-select">
          <option value>All</option>
          <option value="1" {{ old('gender') === '1' || intval($notification->getGender()) === 1 ? 'selected' : '' }}>Male</option>
          <option value="2" {{ old('gender') === '2' || intval($notification->getGender()) === 2 ? 'selected' : '' }}>Female</option>
        </select>
      </div>

      <div class="form-group mb-3">
        <label for="country">Country</label>
        <select name="country[]" id="country" class="form-select" multiple>
          <option value>All</option>
          @foreach(\App\Models\Country::all() as $country)
            <option
                value="{{ $country->getCode() }}" {{ in_array($country->getCode(), $notification->getCountryCodeArr()) ? 'selected' : '' }}>{{ $country->getName() }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group mb-3">
        <label for="continent">Continent</label>
        <select name="continent" id="continent" class="form-select">
          <option value>All</option>
          @foreach(\App\Models\Continent::all() as $continent)
            <option value="{{ $continent->getCode() }}" {{ $notification->getContinentCode() === $continent->getCode() ? 'selected' : '' }}>{{ $continent->getName() }}</option>
          @endforeach
        </select>
      </div>

      <button class="btn btn-primary"><i class="fa fa-paper-plane me-1"></i>Update</button>
      <button type="reset" class="btn btn-secondary"><i class="fa fa-eraser me-1"></i>Clear</button>
    </form>
  </section>
@endsection