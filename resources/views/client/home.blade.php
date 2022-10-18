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
        <div class="col-lg-6 col-12">
          <h2 class="text-center">{{ __('Fully sponsored by us') }}</h2>
          <p class="text-center">{{ __('For all nationalities and countries') }}</p>
          <div class="circle-wrapper">
            <div id="circle">
              <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="49" fill="none" stroke="white" stroke-width="1" stroke-dasharray="10 10"/>
              </svg>
              <p id="free-of-charges" class="text-center position-absolute top-50">{{ __('100% free of charges') }}</p>
              <div class="top">
                <div class="left">
                  <span class="">{{__('Follow-ups')}}</span>
                  <i class="fa fa-calendar-check-o"></i>
                </div>
                <div class="center">
                  <span class="d-block">{{__('Medication')}}</span>
                  <i class="fa fa-medkit text-center d-block"></i>
                </div>
                <div class="right">
                  <i class="fa fa-plane"></i>
                  <div class="text">
                    <span class="d-block">{{__('Travel')}}</span>
                    <span style="font-size: 10px">{{ __('Flights, Hotel, food and medical visa') }}</span>
                  </div>
                </div>
              </div>
              <div class="bottom">
                <div class="left">
                  <span class="">{{__('Surgery')}}</span>
                  <i class="fa fa-medkit"></i>
                </div>
                <div class="center">
                  <span class="">{{__('Braces')}}</span>
                  <img src="{{ asset('images/icons/braces.svg') }}" alt="braces">
                </div>
                <div class="right">
                  <i class="fa fa-heart"></i>
                  <span class="">{{__('Consultation')}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12 apply-col" style="margin-top: -200px;">
          <div id="apply-now" class="apply-wrapper">
            <form method="POST" action="#">
              <h3 class="d-inline text-pink me-1">{{ __('Book your visit at') }}</h3>
              <h3 class="d-inline text-blue">{{ __('Denistry Care') }}</h3>
              <div class="row mt-3">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="firstNameInput">First Name</label>
                  <input id="firstNameInput" type="text" class="form-control" name="first_name">
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="lastNameInput">Last Name</label>
                  <input id="lastNameInput" type="text" class="form-control" name="last_name">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="genderInput">Your Gender</label>
                  <select id="genderInput" class="form-select" name="gender">
                    <option value="">Select Age</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                  </select>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="ageInput">Your Age</label>
                  <select onfocus='this.size=5;'
                          onblur='this.size=5;'
                          onfocusout='this.size=null;'
                          onchange='this.size=5; this.blur();'
                          id="ageInput" type="text" class="form-select" name="age">
                    <option value="">Select Age</option>
                    @for($i = 16; $i <= 50; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="heightInput">Your Height</label>
                  <select onfocus='this.size=5;'
                          onblur='this.size=5;'
                          onfocusout='this.size=null;'
                          onchange='this.size=5; this.blur();'
                          id="heightInput"
                          type="text"
                          class="form-select"
                          name="height">
                    <option value="">Select Height</option>
                    @for($i = 150; $i <= 200; $i++)
                      <option value="{{ $i }}">{{ $i }} cm ({{ turnCentimeterToFoot($i) }} ft)</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="weightInput">Your Weight</label>
                  <select onfocus='this.size=5;'
                          onblur='this.size=5;'
                          onfocusout='this.size=null;'
                          onchange='this.size=5; this.blur();'
                          id="weightInput"
                          type="text"
                          class="form-select"
                          name="weight">
                    <option value="">Select Weight</option>
                    @for($i = 40; $i <= 200; $i++)
                      <option value="{{ $i }}">{{ $i }} Kg ({{ turnKilogramToLbs($i) }} lbs)</option>
                    @endfor
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="emailInput">Your Email</label>
                  <input id="emailInput" type="text" class="form-control" name="email">
                </div>
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="countryInput">Your Origin/Country</label>
                  <select onfocus='this.size=5;'
                          onblur='this.size=5;'
                          onfocusout='this.size=null;'
                          onchange='this.size=5; this.blur();'
                          id="countryInput" type="text" class="form-select" name="country">
                    <option value="">Select Country</option>
                    @foreach(\App\Models\Country::all() as $country)
                      <option value="{{ $country->getId() }}">{{ $country->getNiceName() }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="phoneInput">Phone Number <span class="text-muted"
                                                                                style="font-size: 12px">(Whatsapp Preferred)</span></label>
                  <input id="phoneInput" type="tel" class="form-control" name="phone_number">
                </div>

                <div class="form-group col-12 col-lg-6 mb-3">
                  <label class="form-label" for="socialNetworkInput">Facebook / Instagram <span class="text-muted"
                                                                                                style="font-size: 12px">(Optional)</span></label>
                  <input id="socialNetworkInput" type="text" class="form-control" name="social_network_note">
                </div>
              </div>


              <h4 class="text-center mb-0 mt-4">{{__('Upload photos of your underbite')}}</h4>
              <p class="text-danger text-center">{{ __('Please make sure your teeth are fully visible in all photos') }}</p>

              <div class="row uploads">
                <div class="col">
                  <input type="file" name="front_side" id="frontSideInput" class="d-none" accept="image/*" required>
                  <label for="frontSideInput" class="position-relative w-100">
                    <img class="d-block mx-auto" src="/images/icons/front.png" alt="Front View">
                    <span class="bg-white add-icon-wrapper">
                      <i class="fa fa-plus"></i>
                    </span>
                  </label>
                  <p class="text-black text-center mt-1">{{ __('Front View') }}</p>
                </div>
                <div class="col">
                  <input type="file" name="left_side" id="leftSideInput" class="d-none" accept="image/*" required>
                  <label for="leftSideInput" class="position-relative w-100">
                    <img class="d-block mx-auto" src="/images/icons/left.png" alt="Left View">
                    <span class="bg-white add-icon-wrapper">
                      <i class="fa fa-plus"></i>
                    </span>
                  </label>
                  <p class="text-black text-center mt-1">{{ __('Left View') }}</p>
                </div>
                <div class="col">
                  <input type="file" name="right_side" id="rightSideInput" class="d-none" accept="image/*" required>
                  <label for="rightSideInput" class="position-relative w-100">
                    <img class="d-block mx-auto" src="/images/icons/right.png" alt="Right View">
                    <span class="bg-white add-icon-wrapper">
                      <i class="fa fa-plus"></i>
                    </span>
                  </label>
                  <p class="text-black text-center mt-1">{{ __('Right View') }}</p>
                </div>
                <div class="col">
                  <input type="file" name="front_side" id="bigSmileInput" class="d-none" accept="image/*">
                  <label for="bigSmileInput" class="position-relative w-100">
                    <img class="d-block mx-auto" src="/images/icons/big-smile.png" alt="Big smile">
                    <span class="bg-white add-icon-wrapper">
                      <i class="fa fa-plus"></i>
                    </span>
                  </label>
                  <p class="text-black text-center mt-1">{{ __('Big Smile!') }}</p>
                </div>
              </div>

              <p class="text-sm text-black text-center">{{ __('Note: By sharing your information with us, you are agreeing to give us permissions to review your information, All content will remain highly confidential.') }}</p>

              <button class="btn btn-primary rounded-5 mx-auto d-block">Apply</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="specialized-team">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="bg-white pt-4 pt-md-0" style="background: #fff !important;">
            <div class="row justify-content-center">
              <div class="col-md-6 col-sm-12 col-12 py-md-5">
                <div class="section-title text-center" style="visibility: visible; animation-name: fadeInDown;">
                  <h6>Denistry Care</h6>
                  <h3>Specialized Team</h3>
                </div>
                <div class="specialized-description text-center wow  fadeInUp animated"
                     style="visibility: visible; animation-name: fadeInUp;">
                  <blockquote>
                    <p><i style="font-size:24px" class="fa"></i>&nbsp;&nbsp;We are a team of dentists,
                      hygienists and receptionists who work together to ensure that you receive the best treatment that
                      you require at a very time that suits you.&nbsp;&nbsp;<i style="font-size:24px" class="fa"></i>
                    </p>
                  </blockquote>
                  <img
                      src="/images/img-signature.png"
                      class="img-fluid">
                </div>
              </div>
              <div class="col-md-5 col-sm-12 col-12">
                <div class="ps-md-5 pt-md-5 pb -md-5 pr-md-5 p-2 p-2">
                  <div class="" style="postion:relative;border-radius:5px;overflow:hidden;">
                    <img src="/images/big-right-side.png"
                         class="img-fluid w-100 wow  zoomIn animated"
                         style="visibility: visible; animation-name: zoomIn;">
                  </div>
                  <h4 class="text-center mt-1 pb-4" style="font-size: 1.2rem;">Malocclusion class 3 <span
                        class="d-block">(Or Underbite)</span></h4></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="international-program">
    <h2 class="text-center">{{__('International Program')}}</h2>
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6">
          <h4 class="text-center">{{__('Countries from all countries accepted')}}</h4>
          <img class="mx-auto d-block mt-2 mb-4" src="/images/world.png" alt="World Map">
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
        <div class="col-lg-3 col-6">
          <img src="/images/icons/thumbs-up.png" alt="Thumbs up">
          <p class="fw-bold text-center fs-4 mb-0">95%</p>
          <p class="fw-semibold text-center">{{__('Patient Satisfaction')}}</p>
        </div>
        <div class="col-lg-3 col-6">
          <img src="/images/icons/check-up.png" alt="Check Up">
          <p class="fw-bold text-center fs-4 mb-0">97%</p>
          <p class="fw-semibold text-center">{{__('Dental Success')}}</p>
        </div>
        <div class="col-lg-3 col-6 d-flex flex-column justify-content-end">
          <img src="/images/icons/plane.png" alt="Plane">
          <p class="fw-bold text-center fs-4 mb-0">100%</p>
          <p class="fw-semibold text-center">{{__('Travel Satisfaction')}}</p>
        </div>
        <div class="col-lg-3 col-6">
          <img src="/images/icons/recovery.png" alt="Recovery">
          <p class="fw-bold text-center fs-4 mb-0">96%</p>
          <p class="fw-semibold text-center">{{__('Quick Recovery')}}</p>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  <script src="{{ asset('js/pages/home.js') }}"></script>
@endpush