@extends('admin.layout.noauth-template')
@section('content')
  <div class="container w-25 mt-5">
    <h1>Please Login</h1>
    <form method="POST" action="{{ route('admin.authenticate') }}">
      @csrf
      <div class="form-group mb-3">
        <label for="emailInput" class="form-label">Email Address</label>
        <input id="emailInput" name="email" type="email" class="form-control" required>
      </div>

      <div class="form-group mb-3">
        <label for="passwordInput" class="form-label">Password</label>
        <input id="passwordInput" name="password" type="password" class="form-control" required>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>
@endsection