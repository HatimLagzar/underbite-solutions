<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title') | {{ env('APP_NAME') }}</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  {{-- App Styles --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@if(session()->has('error'))
  <div class="alert bg-danger text-white rounded-0">
    {{ session('error') }}
  </div>
@endif
<nav id="navbar-mobile" class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="/images/logo.png" alt="Logo" width="180"></a>
    <button class="navbar-toggler ms-auto d-inline-block" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a href="{{ route('pages.home') }}" class="nav-link">{{__('Home')}}</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.about') }}" class="nav-link">{{__('About Us')}}</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.faq') }}" class="nav-link">{{__('FAQ')}}</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.blog') }}" class="nav-link">{{__('Blog')}}</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.contact-us') }}" class="nav-link">{{__('Contact Us')}}</a>
        </li>
        <x-flags-menu />
      </ul>
    </div>
  </div>
</nav>

<header id="header">
  <div class="container border-bottom">
    <div class="d-flex justify-content-between align-items-center">
      <div class="logo-wrapper">
        <img src="/images/logo.png" alt="Logo" width="180">
      </div>

      <div class="languages-selector-wrapper ms-auto">
        <x-flags-menu />
      </div>
    </div>
  </div>

  <nav id="navbar" class="navbar navbar-expand-lg">
    <div class="container p-0">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a href="{{ route('pages.home') }}"
               class="nav-link {{ request()->route()->getName() === 'pages.home' ? 'active' : '' }}">{{__('Home')}}</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.about') }}"
               class="nav-link {{ request()->route()->getName() === 'pages.about' ? 'active' : '' }}">{{__('About Us')}}</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.faq') }}"
               class="nav-link {{ request()->route()->getName() === 'pages.faq' ? 'active' : '' }}">{{__('FAQ')}}</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.blog') }}"
               class="nav-link {{ request()->route()->getName() === 'pages.blog' ? 'active' : '' }}">{{__('Blog')}}</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.contact-us') }}"
               class="nav-link {{ request()->route()->getName() === 'pages.contact-us' ? 'active' : '' }}">{{__('Contact Us')}}</a>
          </li>
        </ul>

        <div class="languages-selector-wrapper-navbar ms-auto" style="display: none;">
          <x-flags-menu />
        </div>
      </div>
    </div>
  </nav>
</header>
@yield('content')
<footer id="footer">
  <section class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-12 p-0">
          <img class="footer-logo img-fluid" src="{{ asset('images/underbite.jpeg') }}" alt="Logo">
        </div>
        <div class="col-lg-4 col-sm-6 col-12 d-flex py-5">
          <div class="d-flex flex-column align-items-center justify-content-center">
            <em class="text-center">{{__('We are here to insure you receive all necessary services for the treatment of your')}}</em>
            <a href="/#form-wrapper" class="btn btn-primary text-white py-2 px-4 mt-3 mx-auto btn-sm">{{__('Apply Here')}}</a>
          </div>
        </div>
        <div class="col-lg-2 col-12 py-5">
          <h4>Denti<span class="text-pink">Care</span></h4>
          <div class="separator"></div>
          <ul>
            <li><a href="#">{{__('Our Dental Team')}}</a></li>
            <li><a href="#">{{__('Pricing & Pricelist')}}</a></li>
            <li><a href="#">{{__('Our Solutions')}}</a></li>
            <li><a href="#">{{__('Our Dental Services')}}</a></li>
            <li><a href="#">{{__('Clients')}}</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-12 py-5 pe-5 social-networks-col">
          <h4>{{__('Social Networks')}}</h4>
          <div class="separator"></div>
          <p>{{__('Visit DentiCare on these social links and connect with us. Make sure you follow use on our accounts for regular updates.')}}</p>
          <ul>
            <li class="d-inline-block">
              <a href="#">
                <img src="/images/icons/facebook.png" alt="Facebook">
              </a>
            </li>
            <li class="d-inline-block">
              <a href="#">
                <img src="/images/icons/twitter.png" alt="twitter">
              </a>
            </li>
            <li class="d-inline-block">
              <a href="#">
                <img src="/images/icons/linkedin.png" alt="LinkedIn">
              </a>
            </li>
            <li class="d-inline-block">
              <a href="#">
                <img src="/images/icons/pinterest.png" alt="Pinterest">
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="copyright">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 mb-lg-0 mb-3">
          <p>{{__('All rights reserved')}} &copy; {{ date('Y') }}</p>
        </div>
        <div class="col-12 col-md-6">
          <ul class="list-unstyled mb-0">
            <li>
              <a href="{{ route('pages.accessibility') }}">{{__('Accessibility')}}</a>
            </li>
            <li>
              <a href="{{ route('pages.disclaimer') }}">{{__('Disclaimer')}}</a>
            </li>
            <li>
              <a href="{{ route('pages.terms') }}">{{__('Terms and Conditions')}}</a>
            </li>
            <li>
              <a href="{{ route('pages.privacy-policy') }}">{{__('Privacy Policy')}}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>