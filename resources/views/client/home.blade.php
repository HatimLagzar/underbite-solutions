@extends('client.layout.app')
@section('title')
  Home
@endsection
@section('content')
  <section id="hero">
    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel"
         data-bs-config='{"interval":3500}'>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="/images/hero.jpeg" class="d-block" alt="Slide 2">
        </div>
        <div class="carousel-item">
          <img src="/images/about_us.jpeg" class="d-block" alt="Slide 2">
        </div>
        <div class="carousel-item">
          <img src="/images/img-service.jpeg" class="d-block" alt="Slide 3">
        </div>
      </div>
    </div>
    <div class="container">
      <h1>{{ __('Care for your smile') }}</h1>
      <div class="col-lg-5 col-12">
        <p>{{ __('Your smile is one of the important things for your and we care about this, that’s why we gathered to help you fix this problem and make your life easier.') }}</p>
        <a href="/#form-wrapper" class="btn btn-primary rounded-5 apply">{{ __('Apply & Meet Us') }}</a>
      </div>
    </div>
  </section>

  <section id="form-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-12">
          <div class="d-flex flex-column justify-content-between">
            <h2 class="title text-center">{{ __('Fully sponsored by us') }}</h2>
            <p class="text-center">{{ __('For all nationalities and countries') }}</p>
            <div class="circle-wrapper">
              <div id="circle">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                  <defs>
                    <linearGradient id="circleGradient" gradientTransform="rotate(90)">
                      <stop offset="0%" stop-color="white"/>
                      <stop offset="50%" stop-color="#ffffff40"/>
                      <stop offset="100%" stop-color="white"/>
                    </linearGradient>
                  </defs>
                  <circle cx="50" cy="50" r="49" fill="none" stroke="url(#circleGradient)" stroke-width="0.3"
                          stroke-dasharray="2 1.5"/>
                </svg>
                <p id="free-of-charges"
                   class="text-center position-absolute top-50">{!! __('100% <br> free of charges') !!}</p>
                <div class="top">
                  <div class="left">
                    <span class="">{{__('Follow-ups')}}</span>
                    <i class="fa fa-calendar-check-o"></i>
                  </div>
                  <div class="center">
                    <span class="d-block">{{__('Medication')}}</span>
                    <i class="fa fa-medkit text-center d-block"></i>
                  </div>
                  <div class="right travel-area">
                    <i class="fa fa-plane"></i>
                    <div class="travel-text lh-1">
                      <span class="d-md-block text-start">{{__('Travel')}}</span>
                      <span class="text-start lh-sm w-75 d-block"
                            style="font-size: 10px">{{ __('Flights, Hotel, food and medical visa') }}</span>
                    </div>
                  </div>
                </div>
                <div class="bottom">
                  <div class="left">
                    <span class="">{{__('Surgery')}}</span>
                    <i class="fa fa-medkit"></i>
                  </div>
                  <div class="center">
                    <img src="{{ asset('images/icons/braces.svg') }}" alt="braces">
                    <span class="mt-1">{{__('Braces')}}</span>
                  </div>
                  <div class="right">
                    <i class="fa fa-heart"></i>
                    <span class="">{{__('Consultation')}}</span>
                  </div>
                </div>
              </div>
            </div>
            <p class="fs-3 text-center mt-2 mb-2">{{__('No Insurance Required')}}</p>
            <p class="text-center mb-0">{{__('for 95% of cases')}}</p>
          </div>
        </div>
        <div class="col-lg-1 d-lg-block d-none"></div>
        <div class="col-lg-6 col-12 apply-col" style="margin-top: -200px;">
          <div id="apply-now" class="apply-wrapper">
            <form method="POST" action="#">
              <h4 class="text-pink mb-0">{{ __('Book your visit at') }}</h4>
              <h3 class="text-blue border-bottom">{{ __('Denistry Care') }}</h3>
              <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="firstNameInput">First Name <small class="text-muted" style="font-size: 12px;">(Required)</small></label>
                  <input id="firstNameInput" type="text" class="form-control" name="first_name" required>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="lastNameInput">Last Name <small class="text-muted" style="font-size: 12px;">(Required)</small></label>
                  <input id="lastNameInput" type="text" class="form-control" name="last_name" required>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="genderInput">Your Gender <small class="text-muted" style="font-size: 12px;">(Required)</small></label>
                  <select id="genderInput" class="form-select" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                  </select>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="ageInput">Your Age <small class="text-muted" style="font-size: 12px;">(Required)</small></label>
                  <select onfocus='this.size=5;'
                          onblur='this.size=5;'
                          onfocusout='this.size=null;'
                          onchange='this.size=5; this.blur();'
                          id="ageInput" type="text" class="form-select"
                          name="age"
                          required>
                    <option value="">Select Age</option>
                    @for($i = 16; $i <= 50; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="heightInput">Your Height <small class="text-muted" style="font-size: 12px;">(Required)</small></label>
                  <select onfocus='this.size=5;'
                          onblur='this.size=5;'
                          onfocusout='this.size=null;'
                          onchange='this.size=5; this.blur();'
                          id="heightInput"
                          type="text"
                          class="form-select"
                          required
                          name="height">
                    <option value="">Select Height</option>
                    @if($countryCode && in_array($countryCode, ['US', 'LR', 'MM']))
                      @for($i = 120; $i <= 210; $i++)
                        <option value="{{ $i }}">{{ turnCentimeterToFoot($i) }}" ft</option>
                      @endfor
                    @else
                      @for($i = 120; $i <= 210; $i++)
                        <option value="{{ $i }}">{{ $i }} cm</option>
                      @endfor
                    @endif
                  </select>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="weightInput">Your Weight <small class="text-muted" style="font-size: 12px;">(Required)</small></label>
                  <select onfocus='this.size=5;'
                          onblur='this.size=5;'
                          onfocusout='this.size=null;'
                          onchange='this.size=5; this.blur();'
                          id="weightInput"
                          type="text"
                          required
                          class="form-select"
                          name="weight">
                    <option value="">Select Weight</option>
                    @if($countryCode && in_array($countryCode, ['US', 'LR', 'MM']))
                      @for($i = 30; $i <= 130; $i++)
                        <option value="{{ $i }}">{{ turnKilogramToLbs($i) }} pound</option>
                      @endfor
                    @else
                      @for($i = 30; $i <= 130; $i++)
                        <option value="{{ $i }}">{{ $i }} Kg</option>
                      @endfor
                    @endif
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="emailInput">Your Email <small class="text-muted" style="font-size: 12px;">(Required)</small></label>
                  <input id="emailInput" type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="countryInput">Your Origin/Country <small class="text-muted" style="font-size: 12px;">(Required)</small></label>
                  <select onfocus='this.size=5;'
                          onblur='this.size=5;'
                          onfocusout='this.size=null;'
                          onchange='this.size=5; this.blur();'
                          id="countryInput" type="text" class="form-select" name="country" required>
                    <option value="">Select Country</option>
                    @foreach(\App\Models\Country::all() as $country)
                      <option value="{{ $country->getCode() }}">{{ $country->getName() }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="phoneInput">Phone Number <small class="text-muted" style="font-size: 12px;">(Required)</small></label>
                  <input id="phoneInput" type="tel" class="form-control" name="phone_number" required>
                </div>

                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="socialNetworkInput">Facebook / Instagram <span class="text-muted"
                                                                                                style="font-size: 12px">(Optional)</span></label>
                  <input id="socialNetworkInput" type="url" class="form-control" name="social_network_note">
                </div>
              </div>


              <h4 class="text-center mb-0 mt-4">{{__('Upload photos of your underbite')}}</h4>
              <p class="text-danger text-center">{{ __('Please make sure your teeth are fully visible in all photos') }}</p>

              <div class="row uploads">
                <div class="col-6 col-sm-3">
                  <input type="file" name="front_side" id="frontSideInput" class="visually-hidden" accept="image/*" required>
                  <label for="frontSideInput" class="position-relative w-100 d-block d-sm-none">
                    <img class="d-block mx-auto" src="/images/icons/front.svg" data-src="/images/icons/front.svg" alt="Front View">
                    <span class="bg-white add-icon-wrapper">
                      <i class="fa fa-plus"></i>
                    </span>
                  </label>
                  <div class="dropdown d-sm-block d-none" data-target="frontSideInput">
                    <button class="p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img class="d-block mx-auto" src="/images/icons/front.svg" data-src="/images/icons/front.svg" alt="Front View">
                      <span class="bg-white add-icon-wrapper">
                        <i class="fa fa-plus"></i>
                      </span>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <label for="frontSideInput" class="dropdown-item position-relative w-100">
                          <i class="fa fa-upload me-1"></i>{{__('Upload')}}
                        </label>
                      </li>
                      <li>
                        <button type="button" class="dropdown-item request-take-picture-btn">
                          <i class="fa fa-camera me-1"></i>{{__('Take Picture')}}
                        </button>
                      </li>
                    </ul>
                  </div>
                  <p class="text-black text-center mt-1 mb-0">{{ __('Front View') }}</p>
                  <small class="text-muted text-danger text-center d-block mb-3">{{ __('(required)') }}</small>
                </div>
                <div class="col-6 col-sm-3">
                  <input type="file" name="right_side" id="rightSideInput" class="visually-hidden" accept="image/*" required>
                  <label for="rightSideInput" class="position-relative w-100 d-block d-sm-none">
                    <img class="d-block mx-auto" src="/images/icons/right.svg" data-src="/images/icons/right.svg" alt="Right View">
                    <span class="bg-white add-icon-wrapper">
                      <i class="fa fa-plus"></i>
                    </span>
                  </label>
                  <div class="dropdown d-sm-block d-none" data-target="rightSideInput">
                    <button class="p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img class="d-block mx-auto" src="/images/icons/right.svg" data-src="/images/icons/right.svg" alt="Right View">
                      <span class="bg-white add-icon-wrapper">
                        <i class="fa fa-plus"></i>
                      </span>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <label for="rightSideInput" class="dropdown-item position-relative w-100">
                          <i class="fa fa-upload me-1"></i>{{__('Upload')}}
                        </label>
                      </li>
                      <li>
                        <button type="button" class="dropdown-item request-take-picture-btn">
                          <i class="fa fa-camera me-1"></i>{{__('Take Picture')}}
                        </button>
                      </li>
                    </ul>
                  </div>
                  <p class="text-black text-center mt-1 mb-0">{{ __('Right Side') }}</p>
                  <small class="text-muted text-danger text-center d-block mb-3">{{ __('(required)') }}</small>
                </div>
                <div class="col-6 col-sm-3">
                  <input type="file" name="right_closed" id="rightClosedSideInput" class="visually-hidden" accept="image/*" required>
                  <label for="rightClosedSideInput" class="position-relative w-100 d-block d-sm-none">
                    <img class="d-block mx-auto" src="/images/icons/right-closed.svg" data-src="/images/icons/right-closed.svg" alt="Right Closed">
                    <span class="bg-white add-icon-wrapper">
                      <i class="fa fa-plus"></i>
                    </span>
                  </label>
                  <div class="dropdown d-sm-block d-none" data-target="rightClosedSideInput">
                    <button class="p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img class="d-block mx-auto" src="/images/icons/right-closed.svg" data-src="/images/icons/right-closed.svg" alt="Right Closed">
                      <span class="bg-white add-icon-wrapper">
                        <i class="fa fa-plus"></i>
                      </span>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <label for="rightClosedSideInput" class="dropdown-item position-relative w-100">
                          <i class="fa fa-upload me-1"></i>{{__('Upload')}}
                        </label>
                      </li>
                      <li>
                        <button type="button" class="dropdown-item request-take-picture-btn">
                          <i class="fa fa-camera me-1"></i>{{__('Take Picture')}}
                        </button>
                      </li>
                    </ul>
                  </div>
                  <p class="text-black text-center mt-1 mb-0">{{ __('Right Closed') }}</p>
                  <small class="text-muted text-danger text-center d-block mb-3">{{ __('(required)') }}</small>
                </div>
                <div class="col-6 col-sm-3">
                  <input type="file" name="front_closed" id="frontClosedInput" class="visually-hidden" accept="image/*" required>
                  <label for="frontClosedInput" class="position-relative w-100 d-block d-sm-none">
                    <img class="d-block mx-auto" src="/images/icons/front-closed.svg" data-src="/images/icons/front-closed.svg" alt="Perspective View">
                    <span class="bg-white add-icon-wrapper">
                      <i class="fa fa-plus"></i>
                    </span>
                  </label>
                  <div class="dropdown d-sm-block d-none" data-target="frontClosedInput">
                    <button class="p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img class="d-block mx-auto" src="/images/icons/front-closed.svg" data-src="/images/icons/front-closed.svg" alt="Perspective View">
                      <span class="bg-white add-icon-wrapper">
                        <i class="fa fa-plus"></i>
                      </span>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <label for="frontClosedInput" class="dropdown-item position-relative w-100">
                          <i class="fa fa-upload me-1"></i>{{__('Upload')}}
                        </label>
                      </li>
                      <li>
                        <button type="button" class="dropdown-item request-take-picture-btn">
                          <i class="fa fa-camera me-1"></i>{{__('Take Picture')}}
                        </button>
                      </li>
                    </ul>
                  </div>
                  <p class="text-black text-center mt-1 mb-0">{{ __('Front Closed') }}</p>
                  <small class="text-muted text-danger text-center d-block mb-3">{{ __('(required)') }}</small>
                </div>
              </div>

              <p class="text-sm text-black text-center">{{ __('Note: By sharing your information with us, you are agreeing to give us permissions to review your information, All content will remain highly confidential.') }}</p>

              <p id="error-feedback" class="text-danger text-center mb-1"></p>
              <p id="success-feedback" class="text-center text-success mb-1"></p>

              <button type="submit" class="btn btn-primary rounded-5 mx-auto d-block">Apply</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="specialized-team">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-sm-6">
          <h2 class="text-center text-blue">{{__('Specialized Team')}}</h2>
          <div class="separator"></div>
          <p class="quote">
            "{{__('We are a team or dentists, hygienists and receptionists who work togetner to ensure that you receive the best treatment that you require at a very time that suits you.')}}
            "</p>
          <img class="mx-auto d-block" src="/images/img-signature.png" alt="Signature">
        </div>
        <div class="col-1 d-none d-sm-block"></div>
        <div class="col-12 col-sm-5 mt-5">
          <figure>
            <img class="w-100" src="/images/img-service.jpeg" alt="Image Service">
            <figcaption
                class="text-center text-pink fs-5 mt-2">{!! __('Class 3 malocclusion<br><small class="text-sm">(Underbite or double jaw)</small>') !!}</figcaption>
          </figure>
        </div>
      </div>
    </div>
  </section>

  <section id="international-program">
    <div class="separator-line"></div>
    <h2 class="text-center">{{__('International Program')}}</h2>
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6">
          <h4 class="text-center">{{__('Countries from all countries accepted')}}</h4>
          <img class="mx-auto d-block mt-2 mb-4" src="/images/world.png" alt="World Map">
          <p class="text-center">{{__('Or, we will fund your treatment with a local orthodontist if you are unable to travel')}}</p>
        </div>
        <div class="col-12 col-lg-6">
          <h4 class="text-center">{{__('Countries We Operate In')}}</h4>
          <p class="text-center">{{ __('Get the chance of visit your favorite country and get the treatment you need.') }}</p>
          <ul>
            <li><img src="/images/flags/usa.png" alt="USA"></li>
            <li><img src="/images/flags/united-kingdom.png" alt="UK"></li>
            <li><img src="/images/flags/united-arab-emirates.png" alt="UAE"></li>
            <li><img src="/images/flags/germany.png" alt="germany"></li>
          </ul>
          <ul>
            <li><img src="/images/flags/brazil.png" alt="brazil"></li>
            <li><img src="/images/flags/japan.png" alt="japan"></li>
            <li><img src="/images/flags/south-korea.png" alt="south korea"></li>
            <li><img src="/images/flags/russia.png" alt="russia"></li>
          </ul>
          <p class="text-center">{{__('Or, we will fund your treatment with a local orthodontist if you are unable to travel')}}</p>
        </div>
      </div>
    </div>
  </section>

  <section id="our-dental-service">
    <h3 class="text-center text-pink fw-light mb-1">{{__('Our Dental Service')}}</h3>
    <h2 class="text-center fw-semibold">{{__('Professionals')}}</h2>
    <p class="text-center text-muted w-50 mx-auto mb-5">{{ __('Distinctively exploit optimal alignments for intuitive bandwidth. Quickly coordinate e-business applications through  revolutionary catalysts for change. Seamlessly underwhelm optimal testing processes. ') }}</p>

    <div class="container">
      <div class="row px-lg-5">
        <div class="col-lg-3 col-6 mb-3">
          <div class="item">
            <svg class="progress-bar-svg" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="44" fill="none" stroke="#eee" stroke-width="3"/>
              <circle class="percent p-95" cx="50" cy="50" r="44" fill="none" stroke="#0E54AE" stroke-width="3"
                      pathLength="100"/>
            </svg>
            <div class="content">
              <img src="/images/icons/thumbs-up.png" alt="Thumbs up">
            </div>
          </div>
          <p class="fw-bold text-center fs-4 mb-0">95%</p>
          <p class="fw-semibold text-center">{{__('Patient Satisfaction')}}</p>
        </div>
        <div class="col-lg-3 col-6 mb-3">
          <div class="item">
            <svg class="progress-bar-svg" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="44" fill="none" stroke="#eee" stroke-width="3"/>
              <circle class="percent p-97" cx="50" cy="50" r="44" fill="none" stroke="#0E54AE" stroke-width="3"
                      pathLength="100"/>
            </svg>
            <div class="content">
              <img src="/images/icons/check-up.png" alt="Check Up">
            </div>
          </div>
          <p class="fw-bold text-center fs-4 mb-0">97%</p>
          <p class="fw-semibold text-center">{{__('Dental Success')}}</p>
        </div>
        <div class="col-lg-3 col-6 mb-3 d-flex flex-column justify-content-end">
          <div class="item">
            <svg class="progress-bar-svg" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="44" fill="none" stroke="#eee" stroke-width="3"/>
              <circle class="percent p-100" cx="50" cy="50" r="44" fill="none" stroke="#0E54AE" stroke-width="3"
                      pathLength="100"/>
            </svg>
            <div class="content">
              <img src="/images/icons/plane.png" alt="Plane">
            </div>
          </div>
          <p class="fw-bold text-center fs-4 mb-0">100%</p>
          <p class="fw-semibold text-center">{{__('Travel Satisfaction')}}</p>
        </div>
        <div class="col-lg-3 col-6 mb-3">
          <div class="item">
            <svg class="progress-bar-svg" viewBox="0 0 100 100">
              <circle cx="50" cy="50" r="44" fill="none" stroke="#eee" stroke-width="3"/>
              <circle class="percent p-96" cx="50" cy="50" r="44" fill="none" stroke="#0E54AE" stroke-width="3"
                      pathLength="100"/>
            </svg>
            <div class="content">
              <img src="/images/icons/recovery.png" alt="Recovery">
            </div>
          </div>
          <p class="fw-bold text-center fs-4 mb-0">96%</p>
          <p class="fw-semibold text-center">{{__('Quick Recovery')}}</p>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="previewSnapshotModal" tabindex="-1" aria-labelledby="previewSnapshotModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 700px;">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="previewSnapshotModalLabel">Take a Photo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <video id="webcam-live" class="mx-w-full" autoplay playsinline style="display: block; margin: 0 auto 25px;"></video>
          <canvas id="picture-canvas" class="d-none"></canvas>
          <button id="take-picture" class="btn btn-primary mx-auto d-block"><i class="fa fa-camera me-1"></i>{{__('Take Picture')}}</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script src="{{ asset('js/pages/home.js') }}"></script>
@endpush