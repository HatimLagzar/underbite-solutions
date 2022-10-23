<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', config('app.name', 'Laravel'))</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin-wrapper">
  <div class="nav-wrapper">
    <nav id="navbar">
      <a class="navbar-brand" href="{{ route('admin.home') }}">Admin Panel</a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('admin.home') }}"><i class="fa fa-home me-2 fs-5"></i>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('admin.applications.index') }}"><i class="fa fa-users me-2 fs-5"></i>Applications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('admin.home') }}"><i class="fa fa-bell me-2 fs-5"></i>Notifications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('admin.posts.index') }}"><i class="fa fa-edit me-2 fs-5"></i>Blog</a>
        </li>
      </ul>
    </nav>
  </div>

  <div class="container py-5">
    @if (session('success'))
      <div class="alert alert-success mb-5" role="alert">
        {{ session('success') }}
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger mb-5" role="alert">
        {{ session('error') }}
      </div>
    @endif

    @yield('content')
  </div>
</div>

@yield('scripts')

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>