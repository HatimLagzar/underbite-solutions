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
          <a href="{{ route('pages.home') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.about') }}" class="nav-link">About Us</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.faq') }}" class="nav-link">FAQ</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.blog') }}" class="nav-link">Blog</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.contact-us') }}" class="nav-link">Contact Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            English
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Arabic</a></li>
            <li><a class="dropdown-item" href="#">Francais</a></li>
            <li><a class="dropdown-item" href="#">Deutsch</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<header id="header">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div class="logo-wrapper">
        <img src="/images/logo.png" alt="Logo" width="180">
      </div>
      <div class="languages-selector-wrapper ms-auto">
        <div class="dropdown">
          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img width="20" src="/images/flags-languages/en.svg" alt="English"> English
          </button>
          <ul class="dropdown-menu" aria-labelledby="flags-dropdown" id="flags-dowpdown-list">
            <li><a class="dropdown-item" href="#"><img src="/images/flags-languages/en.svg" alt="English">English</a></li>
            <li><a class="dropdown-item" href="#"><img src="/images/flags-languages/fr.svg" alt="French">French</a></li>
            <li><a class="dropdown-item" href="#"><img src="/images/flags-languages/es.svg" alt="Spanish">Spanish</a></li>
            <li><a class="dropdown-item" href="#"><img src="/images/flags-languages/it.svg" alt="Italian">Italian</a></li>
            <li><a class="dropdown-item" href="#"><img src="/images/flags-languages/de.svg" alt="Deutsch">Deutsch</a></li>
          </ul>
        </div>
      </div>
    </div>

    <nav id="navbar" class="navbar navbar-expand-lg">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a href="{{ route('pages.home') }}" class="nav-link {{ request()->route()->getName() === 'pages.home' ? 'active' : '' }}">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.about') }}" class="nav-link {{ request()->route()->getName() === 'pages.about' ? 'active' : '' }}">About Us</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.faq') }}" class="nav-link {{ request()->route()->getName() === 'pages.faq' ? 'active' : '' }}">FAQ</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.blog') }}" class="nav-link {{ request()->route()->getName() === 'pages.blog' ? 'active' : '' }}">Blog</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.contact-us') }}" class="nav-link {{ request()->route()->getName() === 'pages.contact-us' ? 'active' : '' }}">Contact Us</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>
@yield('content')
<footer id="footer">
  <section class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-12 mb-5">
          <h4>Denti<span class="text-pink">Care</span></h4>
          <div class="separator"></div>
          <p>{{ __('A team of dentists working ot ensure you receive the best treatment.') }}</p>
          <ul>
            <li><i class="fa fa-phone"></i> <a href="tel:+1(415)-205-5550">+1(415)-205-5550</a></li>
            <li><i class="fa fa-envelope"></i> <a href="mailto:denticare@contact.com">denticare@contact.com</a></li>
            <li><i class="fa fa-globe"></i> <a href="https://www.denticare.com">https://www.denticare.com</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-12 mb-5">
          <h4>{{__('About')}}</h4>
          <div class="separator"></div>
          <ul>
            <li><a href="#">{{__('Our Dental Team')}}</a></li>
            <li><a href="#">{{__('Pricing & Pricelist')}}</a></li>
            <li><a href="#">{{__('Our Solutions')}}</a></li>
            <li><a href="#">{{__('Our Dental Services')}}</a></li>
            <li><a href="#">{{__('Clients')}}</a></li>
          </ul>
        </div>
        <div class="col social-networks-col">
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
      <p>All rights reserved &copy; {{ date('Y') }}</p>
    </div>
  </section>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>