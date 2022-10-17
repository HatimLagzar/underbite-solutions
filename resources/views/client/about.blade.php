@extends('client.layout.app')
@section('title')
  About Us
@endsection
@section('content')
  <section id="about-us">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <h3 class="fw-light mb-1">{{__('Dental Surgery')}}</h3>
          <h2 class="fw-semibold">{{__('Explained')}}</h2>
          <p>{{ __('Dental surgery is a part of dentistry, which is a branch of medicine dealing with teeth, gums, and the mouth. This covers the oral mucosa and the dentition as well as all related tissues and structures (like the jaw and facial or maxillofacial area).') }}</p>
          <div class="row">
            <p class="col-6">{{__('To the general public, dentistry and dental surgery are mostly associated with fixing teeth. However, dental medicine isn’t only about fixing your teeth but also covers other aspects of craniofacial complex root.')}}</p>
            <p class="col-6">{{__('Such as the temperomandibular structure and other supporting structures. In turn, dental surgery procedures don’t only cover root canals and removal of wisdom teeth that are impacted. Dentists are the practitioners of dentistry.')}}</p>
          </div>
          <a href="/#form-wrapper" class="btn btn-light px-5 shadow rounded-5 apply">{{ __('Apply & Meet Us') }}</a>
        </div>
      </div>
    </div>
  </section>

  <section id="proud-members">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-12">
          <h3><span class="text-pink fw-normal">Proud</span><span class="text-blue fw-bold">Members</span></h3>
          <p>{{ __('DentiCare prouds itself of being one empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures.') }}</p>
        </div>
        <div class="col-lg d-none d-lg-block"></div>
        <div class="col-lg-5 col-12">
          <div class="row mb-3">
            <div class="col">
              <img src="/images/about_us.jpeg" alt="Doctors">
            </div>
            <div class="col">
              <img src="/images/about_us.jpeg" alt="Doctors">
            </div>
            <div class="col">
              <img src="/images/about_us.jpeg" alt="Doctors">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <img src="/images/about_us.jpeg" alt="Doctors">
            </div>
            <div class="col">
              <img src="/images/about_us.jpeg" alt="Doctors">
            </div>
            <div class="col">
              <img src="/images/about_us.jpeg" alt="Doctors">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection