@extends('admin.layout.auth-template')

@section('title')
  Settings
@endsection

@section('content')
  @foreach($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
  @endforeach

  <h1>Settings</h1>
  <form method="POST" action="{{ route('admin.update-settings') }}">
    @csrf
    <div class="form-group mb-3">
      <label class="form-label" for="firstNameInput">Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="firstNameInput"
             value="{{ $user->getName() }}">
      <div class="invalid-feedback">
        @error('name')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="form-group mb-3">
      <label class="form-label" for="currentPasswordInput">Current Password</label>
      <input type="password" class="form-control @error('current_password') is-invalid @enderror"
             name="current_password" id="currentPasswordInput">
      <div class="invalid-feedback">
        @error('current_password')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="form-group mb-3">
      <label class="form-label" for="passwordInput">New Password</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
             id="passwordInput">
      <div class="invalid-feedback">
        @error('password')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="form-group mb-3">
      <label class="form-label" for="newPasswordInput">Password Confirmation</label>
      <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
             name="password_confirmation" id="newPasswordInput">
      <div class="invalid-feedback">
        @error('password_confirmation')
        {{ $message }}
        @enderror
      </div>
    </div>

    <button class="btn btn-primary">Validate</button>
  </form>
@endsection