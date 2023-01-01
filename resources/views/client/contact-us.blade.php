@extends('client.layout.app')
@section('title')
  {{__('Contact Us')}}
@endsection
@section('content')
  <section id="contact-us-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <h3 class="fw-light mb-1">{{__('Dental Surgery')}}</h3>
          <h2 class="fw-semibold">{{__('Contact us')}}</h2>
          <p>{{__('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area)...')}}</p>
        </div>
      </div>
    </div>
  </section>

  <section id="contact-us-section">
    <div class="container">
      <div class="row">
        <div class="col-6"></div>
        <div class="col-lg-6 col-12">
          <form id="contact-us-form" action="#" method="post">
            <h1 class="mb-3">{{ __('Get in touch with us') }}</h1>
            <div class="row">
              <div class="form-group col-12 col-lg-6 mb-3">
                <label class="form-label" for="firstNameInput">{{__('First Name')}}</label>
                <input id="firstNameInput" type="text" class="form-control">
              </div>
              <div class="form-group col-12 col-lg-6 mb-3">
                <label class="form-label" for="lastNameInput">{{__('Last Name')}}</label>
                <input id="lastNameInput" type="text" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12 col-lg-6 mb-3">
                <label class="form-label" for="subjectInput">{{__('Subject')}}</label>
                <input id="subjectInput" type="text" class="form-control">
              </div>
              <div class="form-group col-12 col-lg-6 mb-3">
                <label class="form-label" for="emailAddress">{{__('Email Address')}}</label>
                <input id="emailAddress" type="email" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-12 mb-3">
                <label class="form-label" for="messageInput">{{__('Message')}}</label>
                <textarea id="messageInput" type="text" class="form-control"></textarea>
              </div>
            </div>

            <button class="btn btn-primary rounded-5 d-block">{{__('Send')}}</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section id="our-dental-service">
    <h3 class="text-center text-pink fw-light mb-1">{{__('Our Dental Service')}}</h3>
    <h2 class="text-center fw-semibold">{{__('Professionals')}}</h2>
    <p class="text-center text-muted w-50 mx-auto mb-5">{{ __('Distinctively exploit optimal alignments for intuitive bandwidth. Quickly coordinate e-business applications through  revolutionary catalysts for change. Seamlessly underwhelm optimal testing processes....') }}</p>

    <div class="container">
      <div class="row px-lg-5">
        <div class="col-lg-3 col-6">
          <img src="/images/icons/thumbs-up.png" alt="Thumbs up">
          <p class="fw-semibold text-center">{{__('Patient Satisfaction')}}</p>
        </div>
        <div class="col-lg-3 col-6">
          <img src="/images/icons/check-up.png" alt="Check Up">
          <p class="fw-semibold text-center">{{__('Dental Success')}}</p>
        </div>
        <div class="col-lg-3 col-6">
          <img src="/images/icons/plane.png" alt="Plane">
          <p class="fw-semibold text-center">{{__('Travel Satisfaction')}}</p>
        </div>
        <div class="col-lg-3 col-6">
          <img src="/images/icons/recovery.png" alt="Recovery">
          <p class="fw-semibold text-center">{{__('Quick Recovery')}}</p>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  <script src="{{ asset('js/pages/contact-us.js') }}"></script>
@endpush